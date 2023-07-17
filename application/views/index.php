<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

	<title><?= $title; ?></title>
</head>

<body>
	<nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="<?= base_url(); ?>">Monitoring Peringatan Dini Kebakaran</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url(); ?>">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('rekap'); ?>">Rekap Data</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('kontrol'); ?>">Kontrol Kipas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('about'); ?>">About Us</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid">
		<br><h5 class="bg-success" style="padding: 7px; width: 1340px; font-weight: bold;"><marquee>Peringatan!Jika Terdeteksi api. Segera lakukan evakuasi.</marquee></h5>
	</div>
</div>

	<div class="container-fluid">
		<?php $this->load->view($page); ?>
	</div>
	
	<div class="container-fluid">
		<br>
	<footer style="border-top: 4px solid #3F2305;">
<div class="copy" style="background-color: #3F2305; padding: 5px; color: #fff; text-align: center;">
			<span>Copyright&copy; Anwar Fuad & Himmatul Ulya</span>
		</div>
		</footer>
</div>
	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
	<style>
	#warningText {
		position: absolute;
		animation: animateAlert linear infinite;
		animation-duration: 20s; 
		animation-direction: alternate;
	}

	@keyframes animateAlert {
		0% {
			transform: translateX(100%);
		}
		100% {
			transform: translateX(-110%);
		}
	}
</style>
</body>
</html>