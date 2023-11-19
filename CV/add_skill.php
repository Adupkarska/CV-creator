<?php
 // Код за връзка с базата данни
$servername = "localhost";
$username = "root";
$password = "";
$database = "cv";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Грешка при връзка с базата данни: " . $conn->connect_error);
}

// Извличане на данни от заявката
$newSkillName = $_POST['skillName'];

// Вмъкнете код за вмъкване на ново умение в базата данни
$sql = "INSERT INTO skills (name) VALUES ('$newSkillName')";

$response = array();

if ($conn->query($sql) === TRUE) {
    // Успешно вмъкване на умение в базата данни
    $response['status'] = 'success';
    $response['message'] = 'Успешно добавено ново умение: ' . $newSkillName;
    $response['skill']['id'] = $conn->insert_id;
    $response['skill']['name'] = $newSkillName;
} else {
    $response['status'] = 'error';
    $response['message'] = 'Грешка при добавяне на умение: ' . $conn->error;
}

// Затваряне на връзката с базата данни
$conn->close();

// Връщане на резултата в JSON формат
echo json_encode($response);
?>


