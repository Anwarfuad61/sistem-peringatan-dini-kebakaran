<div class="row mt-3">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<form action="<?= base_url('kontrol/update'); ?>" method="POST">
					<div class="form-group">
						<label>Status Kipas</label>
						<input type="hidden" name="id" value="<?= $kontrol->id; ?>">
						<select name="kipas" class="form-control">
							<option value="ON" <?= ($kontrol->kipas == 'ON') ? 'selected' : ''; ?>>ON</option>
							<option value="OFF" <?= ($kontrol->kipas == 'OFF') ? 'selected' : ''; ?>>OFF</option>
						</select>
					</div>
					<button type="submit">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
<style>
button {
  font-family: monospace;
  background-color: #f3f7fe;
  color: #3b82f6;
  border: none;
  border-radius: 8px;
  width: 100px;
  height: 45px;
  transition: .3s;
}
button:hover {
  background-color: #3b82f6;
  box-shadow: 0 0 0 5px #3b83f65f;
  color: #fff;
}
</style>