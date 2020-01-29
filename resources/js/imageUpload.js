// Waits for a click on an add new image button
function openDialog() {
    document.getElementsByClassName('fileid')[totalImages].click();
}

var totalImages = 0

document.getElementsByClassName('fileid')[totalImages].addEventListener("change",function() {
    totalImages ++;

    document.getElementById('imageRow').insertAdjacentHTML('afterbegin' ,'<img src="" class="img-responsive" id="carImage1" alt="BMW Front grill"></img>');

    document.getElementById('addNew').insertAdjacentHTML('afterbegin' ,'<input class="fileid" type="file" name="file'+totalImages+'" accept="image/*" hidden/>');

    var fileReader = new FileReader();
    var target = document.getElementById('carImage1');

    fileReader.onload = function(){ 
        target.src = this.result; 
    };
  
    fileReader.readAsDataURL(document.getElementsByClassName('fileid')[totalImages].files[0]);
});

window.addEventListener('load',function(){
    document.getElementById('addNewImage2').addEventListener('click', openDialog);
});


