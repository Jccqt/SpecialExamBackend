<?php
require '../connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$login_query = 'SELECT HeadPass FROM ProgramHeads WHERE HeadEmail = ?';

$stmt = $conn->prepare($login_query);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){
    $row = $result->fetch_assoc();

    if(password_verify($password, $row['HeadPass'])){
        header('Location: ../Web-Android-Final-Project/homepage.html');
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href = '../Web-Android-Final-Project/LoginPage.html';</script>";
    }
} else {
    echo "<script>alert('Invalid email or password'); window.location.href = '../Web-Android-Final-Project/LoginPage.html';</script>";
}

$stmt->close();
$conn->close();
?>