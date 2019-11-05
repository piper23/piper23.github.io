<?php
require("../customs/custom.php");
require('../models/model.php');
$cusValidation = new data\functions\Customs();
$model = new Model();



if ($_SERVER['REQUEST_METHOD'] === 'GET') {




echo   json_encode($model->selectInventory());
}