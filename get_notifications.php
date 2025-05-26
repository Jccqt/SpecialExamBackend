<?php
require 'connection.php';

if(isset($_POST['Recipient'])){

    $recipient = $_POST['Recipient'];

    $get_notif_query = "SELECT Title, Message FROM Notifications WHERE Recipient = ?";

    $stmt = $conn->prepare($get_notif_query);
    $stmt->bind_param("s", $recipient);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $titles = [];
        $messages = [];
        
        while($row = $result->fetch_assoc()){
            $titles[] = $row['Title'];
            $messages[] = $row['Message'];
        }
        
        echo json_encode(["get notif alert" => true,
                        "titles" => $titles,
                        "messages" => $messages]);
    } else {
        echo json_encode(["get notif alert" => false]);
    }

    $stmt->close();
}
$conn->close();
?>