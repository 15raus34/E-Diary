let username = document.getElementById("username");
let securitycode = document.getElementById("securitycode");
let newpassword = document.getElementById("newpassword");
let againnewpassword = document.getElementById("againnewpassword");

username.addEventListener("blur",()=>{
    if(username.value.length<5 || username.value.length>11 || !isNaN(username.value.charAt(0))){
        console.log("Milena bro");
        document.getElementById("invalidU").style.display = "block";
    }
    else{
        document.getElementById("invalidU").style.display = "none";
    }
});

securitycode.addEventListener("blur",()=>{
    if(securitycode.value.length<4){
        console.log("Milena bro");
        document.getElementById("invalidSC").style.display = "block";
    }
    else{
        document.getElementById("invalidSC").style.display = "none";
    }
});

newpassword.addEventListener("blur",()=>{
    if(newpassword.value.length<5){
        console.log("Milena bro");
        document.getElementById("invalidPW").style.display = "block";
    }
    else{
        document.getElementById("invalidPW").style.display = "none";
    }
});

againnewpassword.addEventListener("blur",()=>{
    if(newpassword.value != againnewpassword.value){
        console.log("Milena bro");
        document.getElementById("invalidRPW").style.display = "block";
    }
    else{
        document.getElementById("invalidRPW").style.display = "none";
    }
});