<!DOCTYPE html>
<html>
<head>
    <title>Aset SPBE Pemprov Bali</title>
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


@if ($id==1) @php $judul = 'KATEGORI Sistem Elektronik';@endphp
@elseif ($id==2) @php $judul = 'KLASIFIKASI Data/Informasi dalam Sistem Elektronik';@endphp
@else @php $judul = 'VITALITAS Sistem Elektronik';@endphp
@endif

        <h3 style="margin-bottom: 5px;">{{ $judul }}</h3>
        <h1 style="margin-top: 5px;margin-bottom: 5px;">Aset SPBE Pemprov Bali</h1>

    <p style="margin-top: 5px;font-size: 0.8em">Cetak Tgl. @formattedDateTime</p>



    <table style="font-size: 0.7em">
            <thead>
            <tr>
                <th>No</th>
                <th>SKOR</th>
                <th>
                    @if ($id==1) {{ 'KATEGORI' }}
                    @elseif ($id==2) {{ 'KLASIFIKASI' }}
                    @else {{ 'VITALITAS' }}
                    @endif
                </th>
                <th>LAYANAN SPBE</th>
                <th>JENIS ASET</th>
                <th>ASET SPBE</th>
                <th>PEMILIK ASET</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aset as $no=>$datak)
            <tr>
                <td align="right">{{ $no+1 }}</td>
                <td align="center">
                    @if ($id==1)
                        @if ($datak->jenis == 'APLIKASI')
                            {{ $datak->skorkategori }}
                        @endif
                    @else
                        @if ($datak->jenis == 'APLIKASI')
                            -
                        @endif
                    @endif
                </td>
                <td align="center">
                    @if ($id==2)
                        @if ($datak->jenis == 'APLIKASI')
                            @php
                            switch ($datak->klasifikasi) {
                                case 'RAHASIA':
                                    $buttonClass = 'btn-danger'; // Merah
                                    $na='R';
                                    break;
                                case 'TERBATAS/INTERNAL':
                                    $buttonClass = 'btn-warning'; // Kuning
                                    $na='T';
                                    break;
                                case 'PUBLIK':
                                    $buttonClass = 'btn-success'; // Hijau
                                    $na='P';
                                    break;
                                default:
                                    $buttonClass = 'btn-secondary'; // Kelas default jika kategori tidak dikenali
                                    break;
                            }
                            @endphp
                            {{ $datak->klasifikasi }}
                        @endif
                    @elseif ($id==1)
                        @if ($datak->jenis == 'APLIKASI')
                            @php
                            switch ($datak->kategorise) {
                                case 'STRATEGIS':
                                    $buttonClass = 'btn-danger'; // Merah
                                    $na='S';
                                    break;
                                case 'TINGGI':
                                    $buttonClass = 'btn-warning'; // Kuning
                                    $na='T';
                                    break;
                                case 'RENDAH':
                                    $buttonClass = 'btn-success'; // Biru
                                    $na='R';
                                    break;
                                default:
                                    $buttonClass = 'btn-secondary'; // Kelas default jika kategori tidak dikenali
                                    break;
                            }
                            @endphp
                            {{ $datak->kategorise }}
                            @endif
                    @else
                        @if ($datak->jenis == 'APLIKASI')
                            @php
                            switch ($datak->dampakvital) {
                                case 'SIGNIFIKAN':
                                        $buttonClass = 'btn-danger'; // Merah
                                        $na='R';
                                        break;
                                    case 'TERBATAS':
                                        $buttonClass = 'btn-warning'; // Kuning
                                        $na='T';
                                        break;
                                    case 'MINOR':
                                        $buttonClass = 'btn-success'; // Hijau
                                        $na='P';
                                        break;
                                default:
                                    $buttonClass = 'btn-secondary'; // Kelas default jika kategori tidak dikenali
                                    break;
                            }
                            @endphp
                            {{ $datak->dampakvital }}
                        @endif
                    @endif
                </td>
                <td>{{ $datak->layananRelation->jenis }}:<BR>{{ $datak->layananRelation->nama }}</td>
                <td>{{ $datak->jenis }}</td>
                <td>
                    @if ($datak->jenis == 'APLIKASI' || $datak->jenis == 'INFRASTRUKTUR')
                        {{ $datak->nama }}<br>
                        <i>URL: {{ $datak->url }} / IP: {{ $datak->ip }}</i>
                    @else
                        {{ $datak->nama }}
                    @endif
                </td>
                <td>{{ $datak->opdRelation->singkatan }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <BR>
            @if ($id==1)
        <h5 style="margin-top: 5px;">Skor Kategori :<br>
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
        @elseif ($id==3)
        <h5 style="margin-top: 5px;">Skor Vitalitas :<br>
            10 s/d 15 : RENDAH<BR>
            16 s/d 34 : TINGGI<BR>
            35 s/d 50 : STRATEGIS
        </h5>
        @else
        @endif



</body>

</html>
