<?php
require '../../connection.php';

if(isset($_POST['UserID']) && isset($_POST['LogCount'])){
    $user_id = $_POST['UserID'];
    $log_count = $_POST['LogCount'];

    $update_log_count_query = "UPDATE Users SET LogCount = ? WHERE UserID = ?";

    $stmt = $conn->prepare($update_log_count_query);
    $stmt->bind_param("is", $log_count, $user_id);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo json_encode(["Log Count Update Alert" => true]);
    } else {
        echo json_encode(["Log Count Update Alert" => false]);
    }

    $stmt->close();
}

$conn->close();

?>