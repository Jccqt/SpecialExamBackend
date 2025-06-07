<?php
require '../connection.php';

if(isset($_POST['UserID'])){
    $user_id = $_POST['UserID'];
    

    $conn->begin_transaction();

    try{
        $total_application_count_query = "SELECT COUNT(ApplicationID) AS TotalApplicationCount FROM Applications WHERE UserID = ?";
        $total_application_count_stmt = $conn->prepare($total_application_count_query);
        $total_application_count_stmt->bind_param("s", $user_id);
        $total_application_count_stmt->execute();
        $total_application_count_result = $total_application_count_stmt->get_result();
        $total_application_count_row = $total_application_count_result->fetch_assoc();

        if($total_application_count_result->num_rows > 0){
            $total_application_count = $total_application_count_row['TotalApplicationCount'];
        } else {
            $total_application_count = "0";
        }


        $total_pending_count_query = "SELECT COUNT(ApplicationID) AS TotalPendingCount FROM Applications WHERE UserID = ? AND ApplicationStatus = 1";
        $total_pending_count_stmt = $conn->prepare($total_pending_count_query);
        $total_pending_count_stmt->bind_param("s", $user_id);
        $total_pending_count_stmt->execute();
        $total_pending_count_result = $total_pending_count_stmt->get_result();
        $total_pending_count_row = $total_pending_count_result->fetch_assoc();

        if($total_pending_count_result->num_rows > 0){
            $total_pending_count = $total_pending_count_row['TotalPendingCount'];
        } else {
            $total_pending_count = "0";
        }


        $total_denied_count_query = "SELECT COUNT(ApplicationID) AS TotalDeniedCount FROM Applications WHERE UserID = ? AND ApplicationStatus = 0";
        $total_denied_count_stmt = $conn->prepare($total_denied_count_query);
        $total_denied_count_stmt->bind_param("s", $user_id);
        $total_denied_count_stmt->execute();
        $total_denied_count_result = $total_denied_count_stmt->get_result();
        $total_denied_count_row = $total_denied_count_result->fetch_assoc();

        if($total_denied_count_result->num_rows > 0){
            $total_denied_count = $total_denied_count_row['TotalDeniedCount'];
        } else {
            $total_denied_count = "0";
        }

        $total_accepted_count_query = "SELECT COUNT(ApplicationID) AS TotalAcceptedCount FROM Applications WHERE UserID = ? AND ApplicationStatus = 2";
        $total_accepted_count_stmt = $conn->prepare($total_accepted_count_query);
        $total_accepted_count_stmt->bind_param("s", $user_id);
        $total_accepted_count_stmt->execute();
        $total_accepted_count_result = $total_accepted_count_stmt->get_result();
        $total_accepted_count_row = $total_accepted_count_result->fetch_assoc();

        if($total_accepted_count_result->num_rows > 0){
            $total_accepted_count = $total_accepted_count_row['TotalAcceptedCount'];
        } else {
            $total_accepted_count = "0";
        }

        

        echo json_encode(["Application Data Alert" => true,
        "Total Application Count" => $total_application_count,
        "Total Pending Count" => $total_pending_count,
        "Total Denied Count" => $total_denied_count,
        "Total Accepted Count" => $total_accepted_count]);

        $total_application_count_stmt->close();
        $total_pending_count_stmt->close();
        $total_denied_count_stmt->close();
        $total_accepted_count_stmt->close();
    }catch(error){
        echo json_encode(["Application Data Alert" => false]);
    }
}
$conn->close();
?>