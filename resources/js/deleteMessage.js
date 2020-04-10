// Code for deleting a users contact form message
var Swal = require('sweetalert2');

var elementExists = document.getElementById("deleteMessage");

if(elementExists){
    document.querySelectorAll('#deleteMessage').forEach(item => {
        item.addEventListener("click", function(){
            var id = this.getAttribute('data-message-id');
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete this message!'
            }).then((result) => {
                if (result.value) {
                    ajaxDeleteMessage(id);
                    this.parentNode.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode.parentNode);
                    Swal.fire(
                        'Deleted!',
                        'Your message has been deleted.',
                        'success'
                    )
                }
            })
        });
    })
}

// Deletes a users message from the database
function ajaxDeleteMessage(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      }
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/deleteMessage", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&messageID="+id+"");
}