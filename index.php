<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>抖音视频解析</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">🎬 抖音视频解析工具</h2>

    <form id="parseForm" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" id="videoUrl" placeholder="请输入抖音分享链接" required>
            <button type="submit" class="btn btn-primary">解析视频</button>
        </div>
    </form>

    <div id="result" class="card d-none">
        <div class="card-body">
            <div class="d-flex mb-3">
                <img id="avatar" src="" alt="头像" class="rounded-circle me-3" width="60" height="60">
                <div>
                    <h5 id="author" class="card-title mb-0"></h5>
                    <small id="uid" class="text-muted"></small>
                </div>
            </div>

            <h6 id="title" class="mb-3"></h6>
            <p><strong>发布时间：</strong><span id="time2"></span></p>
            <p><strong>点赞数：</strong><span id="like"></span></p>

            <div class="ratio ratio-16x9 mb-3">
                <video id="videoPlayer" controls poster="" crossorigin="anonymous">
                    <source id="videoSrc" src="" type="video/mp4">
                    您的浏览器不支持 video 标签。
                </video>
            </div>

            <a id="downloadBtn" class="btn btn-success" href="#" download>📥 下载视频</a>
        </div>
    </div>
</div>

<script>
document.getElementById('parseForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const videoUrl = document.getElementById('videoUrl').value.trim();
    if (!videoUrl) return;

    fetch('api.php?url=' + encodeURIComponent(videoUrl))
        .then(response => response.json())
        .then(data => {
            if (data.code === 200) {
                const info = data.data;
                document.getElementById('avatar').src = info.avatar;
                document.getElementById('author').textContent = info.author;
                document.getElementById('uid').textContent = '抖音号：' + info.uid;
                document.getElementById('title').textContent = info.title;
                document.getElementById('time2').textContent = info.time2;
                document.getElementById('like').textContent = info.like;
                document.getElementById('videoPlayer').poster = info.cover;

                document.getElementById('videoSrc').src = 'video_proxy.php?video=' + encodeURIComponent(info.url);
                document.getElementById('videoPlayer').load();

                document.getElementById('downloadBtn').href = 'download.php?video=' + encodeURIComponent(info.url);

                document.getElementById('result').classList.remove('d-none');
            } else {
                alert('解析失败：' + data.msg);
            }
        })
        .catch(err => {
            alert('请求失败，请检查链接或稍后再试。');
            console.error(err);
        });
});
</script>

</body>
</html>
