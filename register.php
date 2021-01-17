<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css"
        integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link rel="stylesheet" type="text/css" href="./css/backgroundAnimation.css">
    <title>Hello, world!</title>
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

    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card" style="height: 70%;">
                <div class="card-header">
                    <h3>C++ Auto Judge<br>
                    <h5 style="color:white;">ระบบลงทะเบียน</h5>
                    
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-yelp"></i></span>
<!--                         <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span> -->
                    </div>
                </div>
                <div class="card-body">
                    <form action="./submission-submit.php" method="POST">
                        <!-- sID form -->
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                            </div>
                            <input type="text" name="sid" class="form-control" placeholder="ชื่อผู้ใช้งาน"  require>
                        </div>
                        <!-- username form -->
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="ชื่อ - นามสกุล" require>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-child"></i></span>
                            </div>
                            <input type="text" name="nickname" class="form-control" placeholder="ชื่อเล่น" require>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="กรอกรหัสผ่าน" require>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="confirm_password" class="form-control" placeholder="กรอกรหัสผ่านอีกครั้ง" require>
                        </div><br><br>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" value="ยืนยัน" class="btn float-right login_btn btn-block" require>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>