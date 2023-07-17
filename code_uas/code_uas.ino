//#include <UniversalTelegramBot.h>

#include <ArduinoJson.h>

// Wifi
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>


ESP8266WiFiMulti WiFiMulti;

WiFiClient client;
HTTPClient http;
#define USE_SERIAL Serial

String urlSimpan = "http:// 192.168.98.154/uas_mm2/data/simpan?statusGerakan=";

String respon, statusSimpan, kontrolRelay;

#define WIFI_SSID "OPPO A53"
#define WIFI_PASSWORD "dipkaaaaa"

// Sensor Ultrasonik
#define echoPin D1
#define trigPin D2

//sensor flame
#define flame_pin D5

int flameStatus = 0;
String statusGerakan = "";
String statusKebakaran = "";

#define pinKipas D4
#define relay_off HIGH
#define relay_on LOW

//// Telegram configuration
//#define TELEGRAM_BOT_TOKEN "https://api.telegram.org/bot6314408412:AAFDr_4KvBa3722c931sQFQO1dIPRvEFQCI"
//#define TELEGRAM_CHAT_ID "5856296371"

//UniversalTelegramBot telegramBot(TELEGRAM_BOT_TOKEN, client);
unsigned long previousMillis = 0;
unsigned long interval = 3000;

void setup() {
  Serial.begin(115200);

  USE_SERIAL.begin(115200);
  USE_SERIAL.setDebugOutput(false);

  for(uint8_t t = 4; t > 0; t--) {
      USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
      USE_SERIAL.flush();
      delay(1000);
  }

  pinMode(echoPin, INPUT);
  pinMode(trigPin, OUTPUT);

  pinMode(flame_pin, INPUT);
  pinMode(pinKipas, OUTPUT);
  digitalWrite(pinKipas, relay_off);

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP(WIFI_SSID, WIFI_PASSWORD);

  for (int u = 1; u <= 5; u++)
  {
    if ((WiFiMulti.run() == WL_CONNECTED))
    {
      USE_SERIAL.println("Terhubung ke wifi");
      USE_SERIAL.flush();
      delay(1000);
    }
    else
    {
      Serial.println("Wifi belum terhubung");
      delay(1000);
    }
  }

  delay(1000);
}

void loop()
{
  int durasi, jarak, pos = 0;
  bool adaGerakan = false;
  bool adaKebakaran = false;

  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  durasi = pulseIn(echoPin, HIGH);
  jarak = (durasi / 2) / 29.1;

  if (jarak < 0)
  {
    jarak = 0;
  }
  else if (jarak > 100)
  {
    jarak = 100;
  }

  Serial.println("--------- SENSOR JARAK -----");
  Serial.print("Jarak : ");
  Serial.print(jarak);
  Serial.println(" cm");

  if (jarak < 20)
  {
    adaGerakan = true;
  }
  
  Serial.println("--------- SENSOR API -----");

  flameStatus = digitalRead(flame_pin);
  if (flameStatus == LOW)
  {
    adaKebakaran = true;
  }
  
  if (adaGerakan || adaKebakaran)
  {
    kontrolRelay = "ON";
    Serial.println("kipas menyala");
    Serial.println("terdeteksi api dan gerakan");
    digitalWrite(pinKipas, relay_on);
    statusGerakan ="Waspada";
    statusKebakaran ="Terdeteksi_Api";
//    // kirim notifikasi ke Telegram
//    String message = "Deteksi bahaya!";
//    telegramBot.sendMessage(TELEGRAM_CHAT_ID, message);
  }
  else
  {
    kontrolRelay = "OFF";
    Serial.println("Tidak ada api dan gerakan");
     Serial.println("kipas mati");
    digitalWrite(pinKipas, relay_off);
    statusGerakan ="Aman";
    statusKebakaran ="Tidak_terdeteksi_api";
  }

  // Memeriksa apakah waktu interval telah berlalu
  if (millis() - previousMillis >= interval) {
    Serial.println("--------- KIRIM DATA SENSOR API -----");
    // Menjalankan fungsi kirimDatabase
      kirimDatabase();
    // Mengupdate waktu pengiriman terakhir
    previousMillis = millis();
  }
  Serial.println();
  delay(1000);
}

void kirimDatabase() {
  if (WiFiMulti.run() == WL_CONNECTED)
  {
    USE_SERIAL.print("[HTTP] Memulai...\n");

    http.begin(client, urlSimpan + (String) statusGerakan + "&statusKebakaran=" + (String) statusKebakaran );
    

    USE_SERIAL.print("[HTTP] Kirim data ke database ...\n");
    int httpCode = http.GET();
    
    if (httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK) // kode 200
      {
        respon = http.getString();
        USE_SERIAL.println("Respon : " + respon);
        Serial.println();
        delay(200);

        int str_len = respon.length() + 1;
        char json[str_len];

        respon.toCharArray(json, str_len);

        DynamicJsonDocument doc(1024);
        deserializeJson(doc, json);

        String stsSmp = doc["status"];
        String kontrol = doc["kipas"];

        statusSimpan = stsSmp;
        kontrolRelay = kontrol;

        Serial.println("Status kirim data : " + statusSimpan);
        Serial.println("Kontrol relay : " + kontrolRelay);

        Serial.println();
      }
    }
    else
    {
      USE_SERIAL.printf("[HTTP] GET kirim data gagal, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }
}
