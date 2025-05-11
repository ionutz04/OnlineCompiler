<?php
include 'dbconnect.php'; // Include your database connection script
if(!isset($_SESSION['login_user'])){
    header("location:login.php");
    die();
}

echo "Welcome " . $_SESSION['login_user'];
$ses=session_id();
if(isset($_POST["mytext"]))
{
	$file = "data.txt";
	if(isset($_POST["filename"])){
	$text = $_POST["mytext"];
	if(isset($_POST["compiler"])){
	$exte=$_POST["compiler"];	
	$file = "./upload/".$_POST["filename"].".".$exte;
	//echo "Test filename: ".$file;
	file_put_contents($file, $text . "\r\n", LOCK_EX);
	$_GET['session']=$ses;
	$_GET['file']=$_POST["filename"].'.'.$exte;
	#echo $ses $file'.'$exte;
	include 'senttocompile.php';
	}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Comiler</title>
</head>
<body>
 <header><a href="dbdisconnect.php">Logout</a></header>
<form action="index.php" name="myform" method="POST">
 <label for="compiler">Choose a Compiler:</label>
        <select name="compiler" id="compiler" value="<?php echo $_COOKIE['exte'] ?? '';?>" onchange=fctcompiler()>
	     <option value='c'>c</option>
	     <option value='cpp'>cpp</option>
	     <option value='py'>python</option>
	     <option value='java'>java</option>
        </select>

Filename : <input type="text" name="filename" id="fn" ><br/>
<textarea class="textBox" name="mytext" rows = "16" cols = "100"></textarea><br/>
<input type="submit" class="save" value="save"/>

</body>
</html>
