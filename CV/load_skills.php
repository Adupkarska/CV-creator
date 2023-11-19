<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cv";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Грешка при връзка с базата данни: " . $conn->connect_error);
}

// Заявка за извличане на уменията
$sql = "SELECT id, name FROM skills";
$result = $conn->query($sql);

$skills = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $skills[] = $row;
    }
}

$conn->close();


// Връщане на резултата в JSON формат
echo json_encode($skills);
?>