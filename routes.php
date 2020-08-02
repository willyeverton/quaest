<?php

$app->get('/', ['DashboardController', 'index']);
$app->post('/', ['DashboardController', 'chart']);