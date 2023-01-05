<?php
include '../../config.php';

$job = json_decode(file_get_contents('php://input'));
$userId = $job->userId;
$jobId = $job->jobId;
$companyId = $job->companyId;

$stmt = $db->prepare('INSERT INTO `application` (`FK_JOB_ID`, `FK_PWD_ID`, `FK_COMPANY_ID`) VALUES (?, ?, ?);');
$stmt->bind_param('iii', $jobId, $userId, $companyId);

if($stmt->execute()){

    $data = ['status' => 1, 'message' => "Success."];

} else {    
    $data = ['status' => 0, 'message' => "Failed to updated record."];  
}

echo json_encode($data);
$db->close();


?>