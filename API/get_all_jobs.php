<?php

include '../config.php';

$stmt = $db->prepare('SELECT * from job_description j INNER JOIN companyprofile c ON j.FK_COMPANY_ID = c.COMPANY_ID LIMIT 6');
$stmt->execute();
$result = $stmt->get_result();  
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);

?>