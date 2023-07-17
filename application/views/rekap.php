<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<tr>
							<th>#</th>
							<th>STATUS GERAKAN</th>
							<th>STATUS KEBAKARAN</th>
							<th>Tanggal</th>
							<th>Action</th>
						</tr>

						<?php foreach ($data as $i => $dt) : ?>
							<tr>
								<td><?= $i + 1; ?></td>
								<td><?= $dt->statusGerakan; ?></td>
								<td><?= $dt->statusKebakaran; ?></td>
								<td><?= date('d M Y - H:i:s', strtotime($dt->createdAt)); ?></td>
								<td>
									<a href="<?= base_url('rekap/delete/' . $dt->id); ?>" class="button">Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.button {
  font-family: monospace;
  background-color: #f3f7fe;
  color: #3b82f6;
  border: none;
  border-radius: 8px;
  width: 100px;
  height: 45px;
  transition: .3s;
}
.button:hover {
  background-color: #3b82f6;
  box-shadow: 0 0 0 5px #3b83f65f;
  color: #fff;
}
</style>