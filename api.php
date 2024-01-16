<?php

$url = "https://absen.madiunkab.go.id/tabel.php/service";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
  "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
  "jsonrpc":2,
  "filter":1,
  "method":"POST",
  "object":"login",
  "param":
  	{
  		"email":"presensi",
      	"password":"serv1c3",
      	"latlong":"-7.541667,111.652527",
      	"imei":"1111111111111111a"
  	}
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
