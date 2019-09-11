<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo $GLOBALS['title'] ?></title>

    <link href="<?= (isset($GLOBALS['stylesheet']) ? $GLOBALS['stylesheet'] : '../../style.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <?php
        if (isset($GLOBALS['styles'])) {
            foreach ($GLOBALS['styles'] as $href) {
                echo "<link href=\"$href\" rel=\"stylesheet\" type=\"text/css\">";
            }
        }
    ?>

    <?php
        if (isset($GLOBALS['scripts'])) {
            foreach ($GLOBALS['scripts'] as $src) {
                echo "<script src=\"$src\"></script>";
            }
        }
    ?>
    <script src="../../js/index.js"></script>
</head>