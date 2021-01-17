<?php
    session_start();
    require_once "../database/database.php";
    $qID = $_POST['quiz'];
    $answer = $_POST['answer'];
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM problem WHERE id = '$qID'";

    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    if ($result['isBoolean'] == 1) {
        
    }
    if ($answer == $result['answer']) {
        $update_sql = "UPDATE student set scorep$qID = 50 WHERE username='$username'";
        mysqli_query($conn, $update_sql);
        echo "<script>alert('คำตอบถูกต้อง !!')</script>";
  
    }
    else {
        echo "<script>alert('คำตอบไม่ถูกต้อง')</script>";
    }
    header("Refresh:0;url=./index.php");
    exit;
    
?>
