<?php

include './config.php';

$job = json_decode(file_get_contents('php://input'));
$TITTLE = $job->TITTLE;
$DESCRIPTION = $job->DESCRIPTION;
$SALARY = $job->SALARY;


$stmt = $db->prepare('INSERT INTO job (TITTLE, DESCRIPTION,SALARY) VALUES (?, ?, ?);');
$stmt->bind_param('sss', $TITTLE, $DESCRIPTION, $SALARY);

if($stmt->execute()){
    echo json_encode('success');
} else {
    echo json_encode('failed');
}

?>