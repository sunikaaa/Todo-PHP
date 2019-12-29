<?php
require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/lib/functions.php');
require_once(__DIR__ . '/lib/Todo.php');

$todoApp = new \MyApp\Todo();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $res = $todoApp->post();
        header('Content-Type: application/json');
        echo json_encode($res);
        exit;
    } catch (Exception $e) {
        header($_SERVER['SERVER_PROTOCOL'] . '500 internal server Error', true, 500);
        echo $e->getMessage();
        exit;
    }
}
