'use strict'; 
var startRand, randResult;
var input = document.querySelector('.input'); 
// Цифра для отпределения чет-нечет и вывода соотв. картинки.
var chanse = 0;
var start = true;
// Функция изменяет видимость одной из двух картинок, взависимости от числа.
function hideImg(){
    randResult = true;
    document.getElementById('result').innerHTML = "Результат: "
    if (chanse % 10 == 0) {
    	document.getElementById('coin_rib').style.display = 'block';
		document.getElementById('coin_front').style.display = 'none';
        document.getElementById('coin_back').style.display = 'none';
    	randResult = 'rib';
    } else if (chanse % 2 == 0){
    	document.getElementById('coin_rib').style.display = 'none';
        document.getElementById('coin_front').style.display = 'block';
        document.getElementById('coin_back').style.display = 'none';
        randResult = true;
    } else {
    	document.getElementById('coin_rib').style.display = 'none';
        document.getElementById('coin_front').style.display = 'none';
        document.getElementById('coin_back').style.display = 'block';
        randResult = false;
    }
    chanse++;
}

// Функция быстро и бесконечно сменяет картинку с помощью прошлой функции.
function setImageToTimeInterval(){
	if (start) {
   		startRand = setInterval(hideImg, 10);
   		start = false;
        input.innerHTML = 'Остановить';
   	} else if (start === false) {
        clearInterval(startRand);
        printResult();
        start = true;
        input.innerHTML = 'Подбросить монету'
    }
}

function printResult(){
    if (randResult === 'rib') {
    	document.getElementById('result').innerHTML = "Результат: Ребро !!! И такое бывает :)"
    } else if (randResult === true){
        document.getElementById('result').innerHTML = "Результат: Решка";
    } else if (randResult === false) {
        document.getElementById('result').innerHTML = "Результат: Орел";
    } 
}