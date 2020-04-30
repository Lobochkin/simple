<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$host = '127.0.0.1';
$db = 'meters';
$user = 'root';
$pass = '9266079409VaL5';
$charset = 'utf8';

$dsn = "mysql:default_socket=/var/lib/mysqld/mysqld.sock;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
print_r($_POST);
$stmt = $pdo->query("SELECT * FROM meters ORDER BY id DESC LIMIT 2");
$data = [];
while ($row = $stmt->fetch()) {
    $data[] = $row;
}
$data = array_reverse($data);

//print_r($data);
$stmt = $pdo->query("SELECT * FROM price ORDER BY id DESC LIMIT 1");
$price = $stmt->fetch();
//while ($row = $stmt->fetch())
//{
//    $price = $row;
//    print_r($price);
//}
//print_r($price);
?>
<p>
<h2>Тариф</h2>
<div class="price_water">Расход воды: <b><?= $price['water'] ?></b></div>
<div class="price_warming">Нагрев воды: <b><?= $price['warming'] ?></b></div>
<div class="price_electric">Электричество: <b><?= $price['electric'] ?></b></div>
</p>

<table>
    <tr>
        <th>
            Дата:
        </th>
        <th>
            Электричество:
        </th>
        <th>
            Горячая вода:
        </th>
        <th>
            Холодная вода:
        </th>
        <th>
            Сумма:
        </th>
        <th>

        </th>

    </tr>
    <? foreach ($data as $key => $item):
        if (count($data) != ++$key) {
            ?>
            <form class="form" action="" method="POST">
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?= $item['id'] ?>" required>
                        <?= $item['date'] ?>
                    </td>
                    <td>
                        <?= $item['electric'] ?>
                    </td>
                    <td>
                        <?= $item['hot_water'] ?>
                    </td>
                    <td>
                        <?= $item['cold_water'] ?>
                    </td>
                    <td>
                        <?= $item['total'] ?>
                    </td>
                    <td>
                        <button class="form__button" name="button_edit" type="submit">Редактировать</button>
                    </td>

                </tr>
            </form>
        <?php } else { ?>
            <form class="form" action="" method="POST">
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?= $item['id'] ?>" required>
                        <?= $item['date'] ?>
                    </td>
                    <td class="form__input-electric-old">
                        <?= $item['electric'] ?>
                    </td>
                    <td class="form__input-hot_water-old">
                        <?= $item['hot_water'] ?>
                    </td>
                    <td class="form__input-cold_water-old">
                        <?= $item['cold_water'] ?>
                    </td>
                    <td class="">
                        <?= $item['total'] ?>
                    </td>
                    <td>
                        <button class="form__button" name="button_edit" type="submit">Редактировать</button>
                    </td>

                </tr>
            </form>
            <?
        }
    endforeach; ?>
    <form class="form_add" action="" method="POST">
        <tr>
            <td>
                <input type="hidden" name="id" value="" required>
                <input class="form__input form__input-date" type="date" name="date" value="" min="<?= date("Y-m") ?>-01" max="<?= date("Y") ?>-12-31" required>
            </td>
            <td>
                <input class="form__input form__input-electric" type="number" name="electric" value="" maxlength="30" required>
            </td>
            <td>
                <input class="form__input form__input-hot_water" type="number" name="hot_water" value="" maxl="10000000" required>
            </td>
            <td>
                <input class="form__input form__input-cold_water" type="number" name="cold_water" value="" maxl="1000000" required>
            </td>
            <td class="total">

            </td>
            <td colspan="2">
                <button onclick="calculate();">Посчитать</button>
                <button class="form__button_add" name="button_add" type="submit" onclick="add_date();">Добавить</button>
            </td>
        </tr>
    </form>
</table>
<script>

    // прайс
    var price_water = +document.querySelector('.price_water b').innerText;
    var price_warming = +document.querySelector('.price_warming b').innerText;
    var price_electric = +document.querySelector('.price_electric b').innerText;
    //последние данные
    var input_electric_old = +document.querySelector('.form__input-electric-old').innerText;
    var input_hot_water_old = +document.querySelector('.form__input-hot_water-old').innerText;
    var input_cold_water_old = +document.querySelector('.form__input-cold_water-old').innerText;
    //  введенные данные
    var form__input_electric = document.querySelector('.form__input-electric');
    var form__input_hot_water = document.querySelector('.form__input-hot_water');
    var form__input_cold_water = document.querySelector('.form__input-cold_water');

    function calculate() {
        event.preventDefault();
        var total = document.querySelector('.total');
        var totals = ((+form__input_hot_water.value) - input_hot_water_old + (+form__input_cold_water.value) - input_cold_water_old) * price_water + ((+form__input_hot_water.value) - input_hot_water_old) * price_warming +
            ((+form__input_electric.value) - input_electric_old) * price_electric;
        total.innerText = totals;
        total.innerText += "руб.";
    }
    document.querySelector('.form__button_add').onclick = function () {
        event.preventDefault();
        var formData = new FormData();
        formData.append(0, document.querySelector('.form__input-date').value);
        formData.append(1, form__input_electric.value);
        formData.append(2, form__input_hot_water.value);
        formData.append(3, form__input_cold_water.value);
        console.log(document.querySelector('.form__input-date').value);

        axios.post('/local/tools/ajax.php', formData)
        .then(function (res) {
            console.log(res.data);
        })
        .catch(function (err) {
            console.log(err.message);
        });
    }

</script>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
