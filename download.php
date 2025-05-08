<?php
if (!isset($_GET['video'])) {
    die('缺少视频链接');
}

$videoUrl = $_GET['video'];
$filename = 'douyin_video_' . time() . '.mp4';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $videoUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_BUFFERSIZE, 1024 * 1024); // 提高缓冲区
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/16A366');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Referer: https://www.douyin.com/',
]);

// 输出响应头
header('Content-Description: File Transfer');
header('Content-Type: video/mp4');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

$fp = fopen('php://output', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);

curl_exec($ch);
curl_close($ch);
fclose($fp);
exit;
?>
