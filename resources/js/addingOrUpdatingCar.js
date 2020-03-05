// Code for checking if an admin wants to add a new car
var Swal = require('sweetalert2');

var elementExists = document.getElementById("submit");

if(elementExists){
    elementExists.addEventListener("click", function(){
        Swal.fire({
            title: 'Are you sure you want to add a new car?',
            text: "Make sure all fields are filled in!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add a new car'
        }).then((result) => {
            if (result.value) {
                document.getElementById("hiddenSubmit").click();
            }
        })
    });
}

// Code for checking to see if an admin wants to update a car
var elementExists = document.getElementById("update");

if(elementExists){
    elementExists.addEventListener("click", function(){
        Swal.fire({
            title: 'Are you sure you want to update this car?',
            text: "Warning this cannot be reversed",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update car information'
        }).then((result) => {
            if (result.value) {
                document.getElementById("hiddenSubmit").click();
            }
        })
    });
}