//FUnction to Check password must be at least 6 Character
var p1 = document.getElementById('pass');
const button = document.querySelector('button')

function checkChar(){
    var pwMsg = document.getElementById('pwMsg');
    if(p1.value.length < 6){
        p1.classList.add("is-invalid");
        pwMsg.innerHTML = "Password must be at least 6 character";
        button.disabled = true;
    }else{
        p1.classList.remove("is-invalid");
        pwMsg.innerHTML = "";
        button.disabled = false;
    }
}


//Function to Check Password and Re-type Password
function checkPw(){
    
    var p2 = document.getElementById('pass2');
    var msgErr = document.getElementById('msgErrPass');
    
    if(p1.value != p2.value){
        p2.classList.add("is-invalid");
        msgErr.innerHTML = "Password Not Match";
        button.disabled = true;
    }else{
        p2.classList.remove("is-invalid");
        msgErr.innerHTML = "";
        button.disabled = false;
    }
}



//Function to set KPK Limit Char
function limit(element, max_chars)
{
    if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
    }
}
function minmax(value, min, max) 
{
    if(parseInt(value) < min || isNaN(parseInt(value))) 
        return 0; 
    else if(parseInt(value) > max) 
        return 100; 
    else return value;
}

var pw1 = document.getElementById('new_password');
function checkChar2(){
    var pwMsg = document.getElementById('pwMsg');
    if(pw1.value.length < 6){
        pw1.classList.add("is-invalid");
        pwMsg.innerHTML = "Password must be at least 6 character";
        button.disabled = true;
    }else{
        pw1.classList.remove("is-invalid");
        pwMsg.innerHTML = "";
        button.disabled = false;
    }
}
//Function to Check Password and Re-type Password
function checkPw2(){
    
    var pw2 = document.getElementById('renew_password');
    var msgErr = document.getElementById('msgErrPass');
    
    if(pw1.value != pw2.value){
        pw2.classList.add("is-invalid");
        msgErr.innerHTML = "Password Not Match";
        button.disabled = true;
    }else{
        pw2.classList.remove("is-invalid");
        msgErr.innerHTML = "";
        button.disabled = false;
    }
}