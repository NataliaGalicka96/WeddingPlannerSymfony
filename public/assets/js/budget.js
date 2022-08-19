
let budget = (parseFloat(document.querySelector('td#Budget').innerHTML)).toFixed(2);
let alreadyPaid = (parseFloat(document.querySelector('td#paid').innerHTML)).toFixed(2);
let toPay = document.querySelector('td#toSpend');

let difference = (budget - alreadyPaid).toFixed(2);

toPay.innerHTML = difference + " zł";



let tdPrice = document.querySelectorAll('td[data-label="Cena"]');


for (let i = 0; i < tdPrice.length; i++) {
    tdPrice[i].addEventListener("mouseover", e => {
        let input = document.createElement('input')
        input.classList.add("form-control");
        input.type = "submit";

        tdPrice.appendChild(input);

        console.log("mouseover");
    });
}

/*
element.addEventListener('mouseover', function () { this.innerHTML = 'Zaszło zdarzenie MouseOver'; })
element.addEventListener('mousemove', function () { this.style.background = 'green'; })
element.addEventListener('mouseout', function () { this.style.background = 'blue'; this.innerHTML = 'Kliknij tu'; })
</script >

<input type="number" step="0.01" min="0" class="form-control" id="floatingInput" name="price"
                                placeholder="...">

*/