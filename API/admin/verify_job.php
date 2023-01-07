<?php
include '../../config.php';

$job = json_decode(file_get_contents('php://input'));
$jobId = $job->jobId;

$stmt = $db->prepare('UPDATE `job_description` SET STATUS = "ACTIVE" WHERE JOB_ID = ?');
$stmt->bind_param('i', $jobId);

if($stmt->execute()){
    
    $data = ['status' => 1, 'message' => "Success."];

} else {    
    $data = ['status' => 0, 'message' => "Failed to updated record."];  
}

echo json_encode($data);
$db->close();


?>