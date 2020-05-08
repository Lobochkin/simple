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

$stmt = $pdo->query("SELECT * FROM meters ORDER BY id DESC");
$data = [];
while ($row = $stmt->fetch()) {
    $data[] = $row;
}
$data = array_reverse($data);

$stmt = $pdo->query("SELECT * FROM price ORDER BY id DESC LIMIT 1");
$price = $stmt->fetch();

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
    </table>
<table class="table-count">
    <? foreach ($data as $key => $item):
        if ((count($data) - $key) > 5){
            continue;
        }
        if (count($data) != (1 + $key)) {
            ?>

            <tr>
                <td>
                    <input class="form__input" type="date" name="date" data-id="<?= $item['id'] ?>" value="<?= $item['date'] ?>"  required>
                </td>
                <td>
                    <input class="form__input" type="number" name="electric" data-id="<?= $item['id'] ?>" value="<?= $item['electric'] ?>" maxlength="30" required>
                </td>
                <td>
                    <input class="form__input" type="number" name="hot_water" data-id="<?= $item['id'] ?>" value="<?= $item['hot_water'] ?>" maxl="10000000" required>
                </td>
                <td>
                    <input class="form__input" type="number" name="cold_water" data-id="<?= $item['id'] ?>" value="<?= $item['cold_water'] ?>" maxl="1000000" required>
                </td>
                <td class="">
                    <input class="form__input" type="text" name="total" data-id="<?= $item['id'] ?>" value="<?= $item['total'] ?>" maxl="1000000" required>
                </td>
                <td>
                    <button name="button" data-id="<?= $item['id'] ?> onclick="calculate_edit(<?= $item['id'] ?>,<?= $data[$key - 1]['id'];?>);">Посчитать</button>
                    <button class="form__button" name="button_edit" data-id="<?= $item['id'] ?>" onclick="add_date(<?= $item['id'] ?>,<?= $data[$key - 1]['id'];?>);" type="submit">Редактировать</button>
                    <span onclick="dataDelete(<?= $item['id'] ?>)" style="color: red; cursor: pointer;"> &#10008; </span>
                </td>
            </tr>
        <?php } else { ?>
                <tr>
                    <td>
                        <input class="form__input" type="date" name="date" data-id="<?= $item['id'] ?>" value="<?= $item['date'] ?>"  required>
                    </td>
                    <td class="form__input-electric-old">
                        <input class="form__input" type="number" name="electric" data-id="<?= $item['id'] ?>" value="<?= $item['electric'] ?>" maxlength="30" required>
                    </td>
                    <td class="form__input-hot_water-old">
                        <input class="form__input" type="number" name="hot_water" data-id="<?= $item['id'] ?>" value="<?= $item['hot_water'] ?>" maxl="10000000" required>
                    </td>
                    <td class="form__input-cold_water-old">
                        <input class="form__input" type="number" name="cold_water" data-id="<?= $item['id'] ?>" value="<?= $item['cold_water'] ?>" maxl="1000000" required>
                    </td>
                    <td class="">
                        <input class="form__input" type="text" name="total" data-id="<?= $item['id'] ?>" value="<?= $item['total'] ?>" maxl="1000000" required>
                    </td>
                    <td>
                        <button name="button" data-id="<?= $item['id'] ?>" onclick="calculate_edit(<?= $item['id'] ?>,<?= $data[$key - 1]['id'];?>);">Посчитать</button>
                        <button class="form__button" name="button_edit" data-id="<?= $item['id'] ?>" onclick="add_date(<?= $item['id'] ?>,<?= $data[$key - 1]['id'];?>);" type="submit">Редактировать</button>
                        <span onclick="dataDelete(<?= $item['id'] ?>)" style="color: red; cursor: pointer;"> &#10008; </span>
                    </td>
                </tr>
            <?
        }
    endforeach; ?>
    </table>
<table>
        <tr>
            <td>
                <input type="hidden" name="id" value="" required>
                <input class="form__input form__input-date" type="date" name="date" value="" min="<?= date("Y") ?>-01-01" max="<?= date("Y") ?>-12-31" autofocus>
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
            <td class="total"></td>
            <td colspan="2">
                <button onclick="calculate();">Посчитать</button>
                <button class="form__button_add" name="button_add" type="submit" >Отправить данные</button>
            </td>
        </tr>
</table>

<script>

    // прайс
    var price_water = +document.querySelector('.price_water b').innerText;
    var price_warming = +document.querySelector('.price_warming b').innerText;
    var price_electric = +document.querySelector('.price_electric b').innerText;

    function calculate() {
        event.preventDefault();
        //последние данные
        let input_electric_old = +document.querySelector('.form__input-electric-old input').value;
        let input_hot_water_old = +document.querySelector('.form__input-hot_water-old input').value;
        let input_cold_water_old = +document.querySelector('.form__input-cold_water-old input').value;
        //  введенные данные
        let form__input_electric = document.querySelector('.form__input-electric');
        let form__input_hot_water = document.querySelector('.form__input-hot_water');
        let form__input_cold_water = document.querySelector('.form__input-cold_water');
        let total = document.querySelector('.total');
        let totals = ((+form__input_hot_water.value) - input_hot_water_old + (+form__input_cold_water.value) - input_cold_water_old) * price_water + ((+form__input_hot_water.value) - input_hot_water_old) * price_warming +
            ((+form__input_electric.value) - input_electric_old) * price_electric;
        if(totals < 1){
            alert('Заполните все поля');
            return false;
        } else if(totals > 2500) {
            alert('Слишком большая цена ('+ totals +' руб.)');
            return false;
        }
        total.innerText = Math.round(totals);
        total.innerText += "руб.";
    }
    document.querySelector('.form__button_add').onclick = function () {
        event.preventDefault();
        let total = document.querySelector('.total');

        if (total.innerText.length < 1 ){
            alert('Перед отправкой необходимо рассчитать!');
            return false;
        }
        let Data = new Date();
        let fullDate = String(Data.getDate()) + '.' + String(Data.getMonth()+1) + '.'+ String(Data.getFullYear());
        if (document.querySelector('.form__input-date').value.length < 1) {
            alert('Необходимо заполнить дату, сегодня '+ fullDate);
            return false;
        }
        var formData = new FormData();
        formData.append(0, 'action-add');
        formData.append(1, document.querySelector('.form__input-date').value);
        formData.append(2, document.querySelector('.form__input-electric').value);
        formData.append(3, document.querySelector('.form__input-hot_water').value);
        formData.append(4, document.querySelector('.form__input-cold_water').value);
        formData.append(5, total.innerText);

        axios.post('/local/tools/ajax.php', formData)
        .then(function (res) {
            document.querySelector('.table-count').innerHTML = res.data;
            document.querySelector('.form__input-date').value = '';
            document.querySelector('.form__input-electric').value = '';
            document.querySelector('.form__input-hot_water').value = '';
            document.querySelector('.form__input-cold_water').value = '';
            total.innerText = '0 руб.';
        })
        .catch(function (err) {
            console.log(err.message);
        });
    }
    function calculate_edit(id,idOld) {
        let dataElectric = document.querySelector('[name="electric"][data-id="'+id+'"]').value;
        let dataHotWater = document.querySelector('[name="hot_water"][data-id="'+id+'"]').value;
        let dataColdWater = document.querySelector('[name="cold_water"][data-id="'+id+'"]').value;
        let dataElectricOld = document.querySelector('[name="electric"][data-id="'+idOld+'"]').value;
        let dataHotWaterOld = document.querySelector('[name="hot_water"][data-id="'+idOld+'"]').value;
        let dataColdWaterOld = document.querySelector('[name="cold_water"][data-id="'+idOld+'"]').value;
        let totals = ((dataHotWater - dataHotWaterOld) + (dataColdWater - dataColdWaterOld)) * price_water + (dataHotWater - dataHotWaterOld) * price_warming +
            (dataElectric - dataElectricOld) * price_electric;
        let total = document.querySelector('[name="total"][data-id="'+id+'"]');

        if(totals < 1){
            alert('Заполните все поля');
            return false;
        } else if(totals > 2500) {
            alert('Слишком большая цена ('+ totals +' руб.)');
            return false;
        }
        total.value = Math.round(totals);
        total.value += "руб.";
    }
    function add_date(id) {
        $('[name="button"][data-id="'+id+'"]').trigger('click');
        let dataDate = document.querySelector('[name="date"][data-id="'+id+'"]').value;
        let dataElectric = document.querySelector('[name="electric"][data-id="'+id+'"]').value;
        let dataHotWater = document.querySelector('[name="hot_water"][data-id="'+id+'"]').value;
        let dataColdWater = document.querySelector('[name="cold_water"][data-id="'+id+'"]').value;
        let total = document.querySelector('[name="total"][data-id="'+id+'"]').value;

        if (dataDate.length < 1) {
            alert('Необходимо заполнить дату!');
            return false;
        }
        var formData = new FormData();
        formData.append(0, 'action-edit');
        formData.append(1, dataDate);
        formData.append(2, dataElectric);
        formData.append(3, dataHotWater);
        formData.append(4, dataColdWater);
        formData.append(5, total);
        formData.append(6, id);
        axios.post('/local/tools/ajax.php', formData)
        .then(function (res) {
            document.querySelector('.table-count').innerHTML = res.data;
            document.querySelector('[name="button_edit"][data-id="'+id+'"]').innerHTML = '<span style="color: blue;">Редактировать &#10004;</span>';
         setTimeout(function() {
                document.querySelector('[name="button_edit"][data-id="'+id+'"]').innerHTML = 'Редактировать'
            }, 3000);
        })
        .catch(function (err) {
            console.log(err.message);
        });
    }
    function dataDelete (id) {
        if(confirm("Вы уверены что хотите удалить показания за день?")){
            var formData = new FormData();
            formData.append(0, 'action-delete');
            formData.append(1, id);
            axios.post('/local/tools/ajax.php', formData)
            .then(function (res) {
                document.querySelector('.table-count').innerHTML = res.data;

            })
            .catch(function (err) {
                console.log(err.message);
            });
        }

    }

</script>
<div id="app">

    <br>
    <span v-if="seen">Сейчас меня видно</span>
    <br>
    <ol>
        <li v-for="todo in todos">
            {{ todo.text }}
        </li>
    </ol>
</div>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            seen: true,
            todos: [
                { text: 'Изучить JavaScript' },
                { text: 'Изучить Vue' },
                { text: 'Создать что-нибудь классное' }
            ]
        }
    })
</script>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
