<?php
$list_type_antrian = json_decode($data['list_type_antrian'], true);
?>
<main class="flex-shrink-0">
    <div class="col-md-12" style="background-color:<?= $data['warna_primary'] ? $data['warna_primary'] : '#6B5935' ?>;">
        <div class="row px-2 py-2 justify-content-center align-items-center" style="height: 100%;">
            <div class="col-2">
                <img class="img-fluid d-block mx-auto" src="<?= $data['logo'] && file_exists('assets/img/' . $data['logo']) ? 'assets/img/' . $data['logo'] : 'assets/img/default.png' ?>" alt="Image" style="max-width: 50px;">
            </div>
            <div class="col-8 text-center text-white">
                <h5 class="fw-bold"><?= $data['nama_instansi'] ? $data['nama_instansi'] : ''; ?></h5>
                <p class="fw-lighter lh-1 m-1">
                    <?= $data['alamat'] ? $data['alamat'] : ''; ?>
                    <br>
                    Tlp. <?= $data['telpon'] ? $data['telpon'] : ''; ?>, Email. <?= $data['email'] ? $data['email'] : ''; ?>
                </p>
            </div>
            <div class="col-2">
                <img class="img-fluid d-block mx-auto" src="<?= $data['logo'] && file_exists('assets/img/' . $data['logo']) ? 'assets/img/' . $data['logo'] : 'assets/img/default.png' ?>" alt="Image" style="max-width: 50px;">
            </div>
        </div>
    </div>
    <div style="height: 3vh;"></div>
    <div class="container">
        <div class="row row-cols-<?= (count($list_type_antrian) <= 3) ? count($list_type_antrian) : 3 ?> justify-content-lg-center">
            <?php if (count($list_type_antrian) > 0) : ?>
                <?php foreach ($list_type_antrian as $lta) : ?>
                    <div class="col mb-4">
                        <div class="bg-white text-center rounded-1 shadow-sm border border-success px-3 py-1 mb-2">
                            <!-- judul halaman -->
                            <i class="bi-people-fill text-success fs-5"></i>
                            <div class="d-flex justify-content-center align-items-center me-md-auto">
                                <h3 class="h5 fw-bold">
                                    <?= strtoupper($lta['type_antrian']); ?>
                                </h3>
                            </div>
                        </div>

                        <div class="card border border-success shadow-sm">
                            <div class="card-body text-center d-grid">
                                <div class="border rounded-1 mb-3" style="min-height: 17vh; display:grid; place-items: center;">
                                    <!-- menampilkan informasi jumlah antrian -->
                                    <h2 id="antrian-<?= $lta['code_antrian'] ?>" class="display-1 fw-bold text-success text-center lh-1"></h2>
                                </div>
                                <!-- button pengambilan nomor antrian -->
                                <a id="insert-<?= $lta['code_antrian'] ?>" data-code_antrian="<?= $lta['code_antrian']; ?>" href="javascript:void(0)" class="btn btn-success btn-block fs-5">
                                    <i class="bi-person-plus fs-4 me-2"></i> AMBIL
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php $js = 'js.php'; ?>