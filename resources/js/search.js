// JavaScript code that sends and ajax request to the backend to produce 
var elementExists = document.getElementById("searchForm");

var nextPage = "";

if(elementExists){
    document.getElementById("search").addEventListener("click", function(){
        nextPage = "";
        let response = calculatePage();
        searchCars(response)
    });
    document.getElementById("orderBy").addEventListener("change", function(){
        nextPage = "";
        let response = calculatePage();
        searchCars(response)
    });

    document.getElementById("nextPage").addEventListener("click", function(){
        nextPage = "add";
        let response = calculatePage();
        searchCars(response);
    });
}

function calculatePage(){
    // Code to get the current page and if previous or next has been clicked
    var pageNumberInitial = document.getElementById("pageNumber").value;

    if(nextPage == "add"){
        document.getElementById("pageNumber").value = Number(pageNumberInitial) + 1;
    }else if(nextPage == "subtract"){
        document.getElementById("pageNumber").value = Number(pageNumberInitial) - 1;
        console.log("runs");
    }else{
        document.getElementById("pageNumber").value = Number(pageNumberInitial);
    }
    console.log(document.getElementById("pageNumber").value);
    return Number(document.getElementById("pageNumber").value);
}


function searchCars(pageNumber){
    // Code to fetch the set form values
    let manufacturers = document.getElementById('manufacturers').value;
    let miles = document.getElementById('miles').value;
    let fuel = document.getElementById('fuel').value;
    let gearbox = document.getElementById('gearbox').value;
    let mpg = document.getElementById('mpg').value;
    let tax = document.getElementById('tax').value; 

    // Code to get the current order dropdown
    let changeSelectBox = document.getElementById("orderBy");
    let chosenValue = changeSelectBox.options[changeSelectBox.selectedIndex].value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        // If AJAX response comes back without an error
        if (this.readyState == 4 && this.status == 200) {
            // Code to replace on screen cars with result
            var carRemove = document.getElementById('remove');
            carRemove.parentNode.removeChild(carRemove);
            document.getElementById("cars").innerHTML = this.responseText;
            document.getElementById("mainCarsHeading").innerHTML = "Cars";

            if(document.getElementById("lastPage")){
                document.getElementById("lastPage").addEventListener("click", function(){
                    nextPage = "subtract";
                    let response = calculatePage();
                    searchCars(response);
                });    
            }
            
            document.getElementById("nextPage").addEventListener("click", function(){
                nextPage = "add";
                let response = calculatePage();
                searchCars(response);
            });
        }
    };

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    xhttp.open("POST", "/cars", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-Token", CSRF_TOKEN);
    xhttp.send("&manufacturers="+manufacturers+"&miles="+miles+"&fuel="+fuel+"&gearbox="+gearbox+"&mpg="+mpg+"&tax="+tax+"&chosenValue="+chosenValue+"&pageNumber="+pageNumber+"&pagingDirection="+nextPage+"");
} 