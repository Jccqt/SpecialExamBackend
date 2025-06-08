<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$responses = [
    'totalRequest' => 0,
    'approvedRequest' => 0,
    'pendingRequest' => 0,
    'topReason' => 'N/A',
    'topProgram' => 'N/A'
];

$get_total_request_query = "SELECT COUNT(ApplicationID) AS TotalRequest FROM Applications";
$total_request = $conn->query($get_total_request_query);
if($row = $total_request->fetch_assoc()) {
    $responses['totalRequest'] = $row['TotalRequest'];
}

$get_approved_request_query = "SELECT COUNT(ApplicationID) AS ApprovedRequest FROM Applications WHERE ApplicationStatus = 2";
$total_approved = $conn->query($get_approved_request_query);
if($row = $total_approved->fetch_assoc()) {
    $responses['approvedRequest'] = $row['ApprovedRequest'];
}

$get_pending_request_query = "SELECT COUNT(ApplicationID) AS PendingRequest FROM Applications WHERE ApplicationStatus = 1";
$total_pending = $conn->query($get_pending_request_query);
if($row = $total_pending->fetch_assoc()) {
    $responses['pendingRequest'] = $row['PendingRequest'];
}

$get_top_reason_query = "SELECT ReasonType, COUNT(*) as count FROM Applications GROUP BY ReasonType ORDER BY count DESC LIMIT 1";
$top_reason = $conn->query($get_top_reason_query);
if($row = $top_reason->fetch_assoc()) {
    $responses['topReason'] = $row['ReasonType'];
}

$get_top_program_query = "SELECT ProgramID, COUNT(*) as count FROM Applications GROUP BY ProgramID ORDER BY count DESC LIMIT 1";
$top_program = $conn->query($get_top_program_query);
if($row = $top_program->fetch_assoc()) {
    $responses['topProgram'] = $row['ProgramID'];
}

echo json_encode($responses);
$conn->close();
?>