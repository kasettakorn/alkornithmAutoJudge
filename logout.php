<?php   
    session_start(); 
    session_destroy();
    setcookie("student", "", time() - 3600, "/");
    setcookie("admin", "", time() - 3600, "/");
    
    header("Location: http://alkornithm.com/grader/");
    exit();
?>
