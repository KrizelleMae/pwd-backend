<?php

include '../../config.php';

// $stmt = $db->prepare('SELECT * from user where role == 3');
$stmt = $db->prepare('SELECT * from pwdprofile WHERE FK_USER_ID = ?');
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);
// $db->close();
?>