<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аналитика продаж</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            margin-top: 20px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Отчет по аналитике продаж</h1>
        </div>
        <div class="content">
            <p>Здравствуйте, {{ $name }}!</p>
            <p>Мы рады предоставить вам отчет по аналитике продаж за следующий период:</p>
            <ul>
                <li><strong>Дата начала:</strong> {{ $startDate }}</li>
                <li><strong>Дата окончания:</strong> {{ $endDate }}</li>
            </ul>
            <p>Подробный отчет доступен в прикрепленном файле.</p>
        </div>
        <div class="footer">
            <p>Спасибо, что пользуетесь нашим сервисом!</p>
            <p>&copy; {{ date('Y') }} Ваша компания</p>
        </div>
    </div>
</body>

</html>
