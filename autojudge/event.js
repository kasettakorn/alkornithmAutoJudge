function onChangeCheckbox(id) {
    var checkbox = document.getElementById(id);
    if (checkbox.checked) {
        document.getElementById("answerForm").style.display = block;
    }
    else {
        document.getElementById("answerForm").style.display = none;
  
    }
}