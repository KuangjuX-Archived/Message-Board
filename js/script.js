function change(url="#") {
    document.querySelector('body').style.opacity=0;
    setTimeout(function () {
        window.location.href=url;
    },500);
}

function comment(id) {
    let comment=document.getElementById("comment");
    comment.style.display="block";
    let container=document.getElementById("container");
    container.style.filter="blur(5px)";

    let message_id=document.getElementById("message_id");
    message_id.value=id;
}

function fade() {
    let comment = document.getElementById("comment");
    comment.style.display = "none";
    let container = document.getElementById("container");
    container.style.filter = "";
}

function CheckSign() {
    let topic=document.getElementById("topic");
    let message=document.getElementById("message");
    let invalidCheck3=document.getElementById("invalidCheck3");
    if(topic.value==="undefined"||topic.value==null||topic.value===""){
        topic.classList.remove('is-valid');
        topic.classList.add('is-invalid')
    }else {
        topic.classList.remove('is-invalid');
        topic.classList.add('is-valid');
    }

    if(message.value==="undefined"||message.value==null||message.value===""){
        message.classList.remove('is-valid');
        message.classList.add('is-invalid')
    }else {
        message.classList.remove('is-invalid');
        message.classList.add('is-valid');
    }


    if(invalidCheck3.checked===false){
        invalidCheck3.classList.remove('is-valid');
        invalidCheck3.classList.add('is-invalid')
    }else {
        invalidCheck3.classList.remove('is-invalid');
        invalidCheck3.classList.add('is-valid');
    }
}

let timeID=setInterval(CheckSign,1000);