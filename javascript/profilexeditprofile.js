function validate(inputId,errId){
    var inputElement = document.getElementById(inputId);
    var inputError = document.getElementById(errId);
    
// console.log(inputId);

    if(inputElement.value.length== "" )
    {
        inputError.style.display="block";
        inputError.style.color="red";
        inputError.innerHTML="cannot be empty";
      
    }
    else{
        inputError.style.display="none";
        // inputError.style.color="black";
        // inputError.innerHTML="correct";
    }

}

function validate1(inputId,errId){
    var inputElement = document.getElementById(inputId);
    var inputError = document.getElementById(errId);
    
// console.log(inputId);

    if(inputElement.value.length== "" )
    {
        inputError.style.display="block";
        inputError.style.color="red";
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
        x.style.color="black";
        x.innerHTML="password match";
    }
    else{
        x.style.display="block";
        x.style.color="red";
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
   
    if(check.value.length == "" || check1.value.length == "" || check2.value.length == "" || check3.value.length == "" || check4.value.length == "" || check5.value.length == "" || check6.value.length == ""  || (check5.value != check6.value)){
       
        document.getElementById(idw).style.display="block";
        document.getElementById(idw).style.color="red";
        document.getElementById(idw).innerHTML="check input fields";
        
        return false
    }
    else return true;
}

function x(inputId,errId,inputId1,errId1){
    var inputElement = document.getElementById(inputId);
    var inputError = document.getElementById(errId);

    var inputElement1 = document.getElementById(inputId1);
    var inputError1 = document.getElementById(errId1);
    
// console.log(inputId);

    if(inputElement.value.length== "" )
    {
        inputError.style.display="block";
        inputError.style.color="red";
        inputError.innerHTML="cannot be empty";
        sta=false;
      
    }
    else{
        inputError.style.display="none";
        sta=true;
        
    }

    if(inputElement1.value.length== "" )
    {
        inputError1.style.display="block";
        inputError1.style.color="red";
        inputError1.innerHTML="cannot be empty";
        sta=false;
      
    }
    else{
        inputError1.style.display="none";
        sta=true;
        
    }

document.getElementById('sub').disabled = !sta;
}


function x1(inputId1,errId1,inputId11,errId11){
    var inputElement1 = document.getElementById(inputId1);
    var inputError1 = document.getElementById(errId1);

    var inputElement11 = document.getElementById(inputId11);
    var inputError11 = document.getElementById(errId11);
    
// console.log(inputId);

    if(inputElement.value.length== "" )
    {
        inputError1.style.display="block";
        inputError1.style.color="red";
        inputError1.innerHTML="cannot be empty";
        sta1=false;
      
    }
    else{
        inputError1.style.display="none";
        sta1=true;
        
    }

    if(inputElement11.value.length== "" )
    {
        inputError11.style.display="block";
        inputError11.style.color="red";
        inputError11.innerHTML="cannot be empty";
        sta1=false;
      
    }
    else{
        inputError11.style.display="none";
        sta1=true;
        
    }

document.getElementById('sub1').disabled = !sta1;
}


function xxx(idw1){
    var check= document.getElementById('title');
    var check1 = document.getElementById('des');

    // var check7 = document.getElementById('agree');
   
    if(check.value.length == "" || check1.value.length == "" ){
       
        document.getElementById(idw1).style.display="block";
        document.getElementById(idw1).style.color="red";
        document.getElementById(idw1).innerHTML="check input fields";
        
        return false
    }
    else return true;
}

