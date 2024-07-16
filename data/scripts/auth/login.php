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
    if ($_POST['action'] === "login") {
       
        $USERNAME = $_POST['username'];
        $PASSWORD = $_POST['password'];

        $stmt = $DB -> prepare("SELECT * FROM users WHERE username = ?");
        $stmt -> bind_param("s", $USERNAME);
        $stmt -> execute();

        $user = $stmt -> get_result() -> fetch_assoc();

        if ($user && password_verify($PASSWORD, $user['password'])){
           $_SESSION['user_id'] = $user['id'];
           $_SESSION['alert'] = [
               'type' => 'success',
               'title' => 'Login berhasil'
           ];
           header("Location: " . $CONFIG['PATH']['VIEWS']['DASHBOARD']);
        } else {

            $_SESSION['alert'] = [
                'type' => 'error',
                'title' => 'Periksa Kembali',
                'text' => 'Username atau password mungkin salah'
            ];
            header("Location: " . $CONFIG['PATH']['VIEWS']['LOGIN']);
        }
    }
}

?>
