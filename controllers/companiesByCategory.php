<?php

$categoryId = (int)$_GET['categoryId'];
$companies = Company::getByCategoryId($categoryId);
echo json_encode($companies);
