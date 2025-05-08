<?php
if (!isset($_GET['video'])) {
    http_response_code(400);
    die('缺少视频链接');
}

$videoUrl = $_GET['video'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $videoUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/16A366');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Referer: https://www.douyin.com/'
]);

curl_exec($ch);
curl_close($ch);
?>
