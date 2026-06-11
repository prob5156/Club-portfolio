<?php
// logout.php
require_once __DIR__ . '/config/session.php';
session_destroy();
header("Location: /Dhrupodi/login.php");
exit();
