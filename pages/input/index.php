<main class="flex-shrink-0">
	<div class="container pt-2">
		<div class="d-flex flex-column flex-md-row px-3 py-2 mb-2 bg-white rounded-1 shadow-sm border border-warning">
			<!-- judul halaman -->
			<div class="d-flex align-items-center me-md-auto">
				<i class="bi-plus-square-fill text-success me-2 fs-4"></i>
				<h1 class="fw-bold h5 pt-2">INPUT DATA ANTRIAN</h1>
			</div>
		</div>

		<form action="" method="post" id="saveData">
			<div class="row">
				<div class="col-12">
					<div class="card border-0 shadow-sm">
						<div class="card-header"><strong>A. INFORMASI PRIBADI</strong></div>
						<div class="card-body p-3">
							<div class="mb-3">
								<label for="panggilan" class="form-label">Nama Panggilan *</label>
								<input type="text" class="form-control" id="panggilan" name="panggilan" placeholder="Nama Panggilan Anda (Maks 10)" maxlength="10" autofocus="on" required>
							</div>
							<div class="mb-3">
								<label for="fullname" class="form-label">Nama Lengkap *</label>
								<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nama Lengkap Anda (Maks 25)" maxlength="25" required>
							</div>
							<div class="mb-3">
								<label for="company" class="form-label">Brand/Perusahaan *</label>
								<input type="text" class="form-control" id="company" name="company" placeholder="Nama Lengkap Anda (Maks 25)" maxlength="25" required>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="mb-3">
										<label for="telepon" class="form-label">No. WhatsApp *</label>
										<input type="number" class="form-control" id="telepon" name="telepon" placeholder="Nomor WA Aktif Anda" required>
									</div>
								</div>
								<div class="col-6">
									<div class="mb-3">
										<label for="email" class="form-label">Email</label>
										<input type="text" class="form-control" id="email" name="email" placeholder="Alamat Email Anda">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card border-0 shadow-sm mt-3">
						<div class="card-header"><strong>B. INFORMASI CETAKAN</strong></div>
						<div class="card-body p-3">
							<?php
								$list_type_antrian = json_decode($data['list_type_antrian'], true);
							?>
							<div class="row">
								<div class="col-6">
									<div class="mb-3">
										<label for="typeantri" class="form-label">Tipe Antrian *</label>
										<select class="form-control" id="typeantri" name="typeantri" onchange="pilihtype(event)" required>
											<option value="">PILIHAN</option>
									<?php if (count($list_type_antrian) > 0) : ?>
										<?php foreach ($list_type_antrian as $lta) : ?>
											<?php if ($lta['code_antrian'] != "S") : ?>
											<option value="<?= $lta['code_antrian'] ?>"><?= strtoupper($lta['type_antrian']); ?></option>
											<!--<option value="B">Foto Langsung</option>-->
											<?php endif ?>
										<?php endforeach; ?>
									<?php endif ?>
										</select>
									</div>
								</div>
								
								<div class="col-6">
									<div class="mb-3">
										<label for="kirimvia" class="form-label">Kirim VIA *</label>
										<select class="form-control" id="kirimvia" name="kirimvia" required>
											<option value="">PILIHAN</option>
											<option value="EMAIL">EMAIL</option>
											<option value="GDRIVE">GDRIVE</option>
											<option value="WA">WA</option>
											<option value="FOTO LANGSUNG">FOTO LANGSUNG</option>
										</select>
									</div>
								</div>
							</div>
							
							<div class="mb-3">
								<label for="total" class="form-label">Total Cetakan *</label>
								<input type="number" class="form-control" id="total" name="total" placeholder="NILAI TOTAL CETAKAN ANDA" required>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center gap-2 mt-2">
						<button type="submit" class="btn btn-md btn-success">
							<i class="bi-save text-white">&nbsp;</i> SUBMIT
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</main>
<?php $js = 'js.php'; ?>