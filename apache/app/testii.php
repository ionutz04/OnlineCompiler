<?php

if($_POST['addition']){


$file_open = fopen("something.txt","w+"); //fopen("something.txt","a+"); to add the contents to file
fwrite($file_open, $_POST['addition']);
fclose($file_open);
}
?>

<form action="<?=$PHP_SELF?>" method="POST">
<textarea name="addition" COLS=40 ROWS=6>
<?php
$datalines = file ("something.txt");

foreach ($datalines as $zz) {
echo $zz; }

?>
</textarea>

<input type="submit" name="button">
    </form>
