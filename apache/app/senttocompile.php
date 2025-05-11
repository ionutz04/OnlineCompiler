<?php
//php read from variable
$ses=$_GET["session"];
echo '<br/>'.$ses;
$file = $_GET["file"];
echo '<br/>'.$file;
$myfile = fopen("./upload/.queue/".$ses, "w") or die("Unable to open file!");
fwrite($myfile, $file);
fclose($myfile);
sleep(15);
$frez="./upload/.rez/".$ses.".out";
$rfile = fopen($frez, "r") or die("Unable to open file!");
//echo $rez;
//echo("<meta http-equiv='refresh' content='1'>"); 
echo "<pre>" . fread($rfile, 4096) . "</pre>";
fclose($rfile);
?>
