let tdBudget = document.querySelector('td#Budget');
let tdAlreadyPaid = document.querySelector('td#paid');
let tdToSpend = document.querySelector('td#toSpend');


let budget = (parseFloat(document.querySelector('td#Budget').innerHTML)).toFixed(2);
let alreadyPaid = (parseFloat(document.querySelector('td#paid').innerHTML)).toFixed(2);


let difference = (budget - alreadyPaid).toFixed(2);

let spend = tdToSpend.innerHTML = difference;

let newBudget = budget.replace('.', ',');
let newPaid = alreadyPaid.replace('.', ',');
let newToSpend = spend.replace('.', ',');


tdBudget.innerHTML = newBudget + " zł";
tdAlreadyPaid.innerHTML = newPaid + " zł";
tdToSpend.innerHTML = newToSpend + " zł";



let tdleftToPay = document.querySelectorAll('td#leftToPay');

let inputPrice = document.querySelectorAll('input#price');
let inputSpend = document.querySelectorAll('input#alreadySpend');

for (let i = 0; i < tdleftToPay.length; i++) {
    let difference = (parseFloat(inputPrice[i].value) - (parseFloat(inputSpend[i].value))).toFixed(2);
    console.log(difference);

    tdleftToPay[i].innerHTML = difference.replace('.', ',');
    // let differenceWithComma = difference.replace('.', ',');

    // tdleftToPay[i].innerHTML = differenceWithComma + " zł";
}

