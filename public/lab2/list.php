<?php
$file_directory = "./uploads/";

if (is_dir($file_directory)) {
    if ($handler = opendir($file_directory)) {
        while (($file = readdir($handler)) !== false) {
            if ($file === "." || $file === "..") {
                continue;
            }
            $file_path = $file_directory.$file;
            echo "<p>filename: ".$file."</p> <a href=\"$file_path\" download=\"$file\">Download file</a>";
        }
    }
    closedir($handler);
}
