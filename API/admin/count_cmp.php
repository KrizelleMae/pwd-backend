<?php

include '../../config.php';

$stmt = $db->prepare("SELECT COUNT(*) from companyprofile");
$stmt->execute();
$pending = $stmt->get_result()->fetch_row();

echo json_encode($pending[0]);


?>