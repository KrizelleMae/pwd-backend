<?php

include '../../config.php';

$stmt = $db->prepare("SELECT COUNT(*) from job_description WHERE STATUS = 'ACTIVE'");
$stmt->execute();
$jobs = $stmt->get_result()->fetch_row();

$cmp = $db->prepare("SELECT COUNT(*) from companyprofile");
$cmp->execute();
$company = $cmp->get_result()->fetch_row();


$st = $db->prepare("SELECT COUNT(*) from pwdprofile");
$st->execute();
$pwd = $st->get_result()->fetch_row();

echo json_encode(array('jobs' => $jobs[0], 'company' => $company[0], 'pwd' => $pwd[0]));

?>