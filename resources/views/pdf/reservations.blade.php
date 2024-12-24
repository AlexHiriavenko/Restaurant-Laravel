<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.5;
        }

        h1,
        h2,
        p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Аналитика бронирований</h1>
    <p>Период: {{ $startDate }} - {{ $endDate }}</p>

    <h2>Количество бронирований по дням недели</h2>
    <table>
        <thead>
            <tr>
                <th>День недели</th>
                <th>Количество</th>
                <th>Процент</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fullAnalytics['byWeekday'] as $weekday => $data)
                <tr>
                    <td>{{ $weekday }}</td>
                    <td>{{ $data['count'] }}</td>
                    <td>{{ $data['percentage'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Количество бронирований по времени</h2>
    <table>
        <thead>
            <tr>
                <th>Время Бронирования</th>
                <th>Количество</th>
                <th>Процент</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fullAnalytics['byStartTime'] as $startTime => $data)
                <tr>
                    <td>{{ $startTime }}</td>
                    <td>{{ $data['count'] }}</td>
                    <td>{{ $data['percentage'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
