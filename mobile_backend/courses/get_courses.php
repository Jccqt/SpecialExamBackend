<?php
require '../../connection.php';

if(isset($_POST['UserID'])){
    $studentID = $_POST['UserID'];

    $get_courses_query = "SELECT Course.CourseID, Course.CourseName FROM Courses Course JOIN StudentCourses StudCourses ON Course.CourseID = StudCourses.CourseID 
    WHERE StudCourses.UserID = ? AND StudCourses.Status = 1";

    $stmt = $conn->prepare($get_courses_query);
    $stmt->bind_param("s", $studentID);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $courseID = [];
        $courses = [];

        while($row = $result->fetch_assoc()){
            $courseID[] = $row['CourseID'];
            $courses[] = $row['CourseName'];
        }

        echo json_encode(["Course Alert" => true,
        "Courses" => $courses,
        "CourseID" => $courseID]);
    } else {
        echo json_encode(["Course Alert" => false]);
    } 
$stmt->close();
}
$conn->close();
?>