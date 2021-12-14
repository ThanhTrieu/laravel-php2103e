<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thong tin sinh vien</title>
</head>
<body>
    <h1>Thong tin sinh vien</h1>
    <table width="80%" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>MSV</th>
                <th>HT</th>
                <th>Email</th>
                <th>Nam sinh</th>
                <th>Que quan</th>
                <th>Hoc bong</th>
            </tr>
        </thead>
        <tbody>
            {{-- <//?php foreach (): ?>
            <//?php endforeach; ?> --}}
            {{-- comment trong template blade --}}
            @php
                // khai bao bien php ngoai template blade
                $totalMoney = 0;
            @endphp
            @foreach ($infoStudents as $item)
                @php
                    $totalMoney += $item['money'];
                @endphp
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['birthday'] }}</td>
                    <td>{{ $item['address'] }}</td>
                    <td>{{ number_format($item['money']) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Tong tien</td>
                <td> {{ number_format($totalMoney) }} </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>