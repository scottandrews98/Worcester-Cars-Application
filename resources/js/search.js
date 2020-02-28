// JavaScript code that sends and ajax request to the backend to produce 
var elementExists = document.getElementById("searchForm");

if(elementExists){
    document.getElementById("search").addEventListener("click", searchCars);
}

function searchCars(){
    // Code to fetch the set form values
    let manufacturers = document.getElementById('manufacturers').value;
    let miles = document.getElementById('miles').value;
    let fuel = document.getElementById('fuel').value;
    let gearbox = document.getElementById('gearbox').value;
    let mpg = document.getElementById('mpg').value;
    let tax = document.getElementById('tax').value; 

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        // If AJAX response comes back without an error
        if (this.readyState == 4 && this.status == 200) {
            // Code to replace on screen cars with result
            var carRemove = document.getElementById('remove');
            carRemove.parentNode.removeChild(carRemove);
            document.getElementById("cars").innerHTML = this.responseText;
        }
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/cars", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&manufacturers="+manufacturers+"&miles="+miles+"&fuel="+fuel+"&gearbox="+gearbox+"&mpg="+mpg+"&tax="+tax+"");
}