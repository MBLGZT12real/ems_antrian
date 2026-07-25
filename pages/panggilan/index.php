<?php
$css = 'css.php';
$loket = json_decode($data['list_loket'], true);
$list = array();
if (count($loket) > 0) {
    foreach ($loket as $key_l => $val_l) {
        $list[$key_l]['no_loket'] = $val_l['no_loket'];
        $list[$key_l]['nama_loket'] = $val_l['nama_loket'];
        $list[$key_l]['handle_type_antrian'] = json_decode($val_l['handle_type_antrian']);
    }
}
?>
<main class="flex-shrink-0">
    <div class="container pt-4">
        <div class="d-flex flex-column flex-md-row px-3 py-2 mb-4 bg-white rounded-1 shadow-sm border border-success">
            <!-- judul halaman -->
            <div class="d-flex align-items-center me-md-auto">
                <i class="bi-mic-fill text-success me-3 fs-3"></i>
                <h1 class="fw-bold h5 pt-2 mb-0">PANGGILAN ANTRIAN - <span class="namaLoket"></span></h1>
                <button type="button" id="btnIstirahat" class="btn btn-sm btn-warning ms-3">
                    <i class="bi-cup-hot-fill me-1"></i> ISTIRAHAT
                </button>
            </div>
            <!-- breadcrumbs -->
            <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/ems_antrian/"><i class="bi-house-fill text-success"></i></a></li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Panggilan Antrian</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row justify-content-lg-center" id="table-panggilan"></div>
    </div>

    <!-- overlay istirahat, muncul saat tombol ISTIRAHAT diklik -->
    <div id="restOverlay" class="rest-overlay">
        <button type="button" id="btnOpenRest" class="btn btn-success rest-overlay-open">
            <i class="bi-unlock-fill me-1"></i> OPEN
        </button>
        <img src="assets/img/slider/Rest.png" class="rest-overlay-img" alt="Istirahat">
    </div>
</main>

<script>
    var list_loket = '<?= json_encode($list); ?>';
    var list_type_antrian = '<?= $data['list_type_antrian'] ?>';
</script>
<?php $js = 'js.php'; ?>