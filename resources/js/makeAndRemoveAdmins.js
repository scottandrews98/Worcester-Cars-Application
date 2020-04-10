// Code for adding and removing admins from the site
var Swal = require('sweetalert2');

function refreshUsers(){
    var makeAdmin = document.getElementById("makeAdmin");
    var removeAdmin = document.getElementById("removeAdmin");

    if(makeAdmin){
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
                    confirmButtonText: 'Yes, make this user an admin'
                }).then((result) => {
                    if (result.value) {
                        ajaxMakeAdmin(id, "make");
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

    if(removeAdmin){
        document.querySelectorAll('#removeAdmin').forEach(item => {
            item.addEventListener("click", function(){
                var id = this.getAttribute('data-user-id');
        
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This users admin rights will be removed",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove this user as an admin'
                }).then((result) => {
                    if (result.value) {
                        ajaxMakeAdmin(id, "remove");
                        Swal.fire(
                            'User Has Been Removed From Being An Admin',
                            'Their admin permissions have been revoked',
                            'success'
                        )
                    }
                })
            });
        })
    }
}

// Runs to make the suer into and admin
function ajaxMakeAdmin(id, type){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            changeSettingsInterface(id, type);
        }
    };
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/admin/makeAndRemoveAdmins", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&userID="+id+"&type="+type+"");
}

// Function to change the user interface screen layout when an admin has been made or removed
function changeSettingsInterface(userID, type){
    var selectedButton = document.querySelectorAll('[data-user-id="'+userID+'"]');

    if(type == "make"){
        selectedButton[0].innerHTML = "Remove Admin";
        selectedButton[0].id = "removeAdmin";
    }else{
        selectedButton[0].innerHTML = "Make Admin";
        selectedButton[0].id = "makeAdmin";
    }

    showHideStared();
    refreshUsers();
}

function showHideStared(){
    // Loop through all stared cars buttons and decide if they should appear or be hidden
    var selectedButton = document.querySelectorAll('.staredButton');

    selectedButton.forEach(function(button) {
        var userID = button.dataset.staredUserId;
        var removeAddButton = document.querySelectorAll('[data-user-id="'+userID+'"]');

        if(removeAddButton[0].id == "removeAdmin"){
            button.style.display = "none";
        }else{
            button.style.display = "block";
        }
    });
}

showHideStared();
refreshUsers();