<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    require_once "../database/database.php";
    $sql = 'SELECT * FROM problem where name="'.$_POST['problemName'].'"';
    if(mysqli_num_rows(mysqli_query($conn, $sql)) == 0) {
        $insertQuery = 'INSERT INTO problem (name, test_case, type, timeout) VALUES ("'.$_POST['problemName'].'", 5, "default", '.$_POST['timeout']. ')';
        mysqli_query($conn, $insertQuery);
    }

    if(!is_dir("solution/".$_POST["problemName"])) {
        exec("cd solution/; mkdir ".$_POST['problemName']);
    }

    for ($i=1; $i <= 5; $i++) { 
        $testcaseFile = file_get_contents("./solution/".$_POST["problemName"]."/".$_POST["problemName"].$i.".in");
        $testcaseFile .= $_POST["testcase".$i];
        file_put_contents("./solution/".$_POST["problemName"]."/".$_POST["problemName"].$i.".in", $testcaseFile);
        chmod($testcaseFile, 0777);
        $outputFile = file_get_contents("./solution/".$_POST["problemName"]."/".$_POST["problemName"].$i.".sol");
        $outputFile .= $_POST["output".$i] . "\n";
        file_put_contents("./solution/".$_POST["problemName"]."/".$_POST["problemName"].$i.".sol", $outputFile);
        chmod($outputFile, 0777);
    }
    header("Refresh:0;url=./admin.php");


?>