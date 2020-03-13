var elementExists = document.getElementById("acceptCookies");

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