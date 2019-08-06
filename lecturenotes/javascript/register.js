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

function validate1(inputId,errId){
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
        xx();
    }

}

function xx(){
    var pass1= document.getElementById('pass').value;
    var pass12= document.getElementById('rpass').value;
    var x = document.getElementById('x');
    if(pass1==pass12){
        x.style.display="block";
        x.style.color="green";
        x.innerHTML="password match";
    }
    else{
        x.style.display="block";
        x.style.color="black";
        x.innerHTML="password mismatch";
    }
}


function validate2(idw){
    var check= document.getElementById('fname');
    var check1 = document.getElementById('lname');
    var check2 = document.getElementById('user');
    var check3 = document.getElementById('email');
    var check4 = document.getElementById('phone');
    var check5 = document.getElementById('pass');
    var check6 = document.getElementById('rpass');
    // var check7 = document.getElementById('agree');
   
    if(check.value.length == "" || check1.value.length == "" || check2.value.length == "" || check3.value.length == "" || check4.value.length == "" || check5.value.length == "" || check6.value.length == ""){
        
        document.getElementById(idw).style.display="block";
        document.getElementById(idw).style.color="yellow";
        document.getElementById(idw).innerHTML="please check the input fields";
        
        return false
    }
    else return true;
}

