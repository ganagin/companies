<?php

$buildingId = (int)$_GET['buildingId'];
$companies = Company::getByBuildingId($buildingId);
echo json_encode($companies);
