var elementExists = document.getElementById("acceptCookies");

// Checks to see if the user has accepted the cookie consent box. If they have then it will be hidden
if(elementExists){
    document.getElementById("acceptCookies").addEventListener("click", acceptCookies);

    if(localStorage.getItem("cookieConsent") == "true"){
        document.getElementById("cookieBanner").style.display = "none";
    }
}

function acceptCookies(){
    localStorage.setItem("cookieConsent", "true");
    document.getElementById("cookieBanner").style.display = "none";
}