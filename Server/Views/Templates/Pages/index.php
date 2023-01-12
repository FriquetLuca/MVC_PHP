<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/assets/icons/favicon.ico">
        <title><?php echo $_ENV['TITLE']; ?></title>
<?php
        if(file_exists(__VIEW__ . "/Pages/$viewName.scss")) {
?>
            <link rel="stylesheet" href="/assets/styles/components/<?php echo basename($viewName); ?>.css">
<?php
        }
?>
        <script src="/assets/scripts/bundle.js" defer></script>
<?php
        if(file_exists(__VIEW__ . "/Pages/$viewName.ts")) {
?>
            <script src="/assets/scripts/components/Pages/<?php echo $viewName; ?>.js" type="module"></script>
<?php
        }
?>
    </head>
    <body>
        <header>
<?php 
            require_once __VIEW__ . "/Templates/Components/offlineHeader.php";
?>
        </header>
        <main>
<?php 
            require_once __VIEW__ . "/Pages/$viewName.php";
?>
        </main>
<?php 
            require_once __VIEW__ . "/Templates/Components/offlineFooter.php";
?>
    </body>
</html>