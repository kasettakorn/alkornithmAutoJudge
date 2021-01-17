<?php
    require_once("./database/database.php");
    if (!$_POST['sid'] || $_POST['password'] == "" || $_POST['name'] == "" || $_POST['nickname'] == "") {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน !!')</script>";
        header("Refresh:0; url=register.php"); 

    }
    else if (strlen(trim($_POST['name'])) == 0 || strlen(trim($_POST['nickname'])) == 0) {
        echo "<script>alert('ชื่อ-สกุล หรือชื่อเล่นของคุณกรอกไม่ถูกต้อง')</script>";
        header("Refresh:0; url=register.php"); 
    }
    else if ($_POST['password'] != $_POST['confirm_password']) {
        echo "<script>alert('รหัสผ่านไม่ตรงกัน')</script>";
        header("Refresh:0; url=register.php");       
    }

    else if(mysqli_num_rows(mysqli_query($conn, "select * from student where username='".$_POST['sid']."'")) != 0) {
        echo "<script>alert('ชื่อผู้ใช้งานนี้เคยสมัครแล้ว')</script>";
        header("Refresh:0; url=http://alkornithm.com/grader/");  
    }
    else {
        $insert_sql = "insert into student (username, password, name, nickname) values ('".$_POST['sid']."','".md5($_POST['password'])."','".$_POST['name']."','".$_POST['nickname']."')";
        if(mysqli_query($conn, $insert_sql)) {
            echo "<script>alert('สมัครเสร็จสมบูรณ์')</script>";
            header("Refresh:0; url=http://alkornithm.com/grader/");  

        }
        else {
            echo mysqli_error($conn);
        }
    }
    mysqli_close($conn);

?>