// Code for deleting a car
var Swal = require('sweetalert2');

var elementExists = document.getElementById("deleteProfile");

if(elementExists){
    elementExists.addEventListener("click", function(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete my account!'
        }).then((result) => {
            if (result.value) {
                ajaxDeleteProfile();
                Swal.fire({
                    title: 'Account Deleted',
                    confirmButtonText: 'Account Deleted'
                }).then((result2) => {
                    if(result2.value){
                        window.location.replace("/home");
                    }
                })
            }
        })
    });
}

function ajaxDeleteProfile(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        // Remove From Screen
      }
    };

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/profile/delete", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send();
}