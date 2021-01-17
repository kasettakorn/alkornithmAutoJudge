<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set("Asia/Bangkok");
if (isset($_SESSION['username'])) {
    require_once("../database/database.php");
    $fetch_q1_sql = "select * from student where username='" . $_SESSION['username'] . "'";
    $result_q1 =  mysqli_query($conn, $fetch_q1_sql);
    $row = mysqli_fetch_assoc($result_q1);

    $fetch_problem_sql = "select * from problem where type='quiz'";
    $result_problem = mysqli_query($conn, $fetch_problem_sql);


    $fetch_quiz_sql = "select * from file_quiz";
    $result_quiz = mysqli_query($conn, $fetch_quiz_sql);

    $sql_server = "select * from server where id = 1";
    $query_server = mysqli_query($conn, $sql_server);
    $result_server = mysqli_fetch_array($query_server);

} else {
    echo "<script>alert('Internal server failed !!')</script>";
    header("Refresh:0;url=http://alkornithm.com/grader/");
    exit;
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/backgroundAnimation.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/grader.css">
    <title>Alkornithm - อัลกอนนิทึม</title>
</head>

<body>
    <div class="container" id="backgroundMain">
        <div class="purple"></div>
        <div class="medium-blue"></div>
        <div class="light-blue"></div>
        <div class="red"></div>
        <div class="orange"></div>
        <div class="yellow"></div>
        <div class="cyan"></div>
        <div class="light-green"></div>
        <div class="lime"></div>
        <div class="magenta"></div>
        <div class="lightish-red"></div>
        <div class="pink"></div>
    </div>
    <div class="container" style="margin-top: 30px;">
        <!-- Image and text -->
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
            <a style="font-size:26pt;" class="navbar-brand" href="#"><img src="https://pvsmt99345.i.lithium.com/t5/image/serverpage/image-id/48429i2264E8B2F45475C1/image-dimensions/180x203?v=1.0" width="100"> &lt;/Alkornithm&gt;</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">
                            <i class="fa fa-desktop"></i>
                            โหมดฝึกหัด
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="disableQuiz(<?php echo $result_server['quiz_st'] ?>);">
                            <i class="fa fa-edit"></i>
                            Quiz
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./info.php">
                            <i class="fa fa-info"></i>
                            วิธีใช้
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-user-circle"></i>
                            <?php echo $_SESSION['name'] ?>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">
                            <button class="btn btn-danger my-2 my-sm-0">Log out</button>
                        </a>
                    </li>
                </ul>
            </div>

        </nav>
        <div class="container">
            <div class="row">
                <div class="col" style="background-color: gainsboro; padding:3vmin; ">
                    <h2>วิธีใช้ Grader</h2>
<p>1. การทดสอบ Quiz มีทั้งหมด 3 ข้อ (Sort/Search, Graph, Greedy) ข้อละ 5 Test cases </p>
                    <p>2.    หลังจากกดเริ่มโหมด Quiz แล้ว ระบบจะจับเวลา 2 ชั่วโมงนับตั้งแต่กดเริ่ม (ช่วง Quiz จะ<b><u>ไม่อนุญาตให้ลงทะเบียนผู้ใช้ใหม่ ป้องกันการแอบอ้าง account ซ้ำซ้อน เพื่อ Quiz หลายรอบ</b></u>)</p>
                  <p>  3.    ระบบจะยังจับเวลา ถึงแม้ผู้ใช้งานจะปิด Browser ก็ตาม</p>
                   <p> 4.    ระบบรองรับ Code ภาษา C++ เท่านั้น</p>
                   <p> 5.    โหมด Quiz จะเปิดใช้งานตั้งแต่ 2 ทุ่มครึ่งของวันที่ 4 กุมภาพันธ์ 2563 ถึงเที่ยงตรงของวันที่ 5 กุมภาพันธ์ 2563</p>
                   <p> 6.    Output จะปิดท้ายด้วยบรรทัดใหม่ทุกครั้ง ดังนั้นให้ใช้คำสั่ง endl ด้วย หรือ Output ที่มีหลายค่า ให้มีช่องว่าง ณ ตัวสุดท้ายด้วย</p>
                   <p> 7.    Grader มีผลการตรวจดังนี้</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp; o    “P” คือ Output ถูกต้อง และใช้เวลา Run ไม่เกินที่โจทย์กำหนด</p>
                 <p> &nbsp;&nbsp;&nbsp;&nbsp;  o    “T” คือ โปรแกรมใช้เวลา Run ที่โจทย์กำหนด</p>
                 <p> &nbsp;&nbsp;&nbsp;&nbsp;  o    “0” คือ Output ไม่ถูกต้อง</p>
                 <p> &nbsp;&nbsp;&nbsp;&nbsp;  o    อาจมีการตรวจ Code ด้วยมือจาก Admin ในบางข้อ เพื่อพิจารณาผลเมื่อส่ง Code เข้าระบบ</p>
                <p>    8.    ช่วงเวลา 2 ทุ่มถึง 5 ทุ่มของวันที่ 4 กุมภาพันธ์ 2563 สามารถมาเข้า Discord
                    ( <a href="https://discord.gg/TSdNyV">https://discord.gg/TSdNyV</a> - ห้องยำไข่ดาว (All)) เพื่อสอบถามโจทย์, Test case และถามผู้ใช้งานใน Discord ได้ตลอด</p>
                <p>    9.    ข้อสอบเป็นแบบเปิดตำรา และอนุญาตใช้เครื่องคำนวณได้</p>
                <p>    10.    โจทย์ Quiz จะอยู่ในโหมดฝึกหัดภายหลัง</p>
                <p>    11.    โหมดฝึกหัดจะเปิดใช้งานตลอด 24 ชั่วโมง และอาจมีการปรับปรุงระบบ ซึ่งจะใช้งานไม่ได้ในช่วงเวลานั้น</p>

                </div>
            </div>

            
        </div>


    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
    <script src="./checkpermission.js"></script>
</body>

</html>
