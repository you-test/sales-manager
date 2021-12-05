<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Manager | <?php echo $title; ?></title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Sales Manager</h1>
        <nav>
            <?php foreach ($links as $link_name => $link_url): ?>
                <a href="<?php echo $link_url; ?>"><?php echo $link_name ?></a>
            <?php endforeach; ?>
        </nav>
    </header>
    <div class="container">
        <h2 class="title"><?php echo $title; ?></h2>
        <?php include $content; ?>
    </div>
</body>
</html>
