<?php
session_start();
require_once __DIR__ . '/config/constants.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: ' . BASE_URL . '/dashboard/index.php');
} else {
    header('Location: ' . BASE_URL . '/authentication/login.php');
}
exit;
