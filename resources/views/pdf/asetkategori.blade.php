<!DOCTYPE html>
<html>
<head>
    <title>Kategori Sistem Elektronik</title>
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
</style>

        <h3 style="margin-bottom: 5px;">Kategori Sistem Elektronik</h3>
        <h1 style="margin-top: 5px;margin-bottom: 5px;">{{ $idaset->first()->nama }}</h1>
    <h5 style="margin-top: 5px;margin-bottom: 5px;">Jenis: {{ $idaset->first()->jenis }}<BR>
    Pemilik: {{ $idaset->first()->userRelation->opdRelation->singkatan }}<BR>
    Kategori: {{ $idaset->first()->kategorise }}</h5>
    <p style="margin-top: 5px;font-size: 0.8em">Cetak Tgl. @formattedDateTime</p>



    <table style="font-size: 0.8em">
            <thead>
            <tr>
                <th>Kriteria</th>
                <th width="200px">Jawaban</th>
                <th width="200px">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetkategoris as $no=>$data)
            <tr>
                <td>{{ $data->kategoriseRelation->urut}}. {{ $data->kategoriseRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(5)
                        {{ $data->kategoriseRelation->j1 }} ::[5]
                        @break
                    @case(3)
                        {{ $data->kategoriseRelation->j2 }} ::[3]
                        @break
                    @case(1)
                        {{ $data->kategoriseRelation->j3 }} ::[1]
                        @break
                    @default
                        <p>Data tidak tersedia</p>
                @endswitch
                </td>
                <td>{{ $data->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td><strong>SKOR</strong></td>
                <td align="center"><strong>{{ $sumJawab }}</strong></td>
                <td align="center"></td>
            </tr>
        </tfoot>
        </table>
        <BR>
        <h5 style="margin-top: 5px;">Perhitungan Kategori :<br>
            10 s/d 15 : RENDAH<BR>
            16 s/d 34 : TINGGI<BR>
            35 s/d 50 : STRATEGIS
        </h5>
        <p style="font-size: 0.8em">
            <strong>DEFINISI & STANDARD per Kategori</strong>
            <ul style="font-size: 0.8em"><li><strong>STRATEGIS :</strong> SE yang beresiko terhadap penyelenggaraan negara dan pertahanan keamanan negara. Wajib menerapkan SNI ISO/IEC 27001 <strong>DAN</strong> standar keamanan lain yang terkait dengan keamanan siber yang ditetapkan oleh BSSN <strong>DAN</strong> standar keamanan lain yang terkait dengan keamanan siber yang ditetapkan oleh Kementerian atau Lembaga.
            </li><li><strong>TINGGI :</strong> SE yang beresiko terhadap penyelenggaraan layanan publik dengan skala terbatas (Provinsi, Kabupaten, Kota). Wajib menerapkan SNI ISO/IEC 27001 <strong>DAN/ATAU</strong> standar keamanan lain yang terkait dengan keamanan siber yang ditetapkan oleh BSSN <strong>DAN</strong> standar keamanan lain yang terkait dengan keamanan siber yang ditetapkan oleh Kementerian atau Lembaga.
            </li><li><strong>RENDAH :</strong> SE yang beresiko terhadap operasional layanan yang bersifat sementara dan hanya mengganggu sebagai kecil pengguna layanan. Wajib menerapkan SNI ISO/IEC 27001 <strong>ATAU</strong> standar keamanan lain yang terkait dengan keamanan siber yang ditetapkan oleh BSSN.
            </li></ul>
        </p>

        <footer>

        </footer>

</body>

</html>
