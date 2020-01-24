<?php

$latitude = (float)$_GET['latitude'];
$longitude = (float)$_GET['longitude'];
$distance = (int)$_GET['distance'];
$companies = Company::getByCoordinate($latitude, $longitude, $distance);
echo json_encode($companies);
