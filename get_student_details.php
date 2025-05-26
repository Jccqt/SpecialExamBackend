<?php
require 'connection.php';

if(isset($_POST['StudentID'])){
    $studentID = $_POST['StudentID'];

    $get_additional_courses = "SELECT AdditionalCourses FROM Students WHERE StudentID = ?";

    $get_student_details_query = "SELECT FirstName, LastName, MiddleName, "
}
?>