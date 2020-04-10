// Code for deleting a car
var Swal = require('sweetalert2');

var elementExists = document.getElementById("deleteCar");

if(elementExists){
    document.querySelectorAll('#secondButton').forEach(item => {
        item.addEventListener("click", function(){
            var id = this.getAttribute('data-delete-id');
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete this car!'
            }).then((result) => {
                if (result.value) {
                    ajaxDeleteCar(id);
                    this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
                    Swal.fire(
                        'Deleted!',
                        'This car has been deleted.',
                        'success'
                    )
                }
            })
        });
    })
}

// Sends an ajax request to the database that removes a car from the database with the required id
function ajaxDeleteCar(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        // Remove From Screen
      }
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/admin/delete", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&carID="+id+"");
}