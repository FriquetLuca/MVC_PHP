<p>Error <?php echo $errNbr; ?></p>
<?php
foreach(glob(__ROOT__ . "/Server/Routes/Injected/*") as $filename){
    echo $filename;
}