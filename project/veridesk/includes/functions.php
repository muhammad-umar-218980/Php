<?php
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function getTotalVisitors($conn) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM visitors");
    return mysqli_fetch_assoc($result)['total'];
}

function getTodayVisitors($conn) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM visitors WHERE visit_date = CURDATE()");
    return mysqli_fetch_assoc($result)['total'];
}

function getMonthVisitors($conn) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM visitors WHERE MONTH(visit_date) = MONTH(CURDATE()) AND YEAR(visit_date) = YEAR(CURDATE())");
    return mysqli_fetch_assoc($result)['total'];
}

function getRecentVisitors($conn, $limit = 5) {
    $result = mysqli_query($conn, "SELECT * FROM visitors ORDER BY created_at DESC LIMIT $limit");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function adminExists($conn) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
    $row = mysqli_fetch_assoc($result);
    return $row['total'] > 0;
}
