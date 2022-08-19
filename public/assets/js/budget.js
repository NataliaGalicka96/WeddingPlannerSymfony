
let budget = (parseFloat(document.querySelector('td#Budget').innerHTML)).toFixed(2);
let alreadyPaid = (parseFloat(document.querySelector('td#paid').innerHTML)).toFixed(2);
let toPay = document.querySelector('td#toSpend');

let difference = (budget - alreadyPaid).toFixed(2);

toPay.innerHTML = difference + " zł";
