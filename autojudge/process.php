<?php
    session_start();
    require_once "../database/database.php";
    $sql_server = "select * from server where id = 1";
    $query_server = mysqli_query($conn, $sql_server);
    $result_server = mysqli_fetch_array($query_server);
    $quiz_name = $_POST['quiz_name'];
    if ($result_server['server_st'] == 0) {
        header("Refresh:0;url=../logout.php");
        exit;
    } 
    $type = strrchr($_FILES['code']['name'], ".");
    if ($_FILES["code"]["tmp_name"] == "") {
        echo "<script>alert('กรุณาแนบ Code C++ !!')</script>";
        header("Refresh:0;url=./quiz.php");

    }
    else if ($type != ".cpp") {
        echo "<script>alert('นามสกุลไฟล์ไม่ถูกต้อง กรุณาอัปโหลด Code C++ !!')</script>";
        header("Refresh:0;url=./quiz.php");

    }
    else if(is_uploaded_file($_FILES["code"]["tmp_name"])) {

        if(!is_dir("upload/".$_SESSION['username']."/".$quiz_name)) {
            exec("cd upload/; mkdir ".$_SESSION['username']);
            exec("cd upload/".$_SESSION['username']."/; mkdir ".$quiz_name);
        }
        if(move_uploaded_file($_FILES["code"]["tmp_name"], "upload/".$_SESSION['username']."/".$quiz_name."/".$_FILES["code"]["name"])) {

            exec("cd upload/".$_SESSION['username']."/".$quiz_name."/; g++ -c ".$_FILES['code']['name'].";g++ -o main.exe ".pathinfo($_FILES["code"]["name"], PATHINFO_FILENAME).".o");
            $resultstr = "";
            
            $score = 0;
            for ($i=1; $i <= $_POST['test_case']; $i++) {
                $startTime = microtime(true);
                $output = shell_exec("cd upload/".$_SESSION['username']."/".$quiz_name."/; ulimit -t ".$_POST['timeout']."; ./main.exe < ../../../solution/$quiz_name/$quiz_name$i.in");
                $endTime = microtime(true);
                $objOpen = fopen(__DIR__ . "/upload/".$_SESSION['username']."/".$quiz_name."/sol.sol", "w");
                fwrite($objOpen, $output);
                fclose($objOpen);
                $duration = $endTime - $startTime;
                $duration = sprintf('%0.2f', $duration);
                $userOutput = file_get_contents("./upload/".$_SESSION['username']."/".$quiz_name."/sol.sol");
                $userOutput = explode(PHP_EOL, $userOutput);
                $answerOutput = file_get_contents("./solution/$quiz_name/$quiz_name$i.sol");
                $answerOutput = explode(PHP_EOL, $answerOutput);

                if ($duration > $_POST['timeout']) {
                    $resultstr = $resultstr."T";
                }
                else if ($userOutput == $answerOutput) {
                    $resultstr = $resultstr."P";
                    $score += 10;
                    
                    
                }
                else {
                    $resultstr = $resultstr."0";
                
                }
                exec("cd upload/".$_SESSION['username']."/".$quiz_name."/;rm -rf sol.sol");
            }
            $update_sql = "update student set resultq".$_POST['quiz']."='".$resultstr."', scoreq".$_POST['quiz']."=".$score." where username='".$_SESSION['username']."'";
            mysqli_query($conn, $update_sql);
            
            exec("cd upload/".$_SESSION['username']."/".$quiz_name."/; rm -rf main.exe");
            exec("cd upload/".$_SESSION['username']."/".$quiz_name."/; rm -rf ".pathinfo($_FILES["code"]["name"], PATHINFO_FILENAME).".o");
            //exec(" cd upload/".$_SESSION['username']."; rm -rf ".$_FILES["code"]["name"]);
            header("Refresh:0;url=./quiz.php");
        }
        else {
            echo "<script>alert('Failed')</script>";
            header("Refresh:0;url=./quiz.php");
        }
    }
    else {
        echo "<script>alert('Internal server failed !!')</script>";
        header("Refresh:0;url=./index.php");
    }
?>
