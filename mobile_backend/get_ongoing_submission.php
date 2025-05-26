<?php
require '../connection.php';

$get_ongoing_submission_query = "SELECT SchoolYearStart, SchoolYearEnd, GradingPeriod, Term, SubmissionStart, SubmissionEnd FROM Examinations WHERE ExamStatus = 1";

$result = $conn->query($get_ongoing_submission_query);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    
    echo json_encode(["Submission Alert" => true,
    "SchoolYearStart" => $row["SchoolYearStart"],
    "SchoolYearEnd" => $row["SchoolYearEnd"],
    "GradingPeriod" => $row["GradingPeriod"],
    "Term" => $row["Term"],
    "SubmissionStart" => $row["SubmissionStart"],
    "SubmissionEnd" => $row["SubmissionEnd"]]);
} else {
    echo json_encode(["Submission Alert" => false]);
}

$conn->close();
?>