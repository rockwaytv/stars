<?php
//00:01:00
$mac='00:00:00:00:00:00'

$sn = strtoupper (substr(md5($mac),13));
$device_id = strtoupper (hash('sha256', $sn));
$device_id2 = strtoupper (hash('sha256', $mac));
$signature = strtoupper (hash('sha256', $sn . $mac));
$cadena='sn=' . $sn . '&signature=' . $signature . '&device_id2=' . $device_id2 . '&device_id=' . $device_id;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://portal.iptvprivateserver.tv/stalker_portal/server/load.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = array();
$headers[] = 'Content-Length: 45';
$headers[] = 'X-User-Agent: Model: MAG254; Link: Ethernet';
$headers[] = 'Connection: Keep-Alive';
$headers[] = 'Accept: */*';
$headers[] = 'User-Agent: Model: MAG254; Link: Ethernet';
$headers[] = 'Referer: http://portal.iptvprivateserver.tv/stalker_portal/c/';
$headers[] = 'Cookie: mac=' . $mac . '; stb_lang=en; timezone=America%2FChicago';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Expect: 100-continue';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 4 rev: 1812 Mobile Safari/533.3');
curl_setopt( $ch, CURLOPT_COOKIE,'mac=' . $mac . '; stb_lang=en; timezone=America%2FChicago');
curl_setopt($ch, CURLOPT_POSTFIELDS,'action=handshake&type=stb&JsHttpRequest=1-xml');
$token1 = curl_exec ($ch);
curl_close ($ch);
$obj=json_decode($token1, true);
$keyy=$obj['js']['token'];
// autorizar key
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL,"http://portal.iptvprivateserver.tv/stalker_portal/server/load.php");
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
$headers1 = array();
$headers1[] = 'Content-Length: 725';
$headers1[] = 'X-User-Agent: Model: MAG254; Link: Ethernet';
$headers1[] = 'Connection: Keep-Alive';
$headers1[] = 'Accept: */*';
$headers1[] = 'User-Agent: Model: MAG254; Link: Ethernet';
$headers1[] = 'Referer: http://portal.iptvprivateserver.tv/stalker_portal/c/';
$headers1[] = 'Cookie: mac=' . $mac . '; stb_lang=en; timezone=America%2FChicago';
$headers1[] = 'Content-Type: application/x-www-form-urlencoded';
$headers1[] = 'Expect: 100-continue';
$headers1[] =  'Authorization: Bearer ' . $keyy;
curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);
curl_setopt($ch1, CURLOPT_USERAGENT,'Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 4 rev: 1812 Mobile Safari/533.3');
curl_setopt( $ch1, CURLOPT_COOKIE,'mac=' . $mac . '; stb_lang=en; timezone=America%2FChicago');
curl_setopt($ch1, CURLOPT_POSTFIELDS,'stb_type=MAG254&num_banks=1&JsHttpRequest=1-xml&hw_version=2.6-IB-00&hd=1&not_valid_token=0&image_version=218&ver=ImageDescription%3A%25200.2.18-r11-pub-254%3B%2520ImageDate%3A%2520Wed%2520Mar%252018%252018%3A09%3A40%2520EET%25202015%3B%2520PORTAL%2520version%3A%25204.9.14%3B%2520API%2520Version%3A%2520JS%2520API%2520version%3A%2520331%3B%2520STB%2520API%2520version%3A%2520141%3B%2520Player%2520Engine%2520version%3A%25200x572&auth_second_step=0&action=get_profile&type=stb&' . $cadena);
$autoriz = curl_exec ($ch1);
curl_close ($ch1);
//generar enlace
$cm=$_GET['cm'];
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL,"http://portal.iptvprivateserver.tv/stalker_portal/server/load.php");
curl_setopt($ch2, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
$headers2 = array();
$headers2[] = 'User-Agent: Model: MAG254; Link: Ethernet';
$headers2[] = 'Cookie: mac=' . $mac . '; stb_lang=en; timezone=America%2FChicago';
$headers2[] = 'Referer: http://portal.iptvprivateserver.tv/stalker_portal/c/';
$headers2[] = 'Content-Type: application/x-www-form-urlencoded';
$headers2[] = 'Accept: */*';
$headers2[] = 'Expect: 100-continue';
$headers2[] = 'Connection: Keep-Alive';
$headers2[] = 'X-User-Agent: Model: MAG254; Link: Ethernet';
$headers2[] = 'Authorization: Bearer ' . $keyy;
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
curl_setopt($ch2, CURLOPT_USERAGENT,'Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 4 rev: 1812 Mobile Safari/533.3');
curl_setopt( $ch2, CURLOPT_COOKIE,'mac=' . $mac . '; stb_lang=en; timezone=America%2FChicago');
curl_setopt($ch2, CURLOPT_POSTFIELDS,'cmd=ffrt2+http%3A%2F%2Flocalhost%2Fch%2F' . $cm . '&JsHttpRequest=1-xml&disable_ad=0&forced_storage=undefined&action=create_link&type=itv');
$token2 = curl_exec ($ch2);
curl_close ($ch2);
$json = $token2;
$json1 = json_decode($json, true); 
$inf = explode(" ", $json1["js"]["cmd"]);
$a = $inf[1];
header("Location: " . $a);
?> 
