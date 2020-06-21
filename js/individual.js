function CheckPassword() {
    let new_password=document.getElementById("new_password");
    let ConfirmPassword=document.getElementById('ConfirmPassword');
    if(new_password.value==="undefined"||new_password.value==null||new_password.value===""){
        new_password.classList.remove('is-valid');
        new_password.classList.add('is-invalid');
    }else {
        new_password.classList.remove('is-invalid');
        new_password.classList.add('is-valid');
    }

    if(ConfirmPassword.value!==new_password.value){
        ConfirmPassword.classList.remove('is-valid');
        ConfirmPassword.classList.add('is-invalid');
    }else {
        ConfirmPassword.classList.remove('is-invalid');
        ConfirmPassword.classList.add('is-valid');
    }

}

function CheckEmail(){
    let new_email=document.getElementById('new_email');
    if(new_email.value==="undefined"||new_email.value==null||new_email.value===""){
        new_email.classList.remove('is-valid');
        new_email.classList.add('is-invalid');
    }else {
        new_email.classList.remove('is-invalid');
        new_email.classList.add('is-valid');
    }
}

function CheckNickname(){
    let new_nickname=document.getElementById('new_nickname');
    if(new_nickname.value==="undefined"||new_nickname.value==null||new_nickname.value===""){
        new_nickname.classList.remove('is-valid');
        new_nickname.classList.add('is-invalid');
    }else {
        new_nickname.classList.remove('is-invalid');
        new_nickname.classList.add('is-valid');
    }
}

function RemoveMessage(id){

}

setInterval(CheckPassword,1000);
setInterval(CheckEmail,1000);
setInterval(CheckEmail,1000);