<?php


require __DIR__ . '/vendor/autoload.php';
require_once(__DIR__ . '/core/required.php');

?>
<head>
    <link href="src/css/general.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="node_modules/@fortawesome/fontawesome-free/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>GDRCD 6 - DOC</title>
</head>

<?php GDRCDRouter::getInstance()->startRouting(); ?>
