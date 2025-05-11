<?php
include ("dbconnect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    $sql = "SELECT id, username, password FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        $_SESSION['login_user'] = $username;
        $result->data_seek(0);
        $datarow = $result->fetch_array();
        $userid = $datarow[0];
        #echo $userid;
        $session_id=session_id();
        $d = date("Y-m-d H:i:s");
        #echo $d;
        $insertsql="INSERT INTO sessionshistory (sessionid, timestamplogin, status, iduser) VALUES ('${session_id}', '${d}', 1, $userid)";
        #echo $insertsql;
        /*if($conn->query($insertsql) === TRUE){
            echo "Session Saved into db";
        }
        else {
            echo "Error: " . $insertsql . "<br>" . $conn->error;
        }*/
        header("location: index.php");
         // Redirect to a welcome page
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>

<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <div>
        <h2>Login</h2>
        <form action="" method="post">
            <label>Username :</label><input type="text" name="username" required><br><br>
            <label>Password :</label><input type="password" name="password" required><br><br>
            <input type="submit" value=" Submit "><br>
        </form>
        <div style="color:red;"><?php if(isset($error)){ echo $error; } ?></div>
        <h2>If you don't have an account, just <a href="signup.php">Create one :)</a</h2>
    </div>
</body>
</html>
