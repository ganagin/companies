<?php

$id = (int)$_GET['id'];
$company = Company::get($id);
if ($company) {
    echo json_encode($company);
} else {
    http_response_code(404);
    echo json_encode([
        'error' => 'Not found',
    ]);
}
