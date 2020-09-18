<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = Bitrix\Main\Context::getCurrent()->getRequest();
$db = new \PDO\DB();

switch ($request->get('action')) {
    case 'add':
        $query = "INSERT INTO meters (date, electric, hot_water, cold_water, total) VALUES (:date, :electric, :hot_water, :cold_water, :total)";

        $args = [
            'date' => $request->get('date'),
            'electric' => $request->get('electric'),
            'hot_water' => $request->get('hot_water'),
            'cold_water' => $request->get('cold_water'),
            'total' => $request->get('total'),
        ];

        $db::sql($query, $args);

        break;
    case 'delete_Admin':
        if (!$USER->IsAdmin()){break;}// Праверка на админа
        $db::sql("DELETE FROM `meters` WHERE `id` = ?", [$request->get('id')]);
        break;
    case 'action-edit__admin':
        if (!$USER->IsAdmin()){break;}// Праверка на админа
        $query = "UPDATE meters SET date=:date, electric=:electric, hot_water=:hot_water, cold_water=:cold_water, total=:total WHERE id=:id";
        $args = [
            'date' => $request->get('date'),
            'electric' => $request->get('electric'),
            'hot_water' => $request->get('hot_water'),
            'cold_water' => $request->get('cold_water'),
            'total' => $request->get('total'),
            'id' => $request->get('id')
        ];

        $db::sql($query, $args);
        break;
    case 'isAdmin':
        echo json_encode($USER->IsAdmin());// Праверка на админа
//        echo json_encode(true);
        die();

    default:
        if ($strCount = $request->get('price')){
            $price = $db::getRow("SELECT * FROM price ORDER BY id DESC LIMIT " . $strCount );

            $price[] = $USER->IsAdmin();
            echo json_encode($price);
            die();
        }
}
$data = $db::getRows("SELECT * FROM meters ORDER BY id DESC LIMIT 3");
$data = array_reverse($data);
echo json_encode($data);
die();
