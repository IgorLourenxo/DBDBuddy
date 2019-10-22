<?php
session_start();
require_once("connection.php");

unset($_SESSION['username']);

header("Location: " . '../');

die();
