var Swal = require('sweetalert2');

// Waits for a click on an add new image button
function openDialog() {
    document.getElementsByClassName('fileid')[totalImages].click();

    document.getElementsByClassName('fileid')[totalImages].addEventListener("change", imageChange);
}

function removeImage(){
    var clickedID = this.getAttribute('data-imageID');

    loopClass('imgUploaded', clickedID);
    loopClass('fileid', clickedID); 
    loopClass('altText', clickedID); 

    // Just for editing cars
    loopClass('existingImage', clickedID); 

    totalImages --;
}

function loopClass(className, clickedID){
    var className = document.getElementsByClassName(className)

    for(var i = 0; i < className.length; i++){
        if(className[i].getAttribute('data-imageID') == clickedID){
            className[i].remove();
        }
    }
}

//var totalImages = 0
var totalImages = document.querySelectorAll('.altText').length;

function imageChange(){
    // Checks image size to make sure it's smaller than 2mb. Size method returns image size in bytes
    let size = document.getElementsByClassName('fileid')[totalImages].files[0].size;

    if(size >= 2000000){
        Swal.fire({
            icon: 'error',
            title: 'Image Too Large',
            text: 'All images must be below 2mb.'
        })
    }else{
        // Adds to the page the image that has just been uploaded
        document.getElementById('imageRow').insertAdjacentHTML('afterbegin' ,'<img src="" class="img-responsive imgUploaded" id="carImage1" data-imageID="'+totalImages+'"></img>');
        // Adds to the page a hidden input type file field that contains the path on the user's local machine for the image that has just been selected
        document.getElementById('addNew').insertAdjacentHTML('beforeend' ,'<input class="fileid" type="file" name="image[]" data-imageID="'+totalImages+'" accept="image/*" hidden/>');

        var fileReader = new FileReader();
        var target = document.getElementById('carImage1');

        fileReader.onload = function(){ 
            target.src = this.result; 
        };
        target.addEventListener('click', removeImage);
        
        fileReader.readAsDataURL(document.getElementsByClassName('fileid')[totalImages].files[0]);

        // Adds to the page a text input box that will contain the alt text for the image that has just been uploaded
        document.getElementById('imageRow').insertAdjacentHTML('beforebegin' ,'<input type="text" class="altText" data-imageID="'+totalImages+'" placeholder="Alt Text For Image Number '+totalImages +'" name="altText[]" required>');

        totalImages ++;
    }
}

window.addEventListener('load',function(){
    var elementExists = document.getElementById("addNewImage2");

    if(elementExists){
        elementExists.addEventListener('click', openDialog);

        if(document.getElementById('carImage1')){
            //document.getElementById('carImage1').addEventListener('click', removeImage);
            var existingImages = document.getElementsByClassName('imgUploaded');

            for (var i = 0; i < existingImages.length; i++) {
                existingImages[i].addEventListener('click', removeImage);
            }
        }
    }
});



// Code for removing images when editing 

// Controller could loop over alt text boxes and see if any are missing by their 