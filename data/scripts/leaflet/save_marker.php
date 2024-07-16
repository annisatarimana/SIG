<?php 
session_start();

$currentPath = __DIR__;
$currentPathArray = explode("\\", $currentPath);
array_pop($currentPathArray);
$var_file = implode("\\", $currentPathArray);

require_once ($var_file . "\\var.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . $CONFIG_FILE);

require $CONFIG["PATH"]["DB_CONNECTION"];

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $USERID = $_SESSION['user_id'];
    $LAT = $_POST['lat'];
    $LNG = $_POST['lng'];
    $NAME = $_POST['name'];
    $DESC = $_POST['description'];

    $stmt = $DB -> prepare("INSERT INTO markers(user_id, lat, lng, name, description) VALUES (?, ?, ?, ?, ?)");
    $stmt -> bind_param('iddss', $USERID, $LAT, $LNG, $NAME, $DESC);
    $stmt -> execute();

    if ($stmt -> affected_rows > 0) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Berhasil menambahkan marker'
        ];
        header("Location: " . $CONFIG['PATH']['VIEWS']['DASHBOARD']);
    }
}

?>