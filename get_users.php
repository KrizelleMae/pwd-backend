<?php

include './config.php';

$stmt = $db->prepare('SELECT * from user');
$stmt->execute();
$result = $stmt->get_result();
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);

?>