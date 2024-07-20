<?php
include 'connection.php';

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    $sql = "SELECT * FROM users WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(null);
    }
}