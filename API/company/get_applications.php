<?php

include '../../config.php';

// $stmt = $db->prepare('SELECT * from user where role == 3');
$stmt = $db->prepare('SELECT * FROM application a INNER JOIN job_description b ON b.FK_COMPANY_ID = a.FK_COMPANY_ID INNER JOIN pwdprofile p ON p.FK_USER_ID = a.FK_PWD_ID WHERE a.FK_COMPANY_ID = ? GROUP BY a.APPLICATION_ID;');
$stmt->bind_param('i', $_GET['companyId']);
$stmt->execute();
$result = $stmt->get_result();
$response = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($response);
// $db->close();

?>