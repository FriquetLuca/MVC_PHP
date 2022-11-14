<!DOCTYPE html>
<html>
    <head>
        <?php require (__VIEW__ . '_shared/offline_head.php'); ?>
    </head>
    <body>
        <header>My <?php echo $name; ?>.</header>
        <main>
            The main content of the <?php echo $name; ?>.
            <img src="/assets/img/contact.png" alt="CONTACT PIC">
        </main>
        <footer>The footer of my <?php echo $name; ?>.</footer>
    </body>
</html>