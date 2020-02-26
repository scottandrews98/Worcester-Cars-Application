// Code for deleting a car
var Swal = require('sweetalert2');

var elementExists = document.getElementById("makeAdmin");

if(elementExists){
    document.querySelectorAll('#makeAdmin').forEach(item => {
        item.addEventListener("click", function(){
            var id = this.getAttribute('data-user-id');
    
            Swal.fire({
                title: 'Are you sure?',
                text: "This user will gain full admin rights",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete this car!'
            }).then((result) => {
                if (result.value) {
                    ajaxMakeAdmin(id, make);
                    Swal.fire(
                        'User Has Been Made An Admin',
                        'They will now be able to visit admin website sections',
                        'success'
                    )
                }
            })
        });
    })
}

function ajaxMakeAdmin(id, type){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/admin/makeAndRemoveAdmins", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&userID="+id+"&type="+type+"");
}