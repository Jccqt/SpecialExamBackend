<?php 
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$get_logs_query = "SELECT date, LogType, UserID, Description FROM Logs";
$result = $conn->query($get_logs_query);

if($result->num_rows > 0){
    $logs = [];

    while($row = $result->fetch_assoc()){
        $logs[] = $row;
    }
    
    echo json_encode($logs);
} else {
    echo json_encode(['error' => 'No pending requests found.']);
    exit;
}
$conn->close();
?>