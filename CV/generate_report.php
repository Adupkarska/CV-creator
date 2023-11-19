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

// Получаване на началната и крайната дата от POST заявката
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];



// Извличане на CV-та на хора, родени в избрания период
$sql = "SELECT * FROM candidates WHERE birthday BETWEEN '$startDate' AND '$endDate'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $candidates = array();
    while ($row = $result->fetch_assoc()) {
        $candidates[] = array(
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'birthday' => $row['birthday'],
            'university' => $row['university'],
            'skills' => $row['skills']
        );
    }

    // Връщане на данните като JSON отговор
    header('Content-Type: application/json');
    echo json_encode($candidates);
} else {
    echo json_encode(array()); // Връщане на празен списък, ако няма намерени кандидати
}

$conn->close();
?>
