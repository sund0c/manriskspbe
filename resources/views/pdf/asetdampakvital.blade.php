<!DOCTYPE html>
<html>
<head>
    <title>Vitalitas Sistem Elektronik</title>
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

        <h3 style="margin-bottom: 5px;">Vitalitas Sistem Elektronik</h3>
        <h1 style="margin-top: 5px;margin-bottom: 5px;">{{ $idaset->first()->nama }}</h1>
        <h6 style="margin-top: 5px;margin-bottom: 5px;">{{ $idaset->first()->keterangan }}</h6><hr>
        <h5>Layanan SPBE: {{ $idaset->first()->layananRelation->nama }} ({{ $idaset->first()->layananRelation->jenis }})<BR>
    <h5 style="margin-top: 5px;margin-bottom: 5px;">Jenis: {{ $idaset->first()->jenis }}<BR>
    Pemilik: {{ $idaset->first()->opdRelation->singkatan }}<BR>
    Vitalitas:
    @if($idaset->first()->dampakvital=='SERIUS') {{ '** Infrastruktur Informasi Vital (IIV) **' }}
    @else {{ 'Non Infrastruktur Informasi Vital (Non IIV)' }}
    @endif
    </h5>
    <p style="margin-top: 5px;font-size: 0.8em">Cetak Tgl. @formattedDateTime</p>


    @php
        $maxPerKategori = [];
    @endphp
    <table style="font-size: 0.8em">
            <thead>
            <tr>
                <th width="400px">Dampak OPERASIONAL</th>
                <th width="400px">Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $r=0;$y=0;$max = null;
            @endphp
            @foreach ($asetdampakvitals as $no=>$data)
            @if ($data->dampakvitalRelation->domain == 1)
            <tr>
                <td valign="top">{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                <td valign="top">
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->dampakvitalRelation->j1 }} :: [1]
                        @php $max = max($max, 1); @endphp
                        @break
                    @case(2)
                        {{ $data->dampakvitalRelation->j2 }} :: [2]
                        @php $max = max($max, 2); @endphp
                        @break
                    @case(3)
                        {{ $data->dampakvitalRelation->j3 }} :: [3]
                        @php $max = max($max, 3); @endphp
                        @php $y++; @endphp
                        @break
                    @case(4)
                        {{ $data->dampakvitalRelation->j4 }} :: [4]
                        @php $max = max($max, 4); @endphp
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
                <td align="right"><strong>Skor per Kategori Dampak OPERASIONAL</strong></td>
                <td align="left">
                    <strong> {{ $max }} </strong>
                    @php $maxPerKategori['kategori1'][] = $max; @endphp
                    @if ($max==4) <strong>(SERIUS)</strong>
                    @elseif ($max==3) <strong>(SIGNIFIKAN)</strong>
                    @elseif ($max==2) <strong>(TERBATAS)</strong>
                    @else <strong>(MINOR)</strong>
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
                    <th width="400px">Dampak DATA dan/atau INFORMASI</th>
                    <th width="400px">Jawaban</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $r=0;$y=0;$max = null;
                @endphp
                @foreach ($asetdampakvitals as $no=>$data)
                @if ($data->dampakvitalRelation->domain == 2)
                <tr>
                    <td valign="top">{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                    <td valign="top">
                        @switch($data->jawab)
                        @case(1)
                        {{ $data->dampakvitalRelation->j1 }} :: [1]
                        @php $max = max($max, 1); @endphp
                        @break
                        @case(2)
                            {{ $data->dampakvitalRelation->j2 }} :: [2]
                            @php $max = max($max, 2); @endphp
                            @break
                        @case(3)
                            {{ $data->dampakvitalRelation->j3 }} :: [3]
                            @php $max = max($max, 3); @endphp
                            @php $y++; @endphp
                            @break
                        @case(4)
                            {{ $data->dampakvitalRelation->j4 }} :: [4]
                            @php $max = max($max, 4); @endphp
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
                    <td align="right"><strong>Skor per Kategori Dampak DATA dan/atau INFORMASI</strong></td>
                    <td align="left">
                        <strong> {{ $max }} </strong>
                        @php $maxPerKategori['kategori2'][] = $max; @endphp
                        @if ($max==4) <strong>(SERIUS)</strong>
                        @elseif ($max==3) <strong>(SIGNIFIKAN)</strong>
                        @elseif ($max==2) <strong>(TERBATAS)</strong>
                        @else <strong>(MINOR)</strong>
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
                        <th width="400px">Dampak FINANSIAL</th>
                        <th width="400px">Jawaban</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $r=0;$y=0;$max = null;
                    @endphp
                    @foreach ($asetdampakvitals as $no=>$data)
                    @if ($data->dampakvitalRelation->domain == 3)
                    <tr>
                        <td valign="top">{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                        <td valign="top">
                            @switch($data->jawab)
                            @case(1)
                            {{ $data->dampakvitalRelation->j1 }} :: [1]
                            @php $max = max($max, 1); @endphp
                            @break
                        @case(2)
                            {{ $data->dampakvitalRelation->j2 }} :: [2]
                            @php $max = max($max, 2); @endphp
                            @break
                        @case(3)
                            {{ $data->dampakvitalRelation->j3 }} :: [3]
                            @php $max = max($max, 3); @endphp
                            @php $y++; @endphp
                            @break
                        @case(4)
                            {{ $data->dampakvitalRelation->j4 }} :: [4]
                            @php $max = max($max, 4); @endphp
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
                        <td align="right"><strong>Skor per Kategori Dampak FINANSIAL</strong></td>
                        <td align="left">
                            <strong> {{ $max }} </strong>
                            @php $maxPerKategori['kategori3'][] = $max; @endphp
                            @if ($max==4) <strong>(SERIUS)</strong>
                            @elseif ($max==3) <strong>(SIGNIFIKAN)</strong>
                            @elseif ($max==2) <strong>(TERBATAS)</strong>
                            @else <strong>(MINOR)</strong>
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
                        <th width="400px">Dampak UMUM</th>
                        <th width="400px">Jawaban</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $r=0;$y=0;$max = null;
                    @endphp
                    @foreach ($asetdampakvitals as $no=>$data)
                    @if ($data->dampakvitalRelation->domain == 4)
                    <tr>
                        <td valign="top">{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                        <td valign="top">
                            @switch($data->jawab)
                            @case(1)
                            {{ $data->dampakvitalRelation->j1 }} :: [1]
                            @php $max = max($max, 1); @endphp
                            @break
                        @case(2)
                            {{ $data->dampakvitalRelation->j2 }} :: [2]
                            @php $max = max($max, 2); @endphp
                            @break
                        @case(3)
                            {{ $data->dampakvitalRelation->j3 }} :: [3]
                            @php $max = max($max, 3); @endphp
                            @php $y++; @endphp
                            @break
                        @case(4)
                            {{ $data->dampakvitalRelation->j4 }} :: [4]
                            @php $max = max($max, 4); @endphp
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
                        <td align="right"><strong>Skor per Kategori Dampak UMUM</strong></td>
                        <td align="left">
                            <strong> {{ $max }} </strong>
                            @php $maxPerKategori['kategori4'][] = $max; @endphp
                            @if ($max==4) <strong>(SERIUS)</strong>
                            @elseif ($max==3) <strong>(SIGNIFIKAN)</strong>
                            @elseif ($max==2) <strong>(TERBATAS)</strong>
                            @else <strong>(MINOR)</strong>
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
                        <th width="400px">Dampak KETERGANTUNGAN</th>
                        <th width="400px">Jawaban</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $r=0;$y=0;$max = null;
                    @endphp
                    @foreach ($asetdampakvitals as $no=>$data)
                    @if ($data->dampakvitalRelation->domain == 5)
                    <tr>
                        <td valign="top">{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                        <td valign="top">
                            @switch($data->jawab)
                            @case(1)
                            {{ $data->dampakvitalRelation->j1 }} :: [1]
                            @php $max = max($max, 1); @endphp
                            @break
                        @case(2)
                            {{ $data->dampakvitalRelation->j2 }} :: [2]
                            @php $max = max($max, 2); @endphp
                            @break
                        @case(3)
                            {{ $data->dampakvitalRelation->j3 }} :: [3]
                            @php $max = max($max, 3); @endphp
                            @php $y++; @endphp
                            @break
                        @case(4)
                            {{ $data->dampakvitalRelation->j4 }} :: [4]
                            @php $max = max($max, 4); @endphp
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
                        <td align="right"><strong>Skor per Kategori Dampak KETERGANTUNGAN</strong></td>
                        <td align="left">
                            <strong> {{ $max }} </strong>
                            @php $maxPerKategori['kategori5'][] = $max; @endphp
                            @if ($max==4) <strong>(SERIUS)</strong>
                            @elseif ($max==3) <strong>(SIGNIFIKAN)</strong>
                            @elseif ($max==2) <strong>(TERBATAS)</strong>
                            @else <strong>(MINOR)</strong>
                            @endif
                        </td>
                        <td align="center"></td>
                    </tr>
                </tfoot>
                </table>
                @php
                    $maxValues = [];
                    foreach ($maxPerKategori as $kategori => $values) {
                        $maxValues[$kategori] = max($values);
                    }
                    $overallMax = max($maxValues);     @endphp
                    @if ($overallMax==4) @php $k="** Infrastruktur Informasi Vital (IIV) **";@endphp
                    @else @php $k="Non IIV";@endphp
                    @endif

                <BR>
            <p style="font-size: 0.8em"><strong>HASIL</strong><br>
            <strong>Skor Potensi Dampak Keseluruhan : {{ $overallMax }}</strong>
                @if ($overallMax==4) <strong>(SERIUS)</strong>
                @elseif ($overallMax==3) <strong>(SIGNIFIKAN)</strong>
                @elseif ($overallMax==2) <strong>(TERBATAS)</strong>
                @else <strong>(MINOR)</strong><BR>
                @endif
            <strong>Kesimpulan :  {{ $k }}</strong>
        </h5>

        <footer>

        </footer>

</body>

</html>
