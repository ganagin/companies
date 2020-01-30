<?php

spl_autoload_register(function($model) {
    require "../models/{$model}.php";
});

error_reporting(E_ALL);

set_error_handler(function(int $number, string $error, string $file, int $line, array $context){
    $error = "$error --- $file:$line";
    throw new Exception($error);
});

require '../config.php';

try {

    $controller = '../controllers/' . basename($_GET['controller']) . '.php';
    if (is_file($controller)) {
        header('Content-Type: application/json');
        require $controller;
    } else {
        http_response_code(404);
        echo json_encode([
            'error' => 'Not found',
        ]);
    }

} catch (Exception $e) {
    new Errors($e);
}
