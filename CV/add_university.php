<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cv";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Грешка при връзка с базата данни: " . $conn->connect_error);
}

$newUniversityName = $_POST['universityName'];

$sql = "INSERT INTO universities (name) VALUES ('$newUniversityName')";

$response = array();

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
    $response['message'] = 'Успешно добавен нов университет: ' . $newUniversityName;
    $response['university'] = array('id' => $conn->insert_id, 'name' => $newUniversityName);
} else {
    $response['status'] = 'error';
    $response['message'] = 'Грешка при вмъкване на нов университет: ' . $conn->error;
}

$conn->close();

echo json_encode($response);
?>
