function validate(inputId,errId){
    var inputElement = document.getElementById(inputId);
    var inputError = document.getElementById(errId);
    
// console.log(inputId);

    if(inputElement.value.length== "" )
    {
        inputError.style.display="block";
        inputError.style.color="blue";
        inputError.innerHTML="cannot be empty";
      
    }
    else{
        inputError.style.display="block";
        inputError.style.color="black";
        inputError.innerHTML="correct";
    }

}

function validate2(idw){
    var check= document.getElementById('x');
    var check1 = document.getElementById('pwd')
    if(check.value.length == "" && check1.value.length == ""){
        
        document.getElementById(idw).style.display="block";
        document.getElementById(idw).style.color="yellow";
        document.getElementById(idw).innerHTML="please check the input fields";
        
        return false
    }
    else return true;
}

