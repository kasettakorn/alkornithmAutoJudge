<?php
    require_once("./database/database.php");
    $sql_server = "select * from server where id = 1";
    $query_server = mysqli_query($conn, $sql_server);
    $result_server = mysqli_fetch_array($query_server);
   /* if ($result_server['server_st'] == 0) {
        header("Refresh:0;url=error/serverclose.html");
        session_destroy();
        exit;
    }*/
    if (isset($_COOKIE['admin'])) {
        header("location: autojudge/admin.php");
    }
    else if (isset($_COOKIE['student'])) {
        header("location: autojudge/");
    }

?>
<!doctype html>
<html lang="en">

<head>
    <script language="javascript" type="text/javascript">
        window.history.forward();
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Circle-icons-computer.svg/1200px-Circle-icons-computer.svg.png">
    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link rel="stylesheet" type="text/css" href="./css/backgroundAnimation.css">
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
        <div></div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3 style='font-family: "Lucida Console", Courier, monospace;'>&lt;/Alkornithm&gt;</h3>
                </div>
                <div class="card-body">
                    <form action="./checklogin.php" method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
                        </div>
                        <div id="submit_btn" class="form-group">
                            <input type="submit" name="submit" value="เข้าสู่ระบบ" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        เด็กหน้าใหม่ใช่มั้ย?<a href="./register.php">ลงทะเบียน</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="./forgot.php">ลืมรหัสผ่านหรอคุณอ่ะ?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
