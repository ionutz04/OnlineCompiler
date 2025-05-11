<?php
include("dbconnect.php"); // Include your database connection file

function findCompilerForExtension($conn, $extension) {
    $stmt = $conn->prepare("SELECT * FROM compilers WHERE plextension = ?");
    $stmt->bind_param("s", $extension);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Returns compiler info
    } else {
        return null;
    }
}

function compileFile($compilerInfo, $filename) {
    // Your compilation logic goes here
    // This is just a placeholder function
    echo "Compiling " . $filename . " using " . $compilerInfo['compilername'] . "\n";
    // Here you would typically invoke the actual compiler with appropriate parameters
}

$filename = "temporary.c"; // Example filename
$extension = pathinfo($filename, PATHINFO_EXTENSION);

$compilerInfo = findCompilerForExtension($conn, $extension);

if ($compilerInfo) {
    compileFile($compilerInfo, $filename);
} else {
    echo "No compiler found for the given file extension.";
}

$conn->close();
?>
