<?php
header('Content-Type: application/json');

if (!isset($_GET['url'])) {
    echo json_encode(['code' => 400, 'msg' => '缺少视频链接']);
    exit;
}

$video_url = urlencode($_GET['url']);
$api_url = "http://api.guiguiya.com/api/video_qsy/juhe?url={$video_url}";

$response = file_get_contents($api_url);
echo $response;
?>
