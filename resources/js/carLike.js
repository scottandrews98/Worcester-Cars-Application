var elementExists = document.getElementById("star");

if(elementExists){
    document.getElementById("star").addEventListener("click", likeCar);

    // TODO Check here for car that has already been liked
}

function likeCar(){
    // Function that is responsible for AJAX requesting to backend to like a car on behalf of a logged in user
    let carID = document.getElementById("star").getAttribute('data-carID');


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/car", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&carID="+carID+"");
}