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
    <h1>Аналитика продаж</h1>
    <p>Период: {{ $startDate }} - {{ $endDate }}</p>

    <h2>Сумма продаж ИТОГО за период</h2>
    <p><strong>{{ number_format($salesAnalytics['totalSales'], 2) }} грн</strong></p>

    <h2>Топ 3 блюда по сумме продаж</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Название</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesAnalytics['topByRevenue'] as $index => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['dish_id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['total_price'], 2) }} грн</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Блюда-аутсайдеры по сумме продаж</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Название</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesAnalytics['outsidersByRevenue'] as $index => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['dish_id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['total_price'], 2) }} грн</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Топ 3 блюда по количеству</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Название</th>
                <th>Количество</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesAnalytics['topByQuantity'] as $index => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['dish_id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Блюда-аутсайдеры по количеству</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Название</th>
                <th>Количество</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesAnalytics['outsidersByQuantity'] as $index => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['dish_id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
