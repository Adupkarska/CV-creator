<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Генериране на справка</title>
    <!-- Включете необходимите библиотеки за date picker, например, jQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

    <h2>Генериране на справка</h2>

    <form id="report-form">
        <label for="startDate">Начална дата:</label>
        <input type="text" id="startDate" name="startDate" required>

        <label for="endDate">Крайна дата:</label>
        <input type="text" id="endDate" name="endDate" required>
        <button type="button" id="generateButton">Генерирай справка</button>
    </form>
    
</div>

    <table id="report-table">
        <!-- Тук ще бъдат показани данните от справката -->
    </table>

<script>
    $(document).ready(function() {
        // Използвайте date picker за въвеждане на дати
        $("#startDate").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#endDate").datepicker({ dateFormat: 'yy-mm-dd' });

        // Функция за генериране на справка
        function generateReport() {
            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();

            var formattedStartDate = formatDateForServer(startDate);
    var formattedEndDate = formatDateForServer(endDate);

            // Изпратете AJAX заявка към сървъра с начална и крайна дата
            $.ajax({
                type: "POST",
                url: "generate_report.php",
                data: { startDate: startDate, endDate: endDate },
                dataType: "json",
                success: function(data) {
                    // Покажете данните в таблицата
                    displayReport(data);
                },
                error: function(error) {
                    console.error("Грешка при генериране на справка:", error);
                    console.log(xhr.responseText);
                }
            });
        }
        function formatDateForServer(dateString) {
    var parts = dateString.split("/");
    return parts[2] + "-" + parts[0] + "-" + parts[1];
}

        // Функция за показване на данните в таблицата
        function displayReport(data) {
            var table = $("#report-table");
            table.empty();

            // Добавете заглавие на таблицата
            var header = $("<tr>");
            header.append("<th>Име</th>");
            header.append("<th>Фамилия</th>");
            header.append("<th>Дата на раждане</th>");
            header.append("<th>Университет</th>");
            header.append("<th>Умения</th>");
            table.append(header);

            // Добавете данните за всеки кандидат в таблицата
            data.forEach(function(candidate) {
                var row = $("<tr>");
                row.append("<td>" + candidate.first_name + "</td>");
                row.append("<td>" + candidate.last_name + "</td>");
                row.append("<td>" + candidate.birthday + "</td>");
                row.append("<td>" + candidate.university + "</td>");
                row.append("<td>" + candidate.skills + "</td>");
                table.append(row);
            });
        }

        // Прикачете функцията generateReport към бутона
        $("#generateButton").click(generateReport);
    });
    $("#goBackButton").click(function() {
        window.history.back(); // Това ще ви върне на предишната страница
    });
   

</script>

<style>
    body {
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #333;
        display: block;
        margin: 0 auto;
        background-color: #4caf50;
        border: none;
        border-radius: 5px;
        padding: 10px;
        text-align: center;
        color: #fff;
    }

    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    button {
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin: 0 auto;
    }
    

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #4caf50;
        color: white;
    }
</style>
</body>
</html>
