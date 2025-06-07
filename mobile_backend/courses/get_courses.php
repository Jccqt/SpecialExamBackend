<?php
require '../../connection.php';

if(isset($_POST['ProgramID'])){
    $studentID = $_POST['ProgramID'];

    $get_courses_query = "SELECT Course.CourseName, Program.CourseID FROM ProgramCourses Program 
    JOIN Courses Course ON Program.CourseID = Course.CourseID 
    WHERE Program.ProgramID = ?";

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