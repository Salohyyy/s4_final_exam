<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/S4/s4_final_exam/code/static/css/side-bar/side-bar.css">
    <title>Document</title>
</head>
<body>
    <div class="container">

        <?php include __DIR__ . '/../templates/side-bar.php'; ?>

        <div class="content">
            <?php include $contentView; ?>
        </div>
    </div>
    <script src="/S4/s4_final_exam/code/static/js/side-bar.js"></script>
</body>
</html>