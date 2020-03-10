// Compare car details to selected car
var elementExists = document.getElementById("compareCars");

if(elementExists){
    document.getElementById("compareCars").addEventListener("change", compareCars);
}

function compareCars(){
    let carSelectBox = document.getElementById("compareCars");
    let chosenValue = carSelectBox.options[carSelectBox.selectedIndex].value;
    let existingID = document.getElementById("existingID").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        // If AJAX response comes back without an error
        if (this.readyState == 4 && this.status == 200) {
            // Code to replace on screen compare with result
            var compareRemove = document.getElementById('remove');
            compareRemove.parentNode.removeChild(compareRemove);
            //document.getElementById("compare").innerHTML = this.responseText;
            document.getElementById("compare").insertAdjacentHTML('beforeend', this.responseText);
        }
    };

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/getCompareDetails", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&id="+chosenValue+"&existingID="+existingID+"");
}