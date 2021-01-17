<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set("Asia/Bangkok");
require_once "../database/database.php";
$sql_server = "select * from server where id = 1";
$query_server = mysqli_query($conn, $sql_server);
$result_server = mysqli_fetch_array($query_server);
$totalMode = "";
$scoreMode = "";
$resultMode = "";
if ($result_server['quiz_table'] == 'quiz') {
    $totalMode = 'totalq';
    $scoreMode = 'scoreq';
    $resultMode = 'resultq';
}
else {
    $totalMode = 'totald';
    $scoreMode = 'scored';
    $resultMode = 'resultd';
}
if (!isset($_COOKIE['admin'])) {
    echo "<script>alert('กรุณา Login ด้วย Admin !!!')</script>";
    header("Refresh:0;url=./index.php");
    exit;
}
$fetch_student_sql = "select * from student where class != 1 order by $totalMode desc";
$result_student =  mysqli_query($conn, $fetch_student_sql);

$fetch_problem_sql = "select * from problem where type='".$result_server['quiz_table']."' or type='puzzle'";
$result_problem = mysqli_query($conn, $fetch_problem_sql);

$fetch_quiz_sql = "select * from file_quiz";
$result_quiz = mysqli_query($conn, $fetch_quiz_sql);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/backgroundAnimation.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/grader.css">
    <link rel="stylesheet" type="text/css" href="../css/toggle.css">
    <title>Auto Judge C++ (Admin)</title>
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
        <a style="font-size:26pt;" class="navbar-brand" href="#"><img
                    src="https://image.flaticon.com/icons/svg/766/766685.svg" width="100"> &lt;/Alkornithm&gt; (Proctor)</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">

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
                <div class="col" style="background-color: gainsboro; padding:3vmin; -ms-flex-preferred-size: 0; flex-basis: 0; -ms-flex-positive: 1; flex-grow: 1; overflow-x: scroll; max-width: 100%; padding: 10px;">
                <div class="row">
                    <div class="col">
                        <form class="form-inline" action="./checkgrader.php" method="POST">
                            <button type="submit" name="defaultModeBtn" class="btn btn-success mx-sm-3 mb-2">โหมดฝึกหัด</button>
                            <button type="submit" name="quizModeBtn" class="btn btn-danger mb-2">Quiz</button>
                            <button type="button" class="btn btn-primary mx-sm-3 mb-2"  data-toggle="modal" data-target=".bd-example-modal-lg">เพิ่มโจทย์</button>

                        </form>
                    </div>
                </div><br>
                    <table class="table table-bordered table-condensed">
                        <tbody>
                            <tr>
                                <th rowspan="2" style="text-align: center; background-color:#dff0d8; vertical-align:middle; ">
                                    ลำดับ

                                </th>
                                <th rowspan="2" style="text-align: center; background-color:#dff0d8; vertical-align:middle; ">
                                    ชื่อ - นามสกุล

                                </th>
                                <th rowspan="2" style="text-align: center; background-color:#dff0d8; vertical-align:middle; ">
                                    ชื่อเล่น

                                </th>
                                <th colspan="<?php echo mysqli_num_rows($result_problem) ?>" style="text-align: center; background-color:#dff0d8; vertical-align:middle; ">
                                    Problem

                                </th>
                                <th rowspan="2" style="text-align: center; background-color:#dff0d8; vertical-align:middle; ">
                                    คะแนนรวม
                                </th>
                            </tr>
                            <tr>
                                <?php
                                while ($problem = mysqli_fetch_assoc($result_problem)) {
                                    echo '<th style="text-align: center; background-color:#fcf8e3;">' .
                                        $problem['name'] .
                                        '</th>';
                                }
                                ?>


                            </tr>
                            <?php
                            echo "<tr>";
                            $j = 1;

                            while ($row = mysqli_fetch_assoc($result_student)) {
                                $color = "";
                                if ($j == 1) {
                                    $color = "#aff2bb";
                                } else if ($j == 2) {
                                    $color = "#afd4f2";
                                } else if ($j == 3) {
                                    $color = "#fcc479";
                                } else {
                                    $color = "#f2deaf";
                                }
                                echo '<td style="text-align: center; background-color:' . $color . ';">' . $j . '</td>';
                                $score = 0;
                                echo '<td style="text-align: center; background-color:' . $color . ';">' . $row['name'] . '</td>';
                                echo '<td style="text-align: center; background-color:' . $color . ';">' . $row['nickname'] . '</td>';
                                for ($i = 1; $i <= mysqli_num_rows($result_problem); $i++) {
                                    echo '<td style="text-align: center; background-color:' . $color . ';">';
                                    
                                    // if ($row["scorep$i"] != 0) echo '✅<br>';
                                
                                    // else  echo '❌<br>';
                                    echo $row[$resultMode."".$i] . '</td>';
                                    $score += $row[$scoreMode."" . $i];
                                }
                                mysqli_query($conn, "update student set ".$totalMode."='" . $score . "' where username='" . $row['username'] . "'");
                                echo '<td style="text-align: center; background-color:' . $color . ';">' . $score . '</td></tr>';
                                $j++;
                            }

                            ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <form class="form-inline" action="./checkgrader.php" method="POST">
                                <div class="form-group">
                                    <label for="staticEmail2" class="sr-only">Email</label>
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="เปิด - ปิด Grader">
                                </div>
                                <div class="form-group">
                                    <input type="text" readonly class="form-control" value="<?php echo $result_server['server_st']; ?>">
                                </div>
                                <button type="submit" name="turnonBtn" class="btn btn-success mx-sm-3 mb-2"><i class="fas fa-check-circle"></i></button>
                                <button type="submit" name="turnoffBtn" class="btn btn-danger mb-2"><i class="fas fa-times-circle"></i></button>
                            </form>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <form class="form-inline" action="./checkgrader.php" method="POST">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="เปิด - ปิด Quiz">
                                </div>
                                <div class="form-group">
                                    <input type="text" readonly class="form-control" value="<?php echo $result_server['quiz_st']; ?>">
                                </div>
                                <button type="submit" name="turnonqBtn" class="btn btn-success mx-sm-3 mb-2"><i class="fas fa-check-circle"></i></button>
                                <button type="submit" name="turnoffqBtn" class="btn btn-danger mb-2"><i class="fas fa-times-circle"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col">
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มโจทย์</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="./problem.php" method="POST">
                                            <div class="modal-body">
                                            
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="usr">ชื่อโจทย์:</label>
                                                            <input type="text" class="form-control" id="problemName" name="problemName" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="usr">เวลาประมวลผลสูงสุด (วินาที):</label>
                                                            <input type="number" min="1" class="form-control" id="timeout" name="timeout" required>
                                                        </div>
                                                        <!-- <div class="col">
                                                            <div class="form-group">
                                                                <label for="usr">ภาควิชา:</label>
                                                                <select class="form-control" name="department" id="department" placeholder="ภาควิชา">
                                                                    <option value="CS">CS - ComSci</option>
                                                                    <option value="CprE">Cpr.E - Com Eng.</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <hr style="border:1px dashed red;">
                                                    <?php
                                                        $emoji = ['1️⃣', '2️⃣', '3️⃣', '4️⃣', '5️⃣'];
                                                        for ($i=1; $i <= 5; $i++) { 
                                                            echo '<div class="row">
                                                                    <div class="col">
                                                                        <label for="testcase">ข้อมูลนำเข้าที่ '.$emoji[$i-1].':</label>
                                                                        <textarea class="form-control" rows="3" id="testcase'.$i.'" name="testcase'.$i.'" required></textarea>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="output">ข้อมูลส่งออกที่ '.$emoji[$i-1]. ':</label>
                                                                        <textarea class="form-control" rows="3" id="output'.$i.'" name="output'.$i.'" required></textarea>

                                                                    </div>
                                                                </div>';
                                                        }
                                                    ?>
                                                    
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                                <input type="submit"  class="btn btn-success" id="submit" value="บันทึก"></input>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>


</html>
