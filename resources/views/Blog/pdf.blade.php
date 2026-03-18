<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<style>
    body {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        text-align: right;
        line-height: 1.6;
    }
</style>
</head>
<body>
    <h1>{{ $blog->title }}</h1>
    <p>{{ $blog->content }}</p>
</body>
</html>
