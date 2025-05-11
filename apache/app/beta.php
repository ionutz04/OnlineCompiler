
<!DOCTYPE html>
<html>
<head>
    
	<title>Save POST Data</title>
</head>
<body>

<form method="post">
    <label for="compiler">Choose a Compiler:</label>
        <select name="compiler" id="compiler" value="<?php echo $_COOKIE['exte'] ?? '';?>" onchange=fctcompiler()>
	     <option value='c'>c</option>
	     <option value='cpp'>cpp</option>
	     <option value='py'>python</option>
	     <option value='java'>java</option>
        </select>
        <br/>File Name: <input type="text" name="filename" id="fn" value="<?php echo $_COOKIE['filename'] ?? '';?>" onchange=fctfilename()><br/>
        <textarea class="textBox" name="mytext" rows = "16" cols = "100"></textarea><br/>
        <input type="submit" name="submitsave" formaction="senttocompile.php?<?php echo_get_info();?>" value="Save Text to Server">
</form>
<?php
        function echo_get_info() {
            if (isset($_COOKIE['filename'])) {

            $fname = $_COOKIE['filename'];
            }
            else {
                $fname = "default";
            }
            if (isset($_COOKIE['exte'])) {
            $plexte = $_COOKIE['exte'];
            }
            else {
                $plexte = "txt";
            }
            $session=session_id();
            $path = "./upload/";
            $filepath = $path . $fname . '.' . $plexte;
            file_put_contents($filepath, $_COOKIE['mycode'] ??'');
            echo 'session='.$session.'&file='.$fname.'.'.$plexte;
        }
?>
</body>
</html>