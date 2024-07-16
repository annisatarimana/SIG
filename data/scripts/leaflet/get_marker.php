<?php 

$currentPath = __DIR__;
$currentPathArray = explode("\\", $currentPath);
array_pop($currentPathArray);
$var_file = implode("\\", $currentPathArray);

require_once ($var_file . "\\var.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . $CONFIG_FILE);

require $CONFIG["PATH"]["DB_CONNECTION"];

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $stmt = $DB -> prepare("SELECT * FROM markers WHERE user_id = ?");
    $stmt -> bind_param('i', $_SESSION['user_id']);
    $stmt -> execute();

    $_SESSION['markers'] = [
        'data' => $stmt -> get_result() ->fetch_all(MYSQLI_ASSOC)
    ];
}
?>