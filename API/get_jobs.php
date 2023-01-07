<?php

include '../config.php';

$stmt = $db->prepare('SELECT * from job_description a INNER JOIN companyprofile b ON b.COMPANY_ID = a.FK_COMPANY_ID');
$stmt->execute();
$result = $stmt->get_result();  
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);

?>