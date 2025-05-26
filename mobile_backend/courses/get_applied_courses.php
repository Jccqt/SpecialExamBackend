<?php
require '../../connection.php';

if(isset($_POST['UserID'])){
    $student_id = $_POST['UserID'];

    $get_applied_courses_query = "SELECT CourseExam.CourseID FROM ApplicationCourseExam CouseExam JOIN Applications Application ON CourseExam.ApplicationID = Application.ApplicationID 
    WHERE Application.UserID = ?";

    $stmt = $conn->prepare($get_applied_courses_query);
    $stmt->bind_param("s", $student_id);
    $stmt-> execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $applied_courses = [];

        while($row = $result->fetch_assoc()){
            $applied_courses[] = $row["CourseID"];
        }

        echo json_encode(["Course Alert" => true, 
        "Applied Courses" => $applied_courses]);
    } else {
        echo json_encode(["Course Alert" => false]);
    }

    $stmt->close();
}
$conn->close();
?>