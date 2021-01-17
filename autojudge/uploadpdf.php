<?php
    require_once("../database/database.php");
    if(isset($_POST['submit'])) {
        $name = $_FILES['pdf']['name'];
        $type = $_FILES['pdf']['type'];
        move_uploaded_file($_FILES["pdf"]["tmp_name"], "./upload/".$_FILES["pdf"]["name"]);

        $sql = "insert into file_quiz(name, mime, data) values('$name', '$type')";
    }
    else {
        echo "FAILED";
    }

?>