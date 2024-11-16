<!DOCTYPE html>
<html>
<head>
    <title>Kriteria Dampak Risiko (Impact) Keamanan SPBE Pemprov Bali</title>
</head>
<body>
    <style>
        table {
    border: 1px solid black;
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid black; /* Garis tipis di semua cell */
    padding: 8px; /* Memberikan sedikit ruang dalam cell */
}
.footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: grey;
        }
</style>

        <h3 style="margin-bottom: 5px;">Pemerintah Provinsi Bali</h3>
        <h1 style="margin-top: 5px;margin-bottom: 5px;">Kriteria Dampak Risiko Keamanan SPBE <i>(Impact)</i></h1>

    <p style="margin-top: 5px;font-size: 0.8em">Cetak Tgl. @formattedDateTime</p>



    <table style="font-size: 0.7em">
            <thead>
            <tr>
            <th>AREA</th>
                <th>INSIGNIFICANT</th>
                <th>LOW</th><th>MEDIUM</th><th>HIGH</th><th>CRITICAL</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($areadampak as $no=>$data)
            <tr>
                <td>{{ $data->area }}<br><i>{{ $data->keterangan}}</i></td>
                <td>{!! $data->insignificant !!}</td>
                <td>{!! $data->low !!}</td>
                <td>{!! $data->medium !!}</td>
                <td>{!! $data->high !!}</td>
                <td>{!! $data->critical !!}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

</body>

</html>
