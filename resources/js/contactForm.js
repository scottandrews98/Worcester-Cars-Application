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
    var errorMessage = "";

    if(emailValid == false){
        errorMessage = "Please Enter A Valid Email Address";
    }else if(name == ""){
        errorMessage = "Please Enter A Value For Your Name";
    }else if(phone == ""){
        errorMessage = "Please Enter A Value For Your Phone Number";
    }else if(message == ""){
        errorMessage = "Please Enter A Value For Your Message";
    }else{
        sendRequest(name, phone, message);
    }   

    var errorContainer = document.getElementById("errorContainer");
    errorContainer.removeChild(errorContainer.childNodes[0]);

    var h4 = document.createElement("H4");
    var text = document.createTextNode(errorMessage); 
    h4.appendChild(text);
    errorContainer.appendChild(h4);
}

// Sends the contact form details to the backend of the site and awats the response
function sendRequest(name, phone, message){
    let email = document.getElementById("email").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200 && this.responseText == "Message Sent") {
        var errorContainer = document.getElementById("errorContainer");
        errorContainer.removeChild(errorContainer.childNodes[0]);
        var h4 = document.createElement("H4");
        var text = document.createTextNode("Form Submitted"); 
        h4.appendChild(text);
        errorContainer.appendChild(h4);
        document.getElementById("name").value = ""
        document.getElementById("phone").value = ""
        document.getElementById("message").value = ""
        document.getElementById("email").value = ""
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