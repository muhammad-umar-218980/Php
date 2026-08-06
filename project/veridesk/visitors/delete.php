<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

$id = $_GET['id'] ?? 0;

if ($id > 0) {
    $stmt = mysqli_prepare($conn, "DELETE FROM visitors WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header('Location: ' . BASE_URL . '/visitors/view.php?deleted=1');
exit;
