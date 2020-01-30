// Waits for a click on an add new image button
function openDialog() {
    document.getElementsByClassName('fileid')[totalImages].click();

    document.getElementsByClassName('fileid')[totalImages].addEventListener("change", imageChange);
}

var totalImages = 0



function imageChange(){
    document.getElementById('imageRow').insertAdjacentHTML('afterbegin' ,'<img src="" class="img-responsive" id="carImage1" alt="BMW Front grill"></img>');

    document.getElementById('addNew').insertAdjacentHTML('beforeend' ,'<input class="fileid" type="file" name="image[]" accept="image/*" hidden/>');

    var fileReader = new FileReader();
    var target = document.getElementById('carImage1');

    fileReader.onload = function(){ 
        target.src = this.result; 
    };
  
    fileReader.readAsDataURL(document.getElementsByClassName('fileid')[totalImages].files[0]);

    totalImages ++;
}

window.addEventListener('load',function(){
    document.getElementById('addNewImage2').addEventListener('click', openDialog);
});


