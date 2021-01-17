<?php
    require_once("../database/database.php");
    $fetch_quiz_sql = "select * from file_quiz";
    $result_quiz = mysqli_query($conn, $fetch_quiz_sql);
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab</title>
</head>
<body>
    <object data="data:application/pdf;base64,<?php $row = mysqli_fetch_assoc($result_quiz); echo base64_encode($row['data']) ?>"  type="application/pdf" style="height:700px;width:100%"></object>
</body>
</html>