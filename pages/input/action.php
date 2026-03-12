<?php
// Mengatasi CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST");
header("Allow: GET, POST");

// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// panggil file "database.php" untuk koneksi ke database
require_once "../../config/query.php";

// jika ada ajax request
if (isset($_POST['type'])) {
	$action = new config\query;
	
	if ($_POST['type'] == 'save') {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$countryCode = "IDN";
        		$phone_raw = $_POST['telepon'];
				$phoneFormatted = $action->formatAndValidatePhone($phone_raw, $countryCode);

				$cPanggilan	= $action->escsql($_POST['panggilan']);
				$cFullname 	= $action->escsql($_POST['fullname']);
				$cCompany 	= $action->escsql($_POST['company']);
				$nTelepon 	= $phoneFormatted;
				$cEmail 	= $action->escsql($_POST['email']);
				$nTotal 	= $_POST['total'];
				$lTypeAntri = $_POST['typeantri'];
				$lKirimVia 	= $_POST['kirimvia'];
				$cIPAddrs 	= $_SERVER['REMOTE_ADDR'];
				
				$query = $action->getLastAntrianByType($lTypeAntri);
				// Ambil hasil query
				$result = mysqli_fetch_assoc($query);
				
				// Jika ada data, tampilkan no_antrian
				if ($result['no_antrian'] !== null) {
					$nAntrian = sprintf("%04s", (int)$result['no_antrian'] + 1);
				} else {
					$nAntrian = sprintf("%04s", 1);
				}
				
				$save = $action->createAntrianNew($lTypeAntri, $nAntrian, $cPanggilan, $cFullname, $cCompany, $nTelepon, $cEmail, $nTotal, $lKirimVia, $cIPAddrs);
				//$save = true;
				if ($save) {
					echo json_encode([
						'success' => true,
						'message' => "Nomor: <b><u>$lTypeAntri$nAntrian</u></b>, Nama: <b><u>$cPanggilan</u></b><br/>Silahkan Tunggu No dan Nama Anda di Panggil",
						'data' => [
							'code_antrian' => $lTypeAntri,
							'no_antrian' => $nAntrian,
							'atas_nama' => $cPanggilan
						]
					]);
				} else {
					echo json_encode([
						'success' => false,
						'message' => "Gagal menyimpan data ke database: " . mysqli_error($mysqli),
						'data' => []
					]);
				}
			}
		}
	}
}
