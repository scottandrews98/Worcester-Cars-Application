var elementExists = document.getElementById("submitContactForm");

if(elementExists){
    document.getElementById("submitContactForm").addEventListener("click", submitContactForm);
}

function submitContactForm(){
    // Get form input values
    let emailValid = ValidateEmail(document.getElementById("email").value);
    let name = document.getElementById("name").value;
    let phone = document.getElementById("phone").value;
    let message = document.getElementById("message").value;

    if(emailValid == false){
        document.getElementById("errorMessage").innerHTML = "Please Enter A Valid Email Address";
    }else if(name == ""){
        document.getElementById("errorMessage").innerHTML = "Please Enter A Value For Your Name";
    }else if(phone == ""){
        document.getElementById("errorMessage").innerHTML = "Please Enter A Value For Your Phone Number";
    }else if(message == ""){
        document.getElementById("errorMessage").innerHTML = "Please Enter A Value For Your Message";
    }else{
        sendRequest(name, phone, message);
    }   
}

function sendRequest(name, phone, message){
    let email = document.getElementById("email").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200 && this.responseText == "Message Sent") {
        document.getElementById("errorMessage").innerHTML = "Form Submitted";
      }
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/contact", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&name="+name+"&email="+email+"&number="+phone+"&message="+message+"");
}

// Email Validation https://www.w3resource.com/javascript/form/email-validation.php
function ValidateEmail(email){
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
        return true;
    }else{
        return false;
    }
}