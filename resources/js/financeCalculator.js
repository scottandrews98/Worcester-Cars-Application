var elementExists = document.getElementById("finance");

if(elementExists){
    document.getElementById("calculate").addEventListener("click", calculateFinance);
}

function calculateFinance(){
    var price = document.getElementById("price").value;
    var deposit = document.getElementById("deposit").value;
    var repayment = document.getElementById("repayment").value;
    let interestRateDatabase = document.getElementById("interestRate").value;

    var interestRate = 3.6;

    if(interestRateDatabase == ""){
        intrestRate = 3.6 / 100;
    }else{
        intrestRate = interestRateDatabase / 100;
    }

    var repaymentYears = repayment/12;
    

    let amountBorrowed = price - deposit;
    let intrestAmount = (amountBorrowed*intrestRate) * repaymentYears;

    let figurePerMonth = (amountBorrowed + intrestAmount)/repayment;

    if(figurePerMonth < 0){
        document.getElementById("result").innerHTML = "Error, Negative Figure. Please Update";
    }else{
        document.getElementById("result").innerHTML = "£" + Math.round(figurePerMonth) + " Per Month At A Rate Of " + (intrestRate * 100).toFixed(2) + "%";
    }
}   