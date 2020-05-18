<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
Bitrix\Main\Page\Asset::getInstance()->addString("<link href=\"/schetchik/css/style.css\" type=\"text/css\" rel=\"stylesheet\">");
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

<div class="container">
    <p>
    <h2>Тариф</h2>
    <div class="price_water">Расход воды: <b><?= $price['water'] ?></b></div>
    <div class="price_warming">Нагрев воды: <b><?= $price['warming'] ?></b></div>
    <div class="price_electric">Электричество: <b><?= $price['electric'] ?></b></div>
    </p>
    <div class="fresh-table row justify-content-center">
        <!-- Изменение фона таблицы: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
        Изменение фона тулбара страницы: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
        -->
        <table id="fresh-table" class="table">
            <thead>
            <th class="p-sm-3" data-field="id">Дата:</th>
            <th class="p-sm-3" data-field="name">Элек.:</th>
            <th class="p-sm-3" data-field="salary">Гор. вода:</th>
            <th class="p-sm-3" data-field="country">Хол. вода:</th>
            <th class="p-sm-3" data-field="city">Сумма:</th>
            <th class="p-sm-3" data-field="actions">Actions</th>
            </thead>
            <tbody class="table-count">
            <? foreach ($data as $key => $item):
            if ((count($data) - $key) > 5) {
                continue;
            }
            if (count($data) != (1 + $key)) {
            ?>
            <tr>
                <td class="p-sm-3">
                    <input class="form__input" type="date" name="date" data-id="<?= $item['id'] ?>" value="<?= $item['date'] ?>" required>
                </td>
                <td class="p-sm-3">
                    <input class="form__input" type="number" name="electric" data-id="<?= $item['id'] ?>" value="<?= $item['electric'] ?>" maxlength="30" required>
                </td>
                <td class="p-sm-3">
                    <input class="form__input" type="number" name="hot_water" data-id="<?= $item['id'] ?>" value="<?= $item['hot_water'] ?>" maxl="10000000" required>
                </td>
                <td class="p-sm-3">
                    <input class="form__input" type="number" name="cold_water" data-id="<?= $item['id'] ?>" value="<?= $item['cold_water'] ?>" maxl="1000000" required>
                </td>
                <td class="p-sm-3">
                    <input class="form__input" type="text" name="total" data-id="<?= $item['id'] ?>" value="<?= $item['total'] ?>" maxl="1000000" required>
                </td>
                <td class="p-sm-3">
                    <button title="calculator" class="table-action calculator" name="button" data-id="<?= $item['id'] ?>" onclick="calculate_edit(<?= $item['id'] ?>,<?= $data[$key - 1]['id']; ?>);">
                        <i class="fa fa-calculator"></i>
                    </button>
                    <button class="form__button table-action edit" title="Edit" name="button_edit" data-id="<?= $item['id'] ?>" onclick="add_date(<?= $item['id'] ?>,<?= $data[$key - 1]['id']; ?>);" type="submit">
                        <i class="fa fa-edit"></i>
                    </button>
                    <span title="Remove" class="table-action remove" onclick="dataDelete(<?= $item['id'] ?>)">
                        <i class="fa fa-remove"></i>
                    </span>
                </td>
            </tr>
            <?php } else { ?>
            <tr>
                <td class="p-sm-3">
                    <input class="form__input" type="date" name="date" data-id="<?= $item['id'] ?>" value="<?= $item['date'] ?>" required>
                </td>
                <td class="p-sm-3 form__input-electric-old">
                    <input class="form__input" type="number" name="electric" data-id="<?= $item['id'] ?>" value="<?= $item['electric'] ?>" maxlength="30" required>
                </td>
                <td class="p-sm-3 form__input-hot_water-old">
                    <input class="form__input" type="number" name="hot_water" data-id="<?= $item['id'] ?>" value="<?= $item['hot_water'] ?>" maxl="10000000" required>
                </td>
                <td class="p-sm-3 form__input-cold_water-old">
                    <input class="form__input" type="number" name="cold_water" data-id="<?= $item['id'] ?>" value="<?= $item['cold_water'] ?>" maxl="1000000" required>
                </td>
                <td class="p-sm-3">
                    <input class="form__input" type="text" name="total" data-id="<?= $item['id'] ?>" value="<?= $item['total'] ?>" maxl="1000000" required>
                </td>
                <td class="p-sm-3">
                    <button  name="button" data-id="<?= $item['id'] ?>" onclick="calculate_edit(<?= $item['id'] ?>,<?= $data[$key - 1]['id']; ?>);" rel="tooltip" title="calculator" class="table-action calculator" title="calculator">
                        <i class="fa fa-calculator"></i>
                    </button>
                    <button class="form__button table-action edit" title="Edit" name="button_edit" data-id="<?= $item['id'] ?>" onclick="add_date(<?= $item['id'] ?>,<?= $data[$key - 1]['id']; ?>);">
                        <i class="fa fa-edit"></i>
                    </button>
                    <span class="table-action remove" onclick="dataDelete(<?= $item['id'] ?>)" title="Remove">
                        <i class="fa fa-remove"></i>
                    </span>
                </td>
            </tr>
                <?
            }
            endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td class="p-sm-3">
                    <input class="form__input form__input-date" type="date" name="date" value="" min="<?= date("Y") ?>-01-01" max="<?= date("Y") ?>-12-31" autofocus>
                </td>
                <td class="p-sm-3">
                    <input class="form__input form__input-electric" type="number" name="electric" value="" maxlength="30" required>
                </td>
                <td class="p-sm-3">
                    <input class="form__input form__input-hot_water" type="number" name="hot_water" value="" maxl="10000000" required>
                </td>
                <td class="p-sm-3">
                    <input class="form__input form__input-cold_water" type="number" name="cold_water" value="" maxl="1000000" required>
                </td>
                <td class="p-sm-3">
                    <span class="total"></span>
                </td>
                <td class="p-sm-3" >
                    <button onclick="calculate();">
                        <i class="fa fa-calculator"></i>
                    </button>
                    <button class="form__button_add" name="button_add" type="submit"><i class="fa fa-cloud-upload"></i></button>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<script src="/schetchik/js/script.js"></script>

<div id="app" style="display: none">

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
                {text: 'Изучить JavaScript'},
                {text: 'Изучить Vue'},
                {text: 'Создать что-нибудь классное'}
            ]
        }
    });
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
