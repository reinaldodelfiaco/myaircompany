<?php
/*
*  Cont4 Framework
*  contato@cont4.me
*/


session_start();

require 'config.php';
require 'functions/app.php';

$app = new app();
$app->start();

