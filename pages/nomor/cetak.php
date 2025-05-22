<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


function cetak($no_antrian, $code_antrian, $config, $ip_printer, $port_printer)
{
    if ($ip_printer == '' || $port_printer == '') {
        echo 'The printer has not been set';
    }else {
        $ip = $ip_printer != '' ? $ip_printer : "127.0.0.1";
        $port = $port_printer != '' ? $port_printer : "3000";
        $url = "http://" . $ip . ":" . $port . "/printantrian";

        $data = [
            "no_antrian" => $no_antrian,
            "code_antrian" => $code_antrian,
            "config" => $config
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo $err;
        }
    }
}

