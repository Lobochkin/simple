<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Орел и Решка</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/style.css"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
<div class="wrapper" id="content">
    <a class="home" href="/">
    <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: 5px; fill: white; width: 20px;" viewBox="0 0 10 10">
        <g transform="translate(-5.5772299,-26.54581)">
            <path d="m 14.149807,31.130932 c 0,
-0.01241 0,-0.02481 -0.0062,-0.03721 L 10.57723,28.153784 7.0108528,
31.093719 c 0,0.01241 -0.0062,0.02481 -0.0062,0.03721 l 0,2.97715 c 0,
0.217084 0.1798696,0.396953 0.3969534,0.396953 l 2.3817196,0 0,
-2.38172 1.5878132,0 0,2.38172 2.381719,0 c 0.217084,0 0.396953,
-0.179869 0.396953,-0.396953 l 0,-2.97715 m 1.383134,
-0.427964 c 0.06823,-0.08063 0.05582,-0.210882 -0.02481,
-0.279108 l -1.358324,-1.128837 0,-2.530576 c 0,
-0.111643 -0.08683,-0.198477 -0.198477,-0.198477 l -1.190859,
0 c -0.111643,0 -0.198477,0.08683 -0.198477,0.198477 l 0,
1.209467 -1.513384,-1.265289 c -0.2605,-0.217083 -0.682264,
-0.217083 -0.942764,0 L 5.6463253,30.42386 c -0.080631,
0.06823 -0.093036,0.198476 -0.024809,0.279108 l 0.3845485,
0.458976 c 0.031012,0.03721 0.080631,0.06203 0.1302503,
0.06823 0.055821,0.0062 0.1054407,-0.01241 0.1488574,
-0.04342 l 4.2920565,-3.578782 4.292058,3.578782 c 0.03721,
0.03101 0.08063,0.04342 0.13025,0.04342 0.0062,0 0.01241,
0 0.01861,0 0.04962,-0.0062 0.09924,
-0.03101 0.130251,-0.06823 l 0.384549,-0.458976"/>
        </g>
    </svg>
    </a>

    <h2 id="h2_h2">Симулятор "Орел и Решка"</h2>
    <div class="selectCoinDiv" id="selectCoinDiv">
        <img src="img/rub.png" width="140" height="140" alt="Решка" id="coin_front" class="coinImg">
        <img src="img/eagle.png" width="140" height="140" alt="Орел" id="coin_back" class="coinImg">
        <img src="img/rib.jpg" width="140" height="140" alt="Ребро" id="coin_rib" class="coinImg rib">
    </div>
    <div class="input" id="moneyRandomButton" onclick="setImageToTimeInterval()" tabindex="0">Подбросить монету</div>
    <p class="result" id="result"><b>Результат:</b></p>
</div>
<script src="script.js"></script>
</body>
</html>