<?php

include '../config.php';

$companyId = $_GET['companyId'];

$stmt = $db->prepare('SELECT * from job_description WHERE FK_COMPANY_ID = ?');
$stmt->bind_param('i', $companyId);
$stmt->execute();
$result = $stmt->get_result();  
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);

?>