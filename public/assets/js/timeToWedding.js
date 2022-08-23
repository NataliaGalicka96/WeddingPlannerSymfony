let weddingDate = document.getElementById('time').innerHTML;
console.log(weddingDate);

let year = weddingDate.substring(0, 4);
let month = weddingDate.substring(5, 7);
let day = weddingDate.substring(8, 11);
let hour = weddingDate.substring(11, 13);
let minutes = weddingDate.substring(14, 16);
//let second = weddingDate.substring(17, 19);
//console.log(second);



function czasDoWydarzenia(year, month, day, hour, minutes) {
    var aktualnyCzas = new Date();
    var dataWydarzenia = new Date(year, month, day, hour, minutes);
    var pozostalyCzas = dataWydarzenia.getTime() - aktualnyCzas.getTime();

    if (pozostalyCzas > 0) {

        var s = pozostalyCzas / 1000;   // sekundy
        var min = s / 60;               // minuty
        var h = min / 60;               // godziny



        var sLeft = Math.floor(s % 60);    // pozostało sekund    
        var minLeft = Math.floor(min % 60); // pozostało minut
        var hLeft = Math.floor(h);          // pozostało godzin

        if (minLeft < 10)
            minLeft = "0" + minLeft;
        if (sLeft < 10)
            sLeft = "0" + sLeft;
        return "Do wesela pozostały: </br>" + hLeft + "h " + minLeft + "m " + sLeft + "s";
    }
    else
        return "Zdarzenie miało już miejsce na naszym globie, to już jest historia i już nie powróci!";
}

window.onload = function () {

    idElement = "time";
    document.getElementById(idElement).innerHTML = czasDoWydarzenia(year, month, day, hour, minutes);
    setInterval("document.getElementById(idElement).innerHTML = czasDoWydarzenia(year, month, day, hour, minutes)", 1000);

};
