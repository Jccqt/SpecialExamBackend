<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$get_proctor_query = "SELECT FirstName, MiddleName, LastName, UserID FROM Users WHERE Role = 'Proctor'";
$result = mysqli_query($conn, $get_proctor_query);

$proctors = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fullName = $row['FirstName'];
        if (!empty($row['MiddleName'])) {
            $fullName .= ' ' . $row['MiddleName'];
        }
        $fullName .= ' ' . $row['LastName'];
        
        $proctors[] = array(
            'id' => $row['UserID'],
            'name' => $fullName
        );
    }
    echo json_encode(['status' => 'success', 'data' => $proctors]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No proctors found']);
}

mysqli_close($conn);
?> 