<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @php
        $devideSheet = explode('|', $excelFileData);
        array_shift($devideSheet);
    @endphp
    @foreach ($devideSheet as $item)
        @php
            $sheetName = explode('//', $item);
            $sheetData = explode(',', $sheetName[1]);
            $sheetData = array_chunk($sheetData, 5);
            // dd($sheetData);
        @endphp
        <b>{{ rtrim($sheetName[0], ',') }}</b>
        <table>
            @foreach ($sheetData as $key => $item1)
                @if ($key == 0)
                    <tr>
                        <th>{{ $item1[0] }}</th>
                        <th>{{ $item1[1] }}</th>
                        <th>{{ $item1[2] }}</th>
                        <th>{{ $item1[3] }}</th>
                        <th>{{ $item1[4] }}</th>
                    </tr>
                @else
                    <tr>
                        @foreach ($item1 as $itemData)
                            <td>{{ $itemData }}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </table>
    @endforeach
</body>

</html>
