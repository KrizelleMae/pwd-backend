<?php
include '../../config.php';

$job = json_decode(file_get_contents('php://input'));
$title = $job->title;
$position = $job->position;
$description = $job->description;
$requirements = $job->requirements;
$jobType = $job->jobType;
$salary = $job->salary;
$department = $job->department;
$target = $job->target;
$companyId = $job->companyId;
$status = 'PENDING';
$jobId = rand(10000, 999999);

$stmt = $db->prepare('INSERT INTO `job_description` (`JOB_ID`, `TITLE`, `POSITION`, `JOB_DESCRIPTION`, `SALARY`, `JOB_TYPE`, `DEPARTMENT`, `REQUIREMENTS`,  `STATUS`, `FK_COMPANY_ID`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
$stmt->bind_param('issssssssi', $jobId, $title, $position, $description, $salary, $jobType, $department, $requirements, $status, $companyId);

if($stmt->execute()){

    foreach($target as $key => $value) {

        $insertTarget = $db->prepare('INSERT INTO jobs_disability (FK_JOB_ID, FK_JOB_FOR_ID) VALUES (?, ?)');
        $insertTarget->bind_param('ii', $jobId, $value);
        $insertTarget->execute();
    }

    $data = ['status' => 1, 'message' => "Success."];

} else {    
    $data = ['status' => 0, 'message' => "Failed to updated record."];  
}

echo json_encode($data);
$db->close();


?>