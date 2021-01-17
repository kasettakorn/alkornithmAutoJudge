<?php
    session_start();
    require_once("./database/database.php");
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $sql = "select * from student where username='" . $username . "' and password='" . $password . "'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $sql_server = "select * from server where id = 1";
    $query_server = mysqli_query($conn, $sql_server);
    $result_server = mysqli_fetch_array($query_server);

    if (!$_POST['submit'] || $_POST['username'] == "" || $_POST['password'] == "") {
        echo "<script>alert('No value input')</script>";
        header("Refresh:0; url=index.php");
        exit;
    } 
    else if ($result['class'] != 1 && $result_server['server_st'] == 0) {
        header("Refresh:0;url=error/serverclose.html");
        session_destroy();
        exit;
    } 
    else {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } 
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } 
        else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
            if (!$result) {
                echo "<script>alert('รหัสประจำตัวนักศึกษา หรือ รหัสผ่านไม่ถูกต้อง')</script>";
                header("Refresh:0 , url=index.php");
            } else {
                if ($result['server'] == 1) {
                    if ($result['ip'] != $ip_address && $result['ip'] != "" && $result_server['ban'] == 1) {
                        $check_login = "update student set ban='0' where username='" . $username . "'";
                        if ($conn->query($check_login) === TRUE) {
                            echo "<script>alert('ban !!!')</script>";
                            header("Refresh:0;url=index.php");
                        }
                    } else if ($result['class'] == 1) {
                        $check_login = "update student set ip='" . $ip_address . "' where username='" . $username . "'";
                        if ($conn->query($check_login) === TRUE) {
                            setcookie('admin', $result['username'], time() + 3600, "/"); // 3600 = 1 hour
                            $_SESSION['username'] = $result['username'];
                            $_SESSION['admin'] = 'Korn8162079';
                            $_SESSION['name'] = $result['name'];
                            $_SESSION['status'] = $result['status'];
                            header("location: autojudge/admin.php");
                            session_write_close();
                        } else {
                            echo "<script>alert('เก็บค่า Login ไม่ได้')</script>";
                            header("Refresh:0;url=index.php");
                        }
                    } else {
                        $check_login = "update student set ip='" . $ip_address . "' where username='" . $username . "'";
                        if ($conn->query($check_login) === TRUE) {
                            setcookie('student', $result['username'], time() + 3600, "/"); // 3600 = 1 hour
                            $_SESSION['username'] = $result['username'];
                            $_SESSION['class'] = $result['class'];
                            $_SESSION['name'] = $result['name'];
                            $_SESSION['status'] = $result['status'];
                            header("location: autojudge/");
                            session_write_close();
                        } else {
                            echo "<script>alert('เก็บค่า Login ไม่ได้')</script>";
                            header("Refresh:0;url=index.php");
                        }
                    }
                } else {
                    echo "<script>alert('Your user closed')</script>";
                    header("Refresh:0;url=./index.php");
                }
            }
    }
    mysqli_close($conn);
?>
