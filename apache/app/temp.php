<?php 
    if (isset($_POST)) {
        $path = "./upload/";
        $filename = $_POST['fn'];
        $extension = $_POST['compiler']; // Get the extension from the form

        $filepath = $path . $filename . '.' . $extension;

        if (isset($_POST['submitsave']) && $_POST['submitsave'] == "Save Text to Server" && !empty($filename)) {
            $text = $_POST["textdata"];
            file_put_contents($filepath, $text);
        }

        if (isset($_POST['submitopen']) && $_POST['submitopen'] == "Submit File Request") {
            if (!file_exists($filepath)) {
                exit("Error: File does not exist.");
            }
            $file = fopen($filepath, "r");
            while (!feof($file)) {
                echo fgets($file) . "<br />";
            }
            fclose($file);
        }
    }
    ?>
