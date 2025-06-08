<?php
require '../connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$login_query = 'SELECT Password FROM Users WHERE Email = ?';

$stmt = $conn->prepare($login_query);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){
    $row = $result->fetch_assoc();

    if(password_verify($password, $row['Password'])){
        header('Location: http://127.0.0.1:5503/Components/Homepage.html');
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href = '../Revamped_Web_Special_Exam/Login.html';</script>";
    }
} else {
    echo "<script>alert('Invalid email or password'); window.location.href = '../Revamped_Web_Special_Exam/Login.html';</script>";
}

$stmt->close();
$conn->close();
?>