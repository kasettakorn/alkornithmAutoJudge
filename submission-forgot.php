<?php
    require_once("./database/database.php");
    if ($_POST['email'] == "") {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน !!')</script>";
        header("url=forgot.php", false); 

    }
 
    else {
        // the message
        $msg = "First line of text\nSecond line of text";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);
        $to = 's5904062620050@email.kmutnb.ac.th';
        // send email
        if(mail($_POST['email'],"My subject",$msg)) {
            echo "<script>alert('ส่งอีเมลเรียบร้อยแล้ว !!')</script>";
            header("url=index.php", false);
        }
        else {
            echo 'Failed';
        }
    }
    mysqli_close($conn);

?>