<?php
include 'dbconnect.php'; // Include your database connection script

$compiler_name = $_POST['compiler']; // Get the selected compiler name from the form
$plextension = $_POST['extension']; // Get the selected compiler's plextension

// Prepare the query to fetch details based on compilername
$query = "SELECT * FROM compilers WHERE compilername = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $compiler_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of the selected compiler
    $row = $result->fetch_assoc();
    echo "Selected Compiler: " . $row['compilername'] . "<br>";
    echo "Compiler Plextension: " . $plextension . "<br>";

    // Special case for C and C++ compilers
    if ($row['compilername'] == 'C' || $row['compilername'] == 'C++') {
        echo "Compiler Container: ccontainer<br>";
    } else {
        echo "Compiler Container: " . $row['namecontainer'] . "<br>";
    }
    // You can process other columns from the row here
} else {
    echo "No data found for the selected compiler.";
}

$conn->close();
?>
