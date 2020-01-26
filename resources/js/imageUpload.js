// Waits for a click on an add new image button
function openDialog() {
    console.log("run");
    document.getElementById('fileid').click();
}

document.getElementById('addNewImage2').addEventListener('click', openDialog);

var elementExists = document.getElementById("addNewImage2");
console.log(elementExists);

