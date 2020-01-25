<?php

$buildings = Building::getAll();
echo json_encode($buildings);
