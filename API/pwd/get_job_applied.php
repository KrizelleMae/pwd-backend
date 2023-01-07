<?php

include '../../config.php';

// $stmt = $db->prepare('SELECT * from user where role == 3');
$stmt = $db->prepare('SELECT * from application a INNER JOIN job_description b ON a.FK_JOB_ID = b.JOB_ID INNER JOIN companyprofile c ON c.COMPANY_ID = a.FK_COMPANY_ID WHERE a.FK_PWD_ID = ?');
$stmt->bind_param('i', $_GET['userId']);
$stmt->execute();
$result = $stmt->get_result();
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);
// $db->close();
?>