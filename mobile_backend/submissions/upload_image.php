<?php
require '../../connection.php';

if(isset($_POST['ApplicationID']) && isset($_FILES['files'])){
    $application_id = $_POST['ApplicationID'];

    $upload_dir = '../../application_images/' . $application_id . '/';
    if(!file_exists($upload_dir)){
        mkdir($upload_dir, 0777, true);
    }

    $file_count = count($_FILES['files']['name']);

    $uploaded_files = [];

    for($i = 0; $i < $file_count; $i++){
        $file_name = $_FILES['files']['name'][$i];
        $tmp_name = $_FILES['files']['tmp_name'][$i];

        $unique_name = uniqid() . '-' . $file_name;
        $target_path = $upload_dir . $unique_name;

        if(move_uploaded_file($tmp_name, $target_path)){
            $uploaded_files[] = $unique_name;

            $upload_query = "INSERT INTO ApplicationImages (ApplicationID, ImageName) VALUES (?, ?)";
            $stmt = $conn->prepare($upload_query);
            $stmt->bind_param("ss", $application_id, $unique_name);
            $stmt->execute();
            $stmt->close();
        }
    }

    if(count($uploaded_files) > 0){
        echo json_encode(['Upload Alert' => true]);
    } else {
        echo json_encode(['Upload Alert' => false]);
    }
}
$conn->close();
?>