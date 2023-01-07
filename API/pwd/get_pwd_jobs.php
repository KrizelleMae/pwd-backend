<?php

include '../../config.php';

// $stmt = $db->prepare('SELECT * from user where role == 3');
$stmt = $db->prepare('SELECT * from jobs_disability dis INNER JOIN job_description job ON dis.FK_JOB_ID = job.JOB_ID INNER JOIN companyprofile cmp ON job.FK_COMPANY_ID = cmp.COMPANY_ID WHERE dis.FK_JOB_FOR_ID = ? AND job.STATUS = "ACTIVE"');
$stmt->bind_param('i', $_GET['jobForId']);
$stmt->execute();
$result = $stmt->get_result();
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);
// $db->close();
?>