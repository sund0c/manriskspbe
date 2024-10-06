<!DOCTYPE html>
<html>
<head>
    <title>Klasifikasi Sistem Elektronik</title>
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

        <h3 style="margin-bottom: 5px;">Klasifikasi Informasi dalam Sistem Elektronik</h3>
        <h1 style="margin-top: 5px;margin-bottom: 5px;">{{ $idaset->first()->nama }}</h1>
    <h5 style="margin-top: 5px;margin-bottom: 5px;">Jenis: {{ $idaset->first()->jenis }}<BR>
    Pemilik: {{ $idaset->first()->opdRelation->singkatan }}<BR>
    Klasifikasi: {{ $idaset->first()->klasifikasi }}</h5>
    <p style="margin-top: 5px;font-size: 0.8em">Cetak Tgl. @formattedDateTime</p>



    <table style="font-size: 0.8em">
            <thead>
            <tr>
                <th>Aspek : CONFIDENTIALITY</th>
                <th width="200px">Jawaban</th>
                <th width="300px">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $r=0;$y=0;
            @endphp
            @foreach ($asetklasifikasis as $no=>$data)
            @if ($data->klasifikasiRelation->domain == 1)
            <tr>
                <td>{{ $data->klasifikasiRelation->urut}}. {{ $data->klasifikasiRelation->tanya}}</td>
                <td align="center">
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->klasifikasiRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->klasifikasiRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->klasifikasiRelation->j3 }}
                        @php $y++; @endphp
                        @break
                    @case(4)
                        {{ $data->klasifikasiRelation->j4 }}
                        @php $r++; @endphp
                    @break
                    @default
                        <p>Data tidak tersedia</p>
                @endswitch
                </td>
                <td>{{ $data->keterangan }}</td>
            </tr>
            @endif
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td align="right"><strong>CONFIDENTIALITY Rating</strong></td>
                <td align="center">
                    @if ($r>0) <strong>TINGGI</strong>
                    @elseif ($y>0 && $r<=0) <strong>SEDANG</strong>
                    @else <strong>RENDAH</strong>
                    @endif
                </td>
                <td align="center"></td>
            </tr>
        </tfoot>
        </table>

            <div style="page-break-after: always;"></div>

            <table style="font-size: 0.8em">
                <thead>
                <tr>
                    <th>Aspek : INTEGRITY</th>
                    <th width="200px">Jawaban</th>
                    <th width="300px">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $r=0;$y=0;
                @endphp
                @foreach ($asetklasifikasis as $no=>$data)
                @if ($data->klasifikasiRelation->domain == 2)
                <tr>
                    <td>{{ $data->klasifikasiRelation->urut}}. {{ $data->klasifikasiRelation->tanya}}</td>
                    <td align="center">
                        @switch($data->jawab)
                        @case(1)
                        {{ $data->klasifikasiRelation->j1 }}
                        @break
                        @case(2)
                            {{ $data->klasifikasiRelation->j2 }}
                            @break
                        @case(3)
                            {{ $data->klasifikasiRelation->j3 }}
                            @php $y++; @endphp
                            @break
                        @case(4)
                            {{ $data->klasifikasiRelation->j4 }}
                            @php $r++; @endphp
                        @break
                        @default
                            <p>Data tidak tersedia</p>
                    @endswitch
                    </td>
                    <td>{{ $data->keterangan }}</td>
                </tr>
                @endif
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td align="right"><strong>INTEGRITY Rating</strong></td>
                    <td align="center">
                        @if ($r>0) <strong>TINGGI</strong>
                        @elseif ($y>0 && $r<=0) <strong>SEDANG</strong>
                        @else <strong>RENDAH</strong>
                        @endif


                    </td>
                    <td align="center"></td>
                </tr>
            </tfoot>
            </table>

        <div style="page-break-after: always;"></div>
                <table style="font-size: 0.8em">
                    <thead>
                    <tr>
                        <th>Aspek : AVAILABILITY</th>
                        <th width="200px">Jawaban</th>
                        <th width="300px">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $r=0;$y=0;
                    @endphp
                    @foreach ($asetklasifikasis as $no=>$data)
                    @if ($data->klasifikasiRelation->domain == 3)
                    <tr>
                        <td>{{ $data->klasifikasiRelation->urut}}. {{ $data->klasifikasiRelation->tanya}}</td>
                        <td align="center">
                            @switch($data->jawab)
                            @case(1)
                            {{ $data->klasifikasiRelation->j1 }}
                            @break
                        @case(2)
                            {{ $data->klasifikasiRelation->j2 }}
                            @break
                        @case(3)
                            {{ $data->klasifikasiRelation->j3 }}
                            @php $y++; @endphp
                            @break
                        @case(4)
                            {{ $data->klasifikasiRelation->j4 }}
                            @php $r++; @endphp
                        @break
                            @default
                                <p>Data tidak tersedia</p>
                        @endswitch
                        </td>
                        <td>{{ $data->keterangan }}</td>
                    </tr>
                    @endif
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td align="right"><strong>AVAILABILITY Rating</strong></td>
                        <td align="center">
                            @if ($r>0) <strong>TINGGI</strong>
                            @elseif ($y>0 && $r<=0) <strong>SEDANG</strong>
                            @else <strong>RENDAH</strong>
                            @endif


                        </td>
                        <td align="center"></td>
                    </tr>
                </tfoot>
                </table>
                <BR>
            <p style="font-size: 0.8em"><strong>Klasifikasi Informasi di dalam Sistem Elektronik:</strong><br>
            <strong>RAHASIA :</strong> salah satu aspek bernilai Tinggi<BR>
            <strong>TERBATAS :</strong> salah satu aspek bernilai Sedang dan tidak ada yang bernilai Tinggi. Lingkup unit kerja/orang tertentu dalam Organisasi.<BR>
            <strong>INTERNAL :</strong> salah satu aspek bernilai Sedang dan tidak ada yang bernilai Tinggi. Lingkup Organisasi.<BR>
            <strong>PUBLIK :</strong> semua aspek bernilai Rendah
        </h5>

        <footer>

        </footer>

</body>

</html>
