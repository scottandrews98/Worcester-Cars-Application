var elementExists = document.getElementById("finance");

if(elementExists){
    document.getElementById("calculate").addEventListener("click", calculateFinance);
}

function calculateFinance(){
    var price = document.getElementById("price").value;
    var deposit = document.getElementById("deposit").value;
    var repayment = document.getElementById("repayment").value;
    var repaymentYears = repayment/12;
    let intrestRate = 3.6 / 100;

    let amountBorrowed = price - deposit;
    let intrestAmount = (amountBorrowed*intrestRate) * repaymentYears;

    let figurePerMonth = (amountBorrowed + intrestAmount)/repayment;
    document.getElementById("result").innerHTML = "£" + Math.round(figurePerMonth) + " Per Month At A Rate Of " + (intrestRate * 100).toFixed(2) + "%";
}   