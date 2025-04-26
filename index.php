<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/env.php';
loadEnv();

session_start();

require_once 'helpers/helpers.php';
require "routes.php";