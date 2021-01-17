function disableQuiz(status) {
    if(status == 0) {
        alert("ยังไม่เปิดให้ Quiz !!");
    }
    else {
        window.location.href = "./quiz.php";
    }
    
  }