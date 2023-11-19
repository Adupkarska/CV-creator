<?php
$servername = "localhost";
$username = "root"; 
$password = "";  
$database = "cv";  
$conn = new mysqli($servername, $username, $password, $database);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Създаване на CV</title>

</head>
<body>
    <header>
        <h1>Създаване на CV</h1>
    </header>

<div class="container">
    <section id="create-cv">
            <h2>Създаване на CV</h2>
            <button id="reportButton">Генерирай справка </button>
            
        <form id="cv-form" action="submit_cv.php" method="post">
            <label for="first_name">Име:</label>
            <input type="text" id="first_name" name="first_name" required>
            <br>
            <label for="last_name">Фамилия:</label>
            <input type="text" id="last_name" name="last_name" required>
            <br>
            <label for="birthday">Дата на раждане:</label>
            <input type="date" id="birthday" name="birthday" required>
            <br>


            <label for="university">Университет:</label>
            <select id="university" name="university" required>
                <option value="" disabled selected>Изберете университет</option>
            </select>
            <button type="button" onclick="showAddUniversityPopup()">Добави</button>

            <div id="addUniversityPopup" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closeAddUniversityPopup()">&times;</span>
                    <h2>Добавяне на нов университет</h2>
                        <form id="addUniversityForm">
                            <label for="newUniversityName">Име на университета:</label>
                            <input type="text" id="newUniversityName" name="newUniversityName" >
                            <br>
                            <button type="button" onclick="addUniversity()">Добави</button>
                        
                </div>
            </div><br>

            <label for="skills">Умения в технологии:</label><br>
            <select id="skills" name="skills[]" multiple="multiple" required></select>
            <button onclick="showAddSkillPopup()">Добави</button>

            <div id="addSkillPopup" class="popup">
                <h3>Добавяне на ново умение</h3>
                <label for="newSkillName">Име на умение:</label>
                <input type="text" id="newSkillName" name="newSkillName" >
                <button onclick="addSkill()">Добави</button>
                <button onclick="closeAddSkillPopup()">Откажи</button>
            </div></br>

            <button type="submit">Запис на CV</button>

        </form>

        
        <script>//popup университети

            // JavaScript код за управление на основната страница
            function showAddUniversityPopup() {
            document.getElementById('addUniversityPopup').style.display = 'block';}

            function closeAddUniversityPopup() {
            document.getElementById('addUniversityPopup').style.display = 'none';}

            function addUniversity() {
            var newUniversityName = document.getElementById("newUniversityName").value;

            // AJAX логика за изпращане на данни към сървъра
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_university.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Пример: пращаме името на новия университет като параметър
            var params = "universityName=" + encodeURIComponent(newUniversityName);

            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Обработка на отговора от сървъра
                var response = JSON.parse(xhr.responseText);

                if (response.status === "success") {
                    // Добавяне на новия университет в падащия списък
                    var select = document.getElementById("university");
                    var option = document.createElement("option");
                    option.value = response.university.id;
                    option.text = response.university.name;
                    select.appendChild(option);
                    document.getElementById("newUniversityName").value = "";

                    alert(response.message);
                    closeAddUniversityPopup();
                } else {
                    alert("Грешка при добавяне на университет: " + response.message);
                }
            }
            };

            // Изпращане на заявката
            xhr.send(params);
            }
        </script>
        <script>//popup умения
                    function showAddSkillPopup() {
                    document.getElementById('addSkillPopup').style.display = 'block';}

                    function closeAddSkillPopup() {
                    document.getElementById('addSkillPopup').style.display = 'none';}

                // Добавяне на умение
                function addSkill() {
                var newSkillName = document.getElementById("newSkillName").value;

                // AJAX логика за изпращане на данни към сървъра
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "add_skill.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                // Пример: пращаме името на новото умение като параметър
                var params = "skillName=" + encodeURIComponent(newSkillName);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Обработка на отговора от сървъра
                        var response = JSON.parse(xhr.responseText);

                        if (response.status === "success") {
                            // Добавяне на новото умение в падащия списък
                            var select = document.getElementById("skills");
                            var option = document.createElement("option");
                            option.value = response.skill.id;
                            option.text = response.skill.name;
                            select.appendChild(option);

                            // Изчистване на полето за въвеждане на ново умение
                            document.getElementById("newSkillName").value = "";

                            alert(response.message);
                            closeAddSkillPopup();
                        } else {
                            alert("Грешка при добавяне на умение: " + response.message);
                        }
                    }
                };

                // Изпращане на заявката
                xhr.send(params);}
        </script>
        <script> 
            
            function submitForm(event) {
                event.preventDefault(); 

                var form = document.getElementById("cv-form");
                var formData = new FormData(form);

                fetch("submit_cv.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())  
    .then(data => {
       
        alert(data.message); 
        form.reset(); 
    })
                .catch(error => {
                    console.error("Грешка при изпращане на формата:", error);
                    alert("Възникна грешка. Моля, опитайте отново.");
                });
            }

        </script>

</div>

    <footer>
        <p>&copy; 2023 Сайт за създаване на CV</p>
    </footer>
    <div id="successPopup" class="popup">
        <div class="popup-content">
            <p>Успешно записано CV!</p>
            <button onclick="closePopup('successPopup')">Затвори</button>
        </div>
    </div>
    <script>
        
        function showPopup(popupId) {
            var popup = document.getElementById(popupId);
            if (popup) {
                popup.style.display = 'block';
            }
        }

        
        function closePopup(popupId) {
            var popup = document.getElementById(popupId);
            if (popup) {
                popup.style.display = 'none';
            }
        }

        
        window.addEventListener('load', function () {
            var params = new URLSearchParams(window.location.search);
            var status = params.get('status');
            
            if (status === 'success') {
                showPopup('successPopup');
            }
        });
        window.addEventListener('load', function () {
    var params = new URLSearchParams(window.location.search);
    var status = params.get('status');
    
    if (status === 'success') {
        showPopup('successPopup');

        
        var newUrl = window.location.origin + window.location.pathname;
        history.replaceState({}, document.title, newUrl);
    }
});
    </script>
    <script>//бутон за справка
        document.getElementById('reportButton').addEventListener('click', function() {
         window.location.href = 'report.php';
        });
    </script>
</body>
</html>
<style>
    body {
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }
    h1{
    color: #333;
    display: block;
        margin: 0 auto;
        background-color: #4caf50;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    h2{
        display: inline-block;
    }
    h3 {
        color: #333;
    }
    #reportButton {
    display: inline-block;
    float: right; 
    margin-top: 20px;
    }
    


    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }


    header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px;
    }


    section {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #f5f5f5;
    }


    form {
        margin-top: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }
    input[type="date"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    button {
        background-color: #4caf50;
        color: white;
        padding: 10px 20px ;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button[type="submit"] {
        display: block;
        margin: 0 auto;
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }


    button.cancel {
        background-color: #ccc;
        margin-left: 10px;
    }

    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    .popup button {
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }


    footer {
        text-align: center;
        background-color: #333;
        color: #fff;
        padding: 10px;
    }
</style>
<script>//скрипт зареждане на умения
  // Функция за извличане и зареждане на уменията
  function loadSkills() {
    var select = document.getElementById("skills");
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "load_skills.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var skills = JSON.parse(xhr.responseText);

        // Добавяне на новите опции
        skills.forEach(function (skill) {
          var option = document.createElement("option");
          option.value = skill.id;
          option.text = skill.name;
          select.appendChild(option);
        });
      }
    };
    xhr.send();
  }

  // Извикване на функцията за зареждане на уменията при зареждането на страницата
  window.addEventListener("load", loadSkills);
</script>

<script>//Скрипт зареждане на университети
  // Функция за извличане и зареждане на университетите
  function loadUniversities() {
    var select = document.getElementById("university");
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "load_universities.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var universities = JSON.parse(xhr.responseText);

        

        // Добавяне на новите опции
        universities.forEach(function (university) {
          var option = document.createElement("option");
          option.value = university.id;
          option.text = university.name;
          select.appendChild(option);
        });
      }
    };
    xhr.send();
  }

  // Извикване на функцията за зареждане на университетите при зареждането на страницата
  window.addEventListener("load", loadUniversities);
</script>

