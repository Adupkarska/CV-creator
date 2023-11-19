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

    // Извличане на данни от формата
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $university_id = $_POST['university']; // Университет
    $skills_ids = $_POST['skills']; // Масив с умения в технологии

    $university_name = '';
    // Извличане на името на университета
    $sql = "SELECT name FROM universities WHERE id = $university_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $university_name = $row['name'];
    } else {
        $university_name = "Няма избран университет";
    }

    $skills = array();
    foreach ($skills_ids as $skill_id) {
        // Извличане на името на умението от базата данни
        $sql = "SELECT name FROM skills WHERE id = $skill_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $skills[] = $row['name'];
        }
    }
    // Преобразуване на масива с умения в технологии във формата на низ (за да го запазим в базата данни)
    $skills_str = implode(', ', $skills);

    // Въвеждане на данните в базата данни
    $sql = "INSERT INTO candidates (first_name, last_name, birthday, university, skills) VALUES ('$first_name', '$last_name', '$birthday', '$university_name', '$skills_str')";

    if ($conn->query($sql) === TRUE) {
        // Пренасочване към началната страница със съобщението за успех
        header('Location: index.php?status=success&message=Успешно записано CV');
    } else {
        // Пренасочване към началната страница със съобщението за грешка
        header('Location: index.php?status=error&message=Грешка при запис на CV: ' . $conn->error);
    }
    $conn->close();

    // Връщаме JSON отговор на клиента
    header('Content-Type: application/json');
    echo json_encode($response);
?>




