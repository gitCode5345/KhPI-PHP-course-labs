<?php
$file = $_FILES["file_upload"];
$need_types = ["image/png", "image/jpg", "image/jpeg"];
$path_file = "./uploads/".$file["name"];

if (!is_uploaded_file($file["tmp_name"])) {
    echo "<p>File not uploaded</p><br>";
    return null;
} elseif (!in_array($file["type"], $need_types)) {
    echo "<p>Not correct file type</p><br>";
    return null;
} elseif ($file["size"] > 2 * 1024 * 1024) {
    echo "<p>File size > 2MB";
    return null;
} elseif (file_exists($path_file)) {
    if (isset($_POST["auto_rename"])) {
        $file_info = pathinfo($file["name"]);
        $new_name = $file_info["filename"] . "_" . time() . "." . $file_info["extension"];
        $path_file = "./uploads/" . $new_name;
        echo "<p>File exists, renamed to: ".htmlspecialchars($new_name)."</p><br>";
    } else {
        echo "<p>File exists</p><br>";
        return null;
    }
} else {
    echo "<p>File successfully uploaded";
}

move_uploaded_file($file["tmp_name"], $path_file);

echo "<p>Information about uploaded file<p><br>
      <p>Filename: ".$file["name"]."</p><br>
      <p>Filetype: ".$file["type"]."</p><br>
      <p>Filesize: ".$file["size"]."</p><br>
      <a href=\"$path_file\" download=\"".$file["name"]."\">Download</a>";
