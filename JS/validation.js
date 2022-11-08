let firstname = document.getElementById("firstname");
let lastname = document.getElementById("lastname");
let username = document.getElementById("username");
let password = document.getElementById("password");
let repassword = document.getElementById("repassword");
let aggrement = document.getElementById("aggrement");

firstname.addEventListener("blur",()=>{
    if(firstname.value.length<3 || firstname.value.length>15 || !isNaN(firstname.value.charAt(0))){
        console.log("Milena bro");
        document.getElementById("invalidF").style.display = "block";
    }
    else{
        document.getElementById("invalidF").style.display = "none";
    }
});

lastname.addEventListener("blur",()=>{
    if(lastname.value.length<3 || lastname.value.length>15 || !isNaN(lastname.value.charAt(0))){
        console.log("Milena bro");
        document.getElementById("invalidL").style.display = "block";
    }
    else{
        document.getElementById("invalidL").style.display = "none";
    }
});

username.addEventListener("blur",()=>{
    if(username.value.length<5 || username.value.length>11 || !isNaN(username.value.charAt(0))){
        console.log("Milena bro");
        document.getElementById("invalidU").style.display = "block";
    }
    else{
        document.getElementById("invalidU").style.display = "none";
    }
});

password.addEventListener("blur",()=>{
    if(password.value.length<5){
        console.log("Milena bro");
        document.getElementById("invalidPW").style.display = "block";
    }
    else{
        document.getElementById("invalidPW").style.display = "none";
    }
});

repassword.addEventListener("blur",()=>{
    if(password.value != repassword.value){
        console.log("Milena bro");
        document.getElementById("invalidRPW").style.display = "block";
    }
    else{
        document.getElementById("invalidRPW").style.display = "none";
    }
});

aggrement.addEventListener("click",()=>{
    if(aggrement.checked){
        document.getElementById("signupbtn").disabled = false;
    }
    else{
        document.getElementById("signupbtn").disabled = true;
    }
})