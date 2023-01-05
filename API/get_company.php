<?php

include '../config.php';

// $stmt = $db->prepare('SELECT * from user where role == 3');
$stmt = $db->prepare('SELECT * from companyprofile');
$stmt->execute();
$result = $stmt->get_result();
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);

?>