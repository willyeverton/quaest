<?php

$app->get('/', ['DashboardController', 'index']);
$app->get('chart', ['DashboardController', 'chart']);