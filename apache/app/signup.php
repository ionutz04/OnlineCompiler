<?php
include ("dbconnect.php");
$message = "";

function getPermissionsDescription($conn, $idpermissions) {
    $stmt = $conn->prepare("SELECT descriptionpermissions FROM permissions WHERE idpermissions = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("s", $idpermissions);
    $stmt->execute();
    $stmt->bind_result($descriptionpermissions);
    $stmt->fetch();
    $stmt->close();

    return $descriptionpermissions ? $descriptionpermissions : false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $idpermissions = $_POST['idpermissions'];

    $permissionsDescription = getPermissionsDescription($conn, $idpermissions);

    if ($permissionsDescription === false) {
        $message = "Invalid permissions ID. Please try again.";
    } else {
        $checkUser = $conn->query("SELECT id FROM users WHERE username = '$username'");
        if ($checkUser->num_rows == 0) {
            $sql = "INSERT INTO users (username, password, permission) VALUES ('$username', '$password', '$idpermissions')";
    
            if ($conn->query($sql) === TRUE) {
                $message = "New record created successfully";
                header("location: login.php");
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $message = "Username already exists";
        }
    }
    
}
$conn->close();
?>

<html>
<head>
    <title>Signup Page</title>
</head>
<body>
    <div>
        <h2>Signup</h2>
        <form action="" method="post">
            <label>Username :</label><input type="text" name="username" required><br><br>
            <label>Password :</label><input type="password" name="password" required><br><br>
            <label>Permissions ID :</label>
            <select name="idpermissions" required>
                <option value="111111">All Features</option>
                <option value="111110">All except Python</option>
                <option value="111100">All except Java and Python</option>
                <option value="111000">Only C</option>
                <option value="110000">One try for any file type</option>
            </select><br><br>
            <input type="submit" value=" Register "><br>
        </form>
        <div><?php echo $message; ?></div>
    </div>
</body>
</html>
