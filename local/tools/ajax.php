<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = Bitrix\Main\Context::getCurrent()->getRequest();


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
switch ($request->get('0')) {
    case 'action-add':
        $data = [
            'date' => $request->get('1'),
            'electric' => $request->get('2'),
            'hot_water' => $request->get('3'),
            'cold_water' => $request->get('4'),
            'total' => $request->get('5'),
        ];

        $sql = "INSERT INTO meters (date, electric, hot_water, cold_water, total) VALUES (:date, :electric, :hot_water, :cold_water, :total)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);

        break;
    case 'action-edit':
        $data = [
            'date' => $request->get('1'),
            'electric' => $request->get('2'),
            'hot_water' => $request->get('3'),
            'cold_water' => $request->get('4'),
            'total' => $request->get('5'),
            'id'  => $request->get('6')
        ];

        $sql = "UPDATE meters SET date=:date, electric=:electric, hot_water=:hot_water, cold_water=:cold_water, total=:total WHERE id=:id";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
        break;
    case 'action-delete':

        $sql = "DELETE FROM meters WHERE id =  :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $request->get('1'), PDO::PARAM_INT);
        $stmt->execute();
        break;
}
$stmt = $pdo->query("SELECT * FROM meters ORDER BY id DESC ");
$data = [];
while ($row = $stmt->fetch()) {
    $data[] = $row;
}
$data = array_reverse($data);
$formString = '';
foreach ($data as $key => $item) {
    if ((count($data) - $key) > 5){
        continue;
    }
    if (count($data) != (1+$key)) {
        $formString .= '
            <tr>
            <td class="p-sm-3"><input class="form__input" type="date" name="date" data-id="'. $item['id'] .'" value="'. $item['date'] .'" required></td>
            <td class="p-sm-3"><input class="form__input" type="number" name="electric" data-id="'. $item['id'] .'" value="'. $item['electric'] .'" maxlength="30" required></td><td class="p-sm-3"><input class="form__input" type="number" name="hot_water" data-id="'. $item['id'] .'" value="'. $item['hot_water'] .'" maxl="10000000" required></td>
                <td class="p-sm-3"><input class="form__input" type="number" name="cold_water" data-id="'. $item['id'] .'" value="'. $item['cold_water'] .'" maxl="1000000" required></td>
                <td class="p-sm-3"><input class="form__input" type="text" name="total" data-id="'. $item['id'] .'" value="'. $item['total'] .'" maxl="1000000" required></td>
                <td class="p-sm-3"><button title="calculator" class="table-action calculator" name="button" data-id="'. $item['id'] .'" onclick="calculate_edit('. $item['id'] .','. $data[$key - 1]['id'] .');"><i class="fa fa-calculator"></i></button>
                    <button class="form__button table-action edit" title="Edit" name="button_edit" data-id="'. $item['id'].'" onclick="add_date('. $item['id'] .','. $data[$key - 1]['id'] .');" type="submit"><i class="fa fa-edit"></i></button>
                    <span title="Remove" class="table-action remove" onclick="dataDelete('. $item['id'] .')"><i class="fa fa-remove"></i></span>
                </td>
            </tr>';
     } else {
        $formString .= '
            <tr>
                <td class="p-sm-3"><input class="form__input" type="date" name="date" data-id="'. $item['id'] .'" value="'. $item['date'] .'" required></td>
                <td class="p-sm-3 form__input-electric-old"><input class="form__input" type="number" name="electric" data-id="'. $item['id'] .'" value="'. $item['electric'] .'" maxlength="30" required></td>
                <td class="p-sm-3 form__input-hot_water-old"><input class="form__input" type="number" name="hot_water" data-id="'. $item['id'] .'" value="'. $item['hot_water'] .'" maxl="10000000" required></td>
                <td class="p-sm-3 form__input-cold_water-old"><input class="form__input" type="number" name="cold_water" data-id="'. $item['id'] .'" value="'. $item['cold_water'] .'" maxl="1000000" required></td>
                <td class="p-sm-3"><input class="form__input" type="text" name="total" data-id="'. $item['id'] .'" value="'. $item['total'] .'" maxl="1000000" required></td>
                <td class="p-sm-3">
                    <button  name="button" data-id="'. $item['id'] .'" onclick="calculate_edit('. $item['id'] .','. $data[$key - 1]['id'] .');" rel="tooltip" title="calculator" class="table-action calculator" title="calculator"><i class="fa fa-calculator"></i></button>
                    <button class="form__button table-action edit" title="Edit" name="button_edit" data-id="'. $item['id'] .'" onclick="add_date('. $item['id'] .','. $data[$key - 1]['id'] .');"><i class="fa fa-edit"></i></button>
                    <span class="table-action remove" onclick="dataDelete('. $item['id'] .')" title="Remove"><i class="fa fa-remove"></i>
                    </span>
                </td>
            </tr>';
    }
}
echo $formString;
die();