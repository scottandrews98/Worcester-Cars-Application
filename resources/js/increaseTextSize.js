// Code for increasing the size of the text for the car descriptions
var elementExists = document.getElementById("increaseText");

if(elementExists){
    if(localStorage.getItem("size") == "large"){
        document.getElementById("carDescription").style.fontSize = "25px";
        document.getElementById("increaseText").style.display = "none";
    }else{
        document.getElementById("decreaseText").style.display = "none";
    }

    elementExists.addEventListener("click", function(){
        document.getElementById("carDescription").style.fontSize = "25px";
        // Set local storage to remember if large is set
        localStorage.setItem("size", "large");
        document.getElementById("decreaseText").style.display = "inline-block";
        document.getElementById("increaseText").style.display = "none";
    });

    document.getElementById("decreaseText").addEventListener("click", function(){
        localStorage.removeItem("size");
        document.getElementById("carDescription").style.fontSize = "16px";
        document.getElementById("increaseText").style.display = "inline-block";
        document.getElementById("decreaseText").style.display = "none";
    });
}