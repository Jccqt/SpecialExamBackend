<?php
require '../../connection.php';

if(isset($_POST['ApplicationID'])){
    $application_id = $_POST['ApplicationID'];

    $get_application_details_query = "SELECT Course.CourseName, Exam.Term FROM ApplicationCourseExam CourseExam 
    JOIN Courses Course ON CourseExam.CourseID = Course.CourseID 
    JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID 
    WHERE CourseExam.ApplicationID = ?";

    $stmt = $conn->prepare($get_application_details_query);
    $stmt->bind_param("s", $application_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $courses = [];
        $term = null;

        while($row = $result->fetch_assoc()){
            $courses[] = $row['CourseName'];
            if($term === null) {
                $term = $row['Term'];
            }
        }

        echo json_encode(["Application Data Alert" => true,
        "Term" => $term,
        "Course Names" => $courses]);
    } else {
        echo json_encode(["Application Data Alert" => false,
        "Error Message" => "No data found on this Application ID"]);
    }
    $stmt->close();
} else {
    echo json_encode(["Application Data Alert" => false,
    "Error Message" => "Failed to get Application ID"]);
}
$conn->close();
?>