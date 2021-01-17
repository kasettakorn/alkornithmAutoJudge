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
    $now = new DateTime();
    $datenow = $now->format('Y-m-d H:i:s');
    if ($result_server['quiz_st'] == 0) {
        echo "<script>alert('ยังไม่เปิดให้ Quiz !!')</script>";
        header("Refresh:0;url=./index.php");
        exit;
    }

/*     else if(!is_null($row['expireTime']) && $datenow > $row['expireTime']) {
        echo "<script>alert('หมดเวลาทำ Quiz !!')</script>";
        header("Refresh:0;url=./index.php");
        exit;       
        
    }
    else if(is_null($row['expireTime'])){

        $now->add(new DateInterval('PT2H'));
        $expired = $now->format('Y-m-d H:i:s');
        mysqli_query($conn, "update student set startTime='" . $datenow . "' where username='" . $_SESSION['username'] . "'");
        mysqli_query($conn, "update student set expireTime='" . $expired . "' where username='" . $_SESSION['username'] . "'");
    } */
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
    <title>Auto Judge C++</title>
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
            <a style="font-size:26pt;" class="navbar-brand" href="#"><img class="bannerimg" src="https://image.flaticon.com/icons/svg/766/766685.svg" width="100"> Auto Judge</a>
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
                        <a class="nav-link active" href="#" onclick="disableQuiz(<?php echo $result_server['quiz_st'] ?>);">
                            <i class="fa fa-edit"></i>
                            Quiz
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./info.php">
                            <i class="fa fa-info"></i>
                            วิธีใช้
                        </a>
                    </li>
                    <!--       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-envelope-o">
             <span class="badge badge-primary">11</span>
          </i>
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
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

            <?php

            for ($q = 1; $q <= mysqli_num_rows($result_problem); $q++) {
                $row_problem = mysqli_fetch_assoc($result_problem);

                echo '<div class="row">
                        
                    <div class="col" style="background-color: gainsboro; padding:3vmin; " >';
                if ($q == 1) {
                    $row_quiz = mysqli_fetch_assoc($result_quiz);

                    echo '<div><a href="./upload/Q2Grader.pdf" target="_blank"><button class="btn btn-primary problem-btn">กดดูโจทย์</button></a><br><br>';
/*                     echo '<h3 id="timer" style="float:right">หมดเวลาในเวลา '.$row['expireTime'].'</h3></div><br><br>';
 */
                    /* echo '<!-- Large modal -->
                        <button type="button" class="btn btn-primary problem-btn" data-toggle="modal" data-target=".bd-example-modal-lg">กดดูโจทย์</button>
                        
                        <div class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">โจทย์ Grader</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                                ';
                        echo '<object data="data:application/pdf;base64,'.base64_encode($row_quiz['data']).'" type="application/pdf" style="height:700px;width:100%"></object>';
                        echo '</div>
                        
                          </div>
                        </div><br><br>'; */
                }

                echo '<div class="accordion-inner">

                        <table class="table table-bordered table-condensed"
                                            style="font-size: 12pt;">
                                            <tbody>
                                                <tr>
                                                    <th rowspan="2"
                                                        style="text-align: center; background-color:#ffeeba; vertical-align:middle; ">
                                                    Test Case
                                                    </th>
                                                    <th colspan=' . $row_problem['test_case'] . '
                                                        style="text-align: center; vertical-align:top; background-color:#bee5eb; width:60%;">
                                                        ' . $q . ". " . $row_problem['name'] . '</th>
                                                    <th rowspan="2"
                                                        style="text-align: center; background-color:#ffc57e; vertical-align:middle; ">
                                                        คะแนนรวม
                                                    </th>
                                                </tr>
                                                <tr>';
                for ($i = 1; $i <= $row_problem['test_case']; $i++) {
                    echo "<th
                                                            style='text-align: center; vertical-align:top; background-color:#fcf8e3;'>
                                                            $i</th>";
                }

                echo '</tr>
                                                <tr>
                                                    <th
                                                        style="text-align: center; background-color:#fdfdfe; vertical-align:middle;">
                                                        ผลการตรวจ
                                                    </th>';
                for ($i = 0; $i < $row_problem['test_case']; $i++) {
                    $color = "";
                    if ($row["resultq$q"]{
                        $i} == 'P') {
                        $color = "#c3e6cb";
                    } else if ($row["resultq$q"]{
                        $i} == '-') {
                        $color = "#fdfdfe";
                    } else {
                        $color = "#f2dede";
                    }
                    echo '<td style="text-align: center; vertical-align:top; background-color:' . $color . '; vertical-align:bottom;">' . $row["resultq$q"]{
                        $i} . '</td>';
                }

                echo '<th class="score" rowspan="2"
                                                        style="text-align: center; font-size:18pt; background-color:#fdfdfe; vertical-align:middle;">' . $row["scoreq$q"] . '</th>';
                echo '</tr>
                                                    <tr>
                                                        <th
                                                            style="text-align: center; background-color:#fdfdfe; vertical-align:middle;">
                                                            คะแนน
                                                        </th>';

                for ($i = 0; $i < $row_problem['test_case']; $i++) {
                    $temp = 0;
                    $color = "";
                    if ($row["resultq$q"]{
                        $i} == 'P') {
                        $temp = 10;
                        $color = "#c3e6cb";
                    } else if ($row["resultq$q"]{
                        $i} == '-') {
                        $color = "#fdfdfe";
                    } else {
                        $color = "#f2dede";
                    }
                    echo '<td style="text-align: center; vertical-align:top; background-color:' . $color . '; vertical-align:bottom;">' . $temp;
                    echo '</td>';
                }


                echo '</tr></tbody>';
                echo ' </table>
                                            <div class="" style="margin-top:0px; float:right;">
                                                <form action="./process.php"
                                                    method="POST" enctype="multipart/form-data"
                                                    style="margin-bottom: 0px; margin-top: 0px;">
                                                    <input type="hidden" name="quiz" id="quiz" value=' . $q . '>
                                                    <input type="hidden" name="quiz_name" id="quiz_name" value=' . $row_problem['name'] . '>
                                                    <input type="hidden" name="test_case" id="test_case" value=' . $row_problem['test_case'] . '>
                                                    <input type="hidden" name="timeout" id="timeout" value=' . $row_problem['timeout'] . '>
                                                    <input type="file" class="btn btn-dark" name="code" id="code" accept=".cpp, .c">
                                                    <input type="submit" prob="ConCount" class="btn btn-success"
                                                        name="submit" value="Submit">
                                                </form>
                                            </div><br><br><br>
                                    </div>';
            }
            ?>

        </div>





        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
        <script src="./checkpermission.js"></script>
 


</body>

</html>
