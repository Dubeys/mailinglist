<?php
session_start();
include_once('functions.php');
require_once('db_connect.php');
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
