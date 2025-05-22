<?php
require_once "../../config/query.php";

if (isset($_POST['type'])) {
    $action = new config\query;

    if ($_POST['type'] == 'save') {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $nama_instansi = $_POST['nama_instansi'];
                $alamat = $_POST['alamat'];
                $telpon = $_POST['telpon'];
                $email = $_POST['email'];
                $running_text = $_POST['running_text'];
                $youtube_id = $_POST['youtube_id'];
                $no_loket = $_POST['no_loket'];
                $nama_loket = $_POST['nama_loket'];
                $handle_type_antrian = $_POST['handle_type_antrian'];
                $type_antrian = $_POST['type_antrian'];
                $code_antrian = $_POST['code_antrian'];
                $warna_primary = $_POST['warna_primary'];
                $warna_secondary = $_POST['warna_secondary'];
                $warna_accent = $_POST['warna_accent'];
                $warna_background = $_POST['warna_background'];
                $warna_text = $_POST['warna_text'];

                $ip_komputer_printer = $_POST['ip_komputer_printer'];
                $port_komputer_printer = $_POST['port_komputer_printer'];

                $listPrinter = array();
                if (count($ip_komputer_printer) > 0) {
                    foreach ($ip_komputer_printer as $key_ip => $val_ip) {
                        $listPrinter[] = [
                            'ip_komputer_printer' => $val_ip,
                            'port_komputer_printer' => $port_komputer_printer[$key_ip]
                        ];
                    }
                }

                $printer = json_encode($listPrinter);

                $nama_logo = $_POST['nama_logo'];

                $loket = array();
                if (count($no_loket) > 0) {
                    foreach ($no_loket as $key_nk => $val_nk) {
                        $check_handle_type_antrian = (!empty($handle_type_antrian[$key_nk])) ? $handle_type_antrian[$key_nk] : [];
                        $loket[] = [
                            'no_loket' => $val_nk,
                            'nama_loket' => $nama_loket[$key_nk],
                            'handle_type_antrian' => str_replace('"', '\"', json_encode($check_handle_type_antrian))
                        ];
                    }
                }

                $list_loket = json_encode($loket);

                $type = array();
                if (count($type_antrian) > 0) {
                    foreach ($type_antrian as $key_ta => $val_ta) {
                        $type[] = [
                            'type_antrian' => $val_ta,
                            'code_antrian' => $code_antrian[$key_ta]
                        ];
                    }
                }

                $list_type_antrian = json_encode($type);

                if ($_FILES['logo']['error'] == 4 || ($_FILES['logo']['size'] == 0 && $_FILES['logo']['error'] == 0)) {
                    $logo = $nama_logo;
                } else {
                    $targetDirectory = "../../assets/img/"; // Specify the directory where uploaded files will be stored
                    $targetFile = $targetDirectory . basename($_FILES["logo"]["name"]);
                    $uploadOk = 1;
                    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    // Check if the file already exists
                    if (file_exists($targetDirectory . $nama_logo)) {
                        unlink($targetDirectory . $nama_logo);
                        $uploadOk = 1;
                    }

                    // Check file size (limit to 2MB)
                    if ($_FILES["logo"]["size"] > 2000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats (you can add more as needed)
                    if ($fileType != "jpg" && $fileType != "jpeg" && $fileType != "png" && $fileType != "gif") {
                        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    } else {
                        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
                            $logo = $_FILES["logo"]["name"];
                        } else {
                            $logo = $nama_logo;
                        }
                    }
                }

                $save = $action->saveSetting($id, $nama_instansi, $logo, $alamat, $telpon, $email, $running_text, $youtube_id, $list_loket, $list_type_antrian, $warna_primary, $warna_secondary, $warna_accent, $warna_background, $warna_text, $printer);

                if ($save) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Data berhasil disimpan'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Data gagal disimpan'
                    ]);
                }
            }
        }
    }

    if ($_POST['type'] == 'reset_antrian') {
        $query = $action->resetAntrian();

        if ($query) {
            echo json_encode([
                'success' => true,
                'message' => 'Antrian berhasil direset'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Oppps, tidak ada antrian yang direset!'
            ]);
        }
    }

    if ($_POST['type'] == 'logout') {
        session_start();
        session_destroy();
        echo json_encode([
            'success' => true,
            'message' => 'Success'
        ]);
    }
}

?>