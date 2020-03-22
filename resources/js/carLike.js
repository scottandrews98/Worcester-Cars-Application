var elementExists = document.getElementById("star");

if(elementExists){
    document.getElementById("star").addEventListener("click", likeCar);
    checkLikeCar();
}

// Function that is responsible for AJAX requesting to backend to like a car on behalf of a logged in user
function likeCar(){
    let carID = document.getElementById("star").getAttribute('data-carID');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "Car Liked"){
          // Apply styling to make button seem full
          document.getElementById('star').style.color = 'black';
        }else{
          document.getElementById('star').style.color = 'white';
        }
      }
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/car", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&carID="+carID+"");
}

// Function that checks to see if the car is already liked on page load
function checkLikeCar(){
    let carID = document.getElementById("star").getAttribute('data-carID');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText == "Car Liked"){
                // Apply styling to make button seem full
                document.getElementById('star').style.color = 'black';
            }
        } 
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/carCheck", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&carID="+carID+"");
}