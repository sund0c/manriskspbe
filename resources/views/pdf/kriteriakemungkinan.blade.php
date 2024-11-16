<!DOCTYPE html>
<html>
<head>
    <title>Kriteria Kemungkinan Risiko (Likelihood) Keamanan SPBE Pemprov Bali</title>
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
        <h1 style="margin-top: 5px;margin-bottom: 5px;">Kriteria Kemungkinan Risiko Keamanan SPBE <i>(Likelihood)</i></h1>

    <p style="margin-top: 5px;font-size: 0.8em">Cetak Tgl. @formattedDateTime</p>



    <table style="font-size: 0.7em">
            <thead>
            <tr>
                <th>RARE</th>
                <th>UNLIKELY</th>
                <th>POSSIBLE</th><th>LIKELY</th><th>ALMOST CERTAIN</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($kriteriakemungkinan as $no=>$data)
            <tr>
                <td>{!! $data->rare !!}</td>
                <td>{!! $data->unlikely !!}</td>
                <td>{!! $data->possible !!}</td>
                <td>{!! $data->likely !!}</td>
                <td>{!! $data->almost !!}</td>
            </tr>
            @endforeach
        </tbody>
        </table>

</body>

</html>
