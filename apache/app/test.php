<?php

include 'dbconnect.php'; // Include your database connection script
if(!isset($_SESSION['login_user'])){
    header("location:login.php");
    die();
}

echo "Welcome " . $_SESSION['login_user'];

// // Fetching data for the dropdown from the 'compilers' table
// $query = "SELECT compilername, plextension FROM compilers";
// $result = $conn->query($query);
// $extensions = array();
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $extensions[$row['compilername']] = $row['plextension'];
//         // echo $row['compilername']." ";
//         // echo $extensions[$row['compilername']]."<br/>";
//     }
// }
// // Check if the compiler selection form was submitted
// // $plextension = 'txt'; // Default extension
// // if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compiler'])) {
// //     $compiler_name = $_POST['compiler']; // Get the selected compiler name
// //     $plextension = $_POST['extension']; // Get the selected compiler's plextension

// //     // Prepare the query to fetch details based on compilername
// //     $query = "SELECT plextension, compilername FROM compilers WHERE compilername = ?";
// //     $stmt = $conn->prepare($query);
// //     $stmt->bind_param("s", $compiler_name);
// //     $stmt->execute();
// //     $result = $stmt->get_result();

// //     if ($result->num_rows > 0) {
// //         $row = $result->fetch_assoc();
// //         // Special case for C and C++ compilers
// //         //$containerInfo = ($row['compilername'] == 'C' || $row['compilername'] == 'C++') ? "ccontainer" : $row['namecontainer'];
// //     } else {
// //         $containerInfo = "No data found for the selected compiler.";
// //     }
// // }
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Additional styles and scripts here -->
</head>
<body style="background-color: rgb(225,225,225)">
    <header><a href="dbdisconnect.php">Logout</a></header>
    <script>
        var textf;
        var value;
        var t;
        var e;
        var f;
        function fctfilename(){
            t = document.getElementById("td");
            var myText = t.value;
            var myCookieValue = myText.split('\n').join('\\');
	    alert(myCookieValue);
            document.cookie = "mycode=" + myCookieValue + "; path=/;"
            f = document.getElementById("fn");
            e = document.getElementById("compiler");
            textf = f.value;
            document.cookie = "filename="+textf+";expires=Fri, 31 Dec 9999 23:59:59 GMT;path=/;SameSite=Lax";
            document.cookie = "td="+t.value+";expires=Fri, 31 Dec 9999 23:59:59 GMT;path=/;SameSite=Lax";
            //document.cookie.reload();
            //sessionStorage.setItem("fn", textf);
            //document.cookie.reload();
            //alert(f.value);
            location.reload();
            document.getElementById("fn").value=f.value;
            document.getElementById("compiler").value=e.value;
            document.getElementById("td").value = myCookieValue.split('\\').join('\n');
        }
        function fctcompiler(){
            t = document.getElementById("td");
            var myText = t.value;
            var myCookieValue = myText.split('\n').join('\\');
            document.cookie = "mycode=" + myCookieValue + "; path=/;"
	    alert(myCookieValue);
            f = document.getElementById("fn");
            e = document.getElementById("compiler");
            value = e.value;
            //var text = e.options[e.selectedIndex].text
            document.cookie = "exte="+value+";expires=Fri, 31 Dec 9999 23:59:59 GMT;path=/;SameSite=Lax";        
            document.cookie = "td="+t.value+";expires=Fri, 31 Dec 9999 23:59:59 GMT;path=/;SameSite=Lax";
            //document.cookie.reload();
            //sessionStorage.setItem("compiler", value);
            //document.cookie.reload();
            alert(t.value);

            location.reload();
            document.getElementById("fn").value=f.value;
            document.getElementById("compiler").value=e.value;
            document.getElementById("td").value = myCookieValue.split('\\').join('\n');
        }
    </script>

    <!-- Dropdown Section for Compilers -->
    <form method="post">
    <label for="compiler">Choose a Compiler:</label>
        <select name="compiler" id="compiler" value="<?php echo $_COOKIE['exte'] ?? '';?>" onchange=fctcompiler()>
	     <option value='c'>c</option>
	     <option value='cpp'>cpp</option>
	     <option value='py'>python</option>
	     <option value='java'>java</option>
        </select>
        <br/>File Name: <input type="text" name="filename" id="fn" value="<?php echo $_COOKIE['filename'] ?? '';?>" onchange=fctfilename()><br/>
        <textarea rows="16" cols="100" name="textdata" id="td" value="<?php echo $_COOKIE['mycode'] ?? '';?>"><?php decodecodecookie() ?? "";?></textarea><br/>
        <input type="submit" name="submitsave" formaction="senttocompile.php?<?php echo_get_info();?>" value="Save Text to Server">
    </form>
    <br/><hr style="background-color: rgb(150,150,150); color: rgb(150,150,150); width: 100%; height: 4px;"><br/>

    <br/><hr style="background-color: rgb(150,150,150); color: rgb(150,150,150); width: 100%; height: 4px;"><br/>
    File Contents:<br/>
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
<?php 
        function decodecodecookie() {
	if (isset($_COOKIE['mycode'])) {
        $mycode = $_COOKIE['mycode'];
        $mycodearray = $mycode;
        echo $mycodearray;
	}
	else {
	echo " ";
	}
        }
?>
</body>
</html>
