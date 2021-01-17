<?php
    require_once("../database/database.php");
     if (isset($_POST['turnonBtn'])) {
        turnOn();
    }
    else if(isset($_POST['turnoffBtn'])) {
        turnOff();
    }
    else if(isset($_POST['turnonqBtn'])) {
        turnOnq();
    }
    else if(isset($_POST['turnoffqBtn'])) {
        turnOffq();
    }
    else if(isset($_POST['defaultModeBtn'])) {
        onChangeDefaultMode();
    }
    else if(isset($_POST['quizModeBtn'])) {
        onChangeQuizMode();
    }
    header("Refresh:0;url=./admin.php");
    function turnOn() {
        global $conn;
        mysqli_query($conn, "update server set server_st='1' where id = 1");
        echo "<script>alert('Turn on')</script>";
    }
    function turnOff() {
        global $conn;
        mysqli_query($conn, "update server set server_st='0' where id = 1");
        echo "<script>alert('Turn off')</script>";
    }
    function turnOnq() {
        global $conn;
        mysqli_query($conn, "update server set quiz_st='1' where id = 1");
        echo "<script>alert('Turn on Quiz mode')</script>";
    }
    function turnOffq() {
        global $conn;
        mysqli_query($conn, "update server set quiz_st='0' where id = 1");
        echo "<script>alert('Turn off Quiz mode')</script>";
    }   
    function onChangeDefaultMode() {
        global $conn;
        mysqli_query($conn, "update server set quiz_table='default' where id = 1");   
    }
    function onChangeQuizMode() {
        global $conn;
        mysqli_query($conn, "update server set quiz_table='quiz' where id = 1");       
    }
 

?>