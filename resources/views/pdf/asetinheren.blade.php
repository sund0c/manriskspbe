<!DOCTYPE html>
<html>
<head>
    <title>Inherent Risk</title>
</head>
<body>
    <style>
        table {
    border: 1px solid black;
    border-collapse: collapse;
    width: 100%;
}

ul {
    margin-left: 10px;  /* Mengatur jarak margin dari tepi kiri */
    padding-left: 10px; /* Mengatur jarak padding dari tepi kiri */
}
    
th, td {
    border: 1px solid black; /* Garis tipis di semua cell */
    padding: 8px; /* Memberikan sedikit ruang dalam cell */
}



</style>

        <h3 style="margin-bottom: 5px;">Risiko Inheren (Tanpa Penerapan Kontrol)</h3>
        <h1 style="margin-top: 5px;margin-bottom: 5px;">{{ $idaset->first()->nama }}</h1>
        <h6 style="margin-top: 5px;margin-bottom: 5px;">{{ $idaset->first()->keterangan }}</h6><hr>
        <h5>Layanan SPBE: {{ $idaset->first()->layananRelation->nama }} ({{ $idaset->first()->layananRelation->jenis }})<BR>
    <h5 style="margin-top: 5px;margin-bottom: 5px;">Jenis: {{ $idaset->first()->jenis }}<BR>
    Pemilik: {{ $idaset->first()->opdRelation->singkatan }}
    </h5>
    <p style="margin-top: 5px;font-size: 0.8em">Cetak Tgl. @formattedDateTime</p>


    <table style="font-size: 0.9em">
            <thead>
            <tr>
                <th>KERENTANAN</th>
                <th width="200px">LIKELIHOOD</th> 
                <th width="400px">IMPACT</th> 
                <th width="100px">RISK</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($asetinherens as $no=>$data)           
            <tr>
                <td>{{ $data->inherentRelation->kerawanan }}</td>
                {{-- <td>{{ $data->ancaman }}</td> --}}
                <td>
                    @php $kem='';$nkem='';@endphp
                    @switch($data->nilaikemungkinan)
                        @case(5)
                            @php $kem='ALMOST CERTAIN';$nkem=$kriteriakemungkinan->first()->almost;@endphp
                            @break
                        @case(4)
                            @php $kem='LIKELY';$nkem=$kriteriakemungkinan->first()->likely;@endphp
                            @break
                        @case(3)
                            @php $kem='POSSIBLE';$nkem=$kriteriakemungkinan->first()->possible;@endphp
                            @break
                        @case(2)
                            @php $kem='UNLIKELY';$nkem=$kriteriakemungkinan->first()->unlikely;@endphp
                            @break
                        @case(1)
                            @php $kem='RARE';$nkem=$kriteriakemungkinan->first()->rare;@endphp
                            @break
                        @default
                            <p>Data tidak tersedia</p>
                    @endswitch
                    {{ $kem }}<BR><ul><li>
                    ( {!! $nkem !!} )</li></ul>
                   
                </td>
                <td>@php $dam='';@endphp
                    @switch($data->nilaidampak)
                        @case(5)
                            @php $dam='CRITICAL'; @endphp
                            @break
                        @case(4)
                            @php $dam='HIGH'; @endphp
                            @break
                        @case(3)
                            @php $dam='MEDIUM'; @endphp
                            @break
                        @case(2)
                            @php $dam='LOW'; @endphp
                            @break
                        @case(1)
                            @php $dam='INSIGNIFICANT'; @endphp
                            @break
                        @default
                            <p>Data tidak tersedia</p>
                    @endswitch
                    {{ $dam }}<BR>
                    @php
                    $inherenImpacts = \App\Models\InherenImpact::where('inheren', $data->inheren) 
                    ->with('impactRelation') 
                    ->get();
                    //dd($inherenImpacts);
                    
                @endphp <ul>
                @foreach ($inherenImpacts as $impact)
                @switch($impact->nilaiimpact)
                @case(5)
                    @php $imp='critical'; @endphp
                    @break
                @case(4)
                @php $imp='high'; @endphp
                    @break
                @case(3)
                @php $imp='medium'; @endphp
                    @break
                @case(2)
                @php $imp='low'; @endphp
                    @break
                @case(1)
                @php $imp='insignificant'; @endphp
                    @break
                @default
                    <p>Data tidak tersedia</p>
            @endswitch
                    <li>{{ $impact->impactRelation->area }} : {!! $impact->impactRelation->$imp !!}</li>
                @endforeach </ul>
                </td>
                <td>
                    @php
                    $d = $data->nilaidampak; 
                    $k = $data->nilaikemungkinan;
                    $r = 0;
                
                    if ($d == 1) {
                        $r = 2;
                    } elseif ($d == 2 && $k <= 3) {
                        $r = 2;
                    } elseif ($d == 2 && $k > 3) {
                        $r = 3;
                    } elseif ($d == 3 && $k <= 2) {
                        $r = 3;
                    } elseif ($d == 3 && $k >= 3) {
                        $r = 4;
                    } elseif ($d == 4 && $k <= 3) {
                        $r = 4;
                    } elseif ($d == 4 && $k > 4) {
                        $r = 5;
                    } elseif ($d == 5 && $k <= 2) {
                        $r = 4;
                    } elseif ($d == 5 && $k >= 3) {
                        $r = 5;
                    }
                @endphp
                @php
                $klas = '';  // Definisikan variabel sebelum @switch
                $kep = '';
                $ris = '';
            @endphp
            
            @switch($r)
                @case(5)
                    @php
                        $ris = 'CRITICAL';
                        $kep = 'MITIGATE';
                        $klas = 'btn-mitigater';
                    @endphp
                    @break
                @case(4)
                    @php
                        $ris = 'HIGH';
                        $kep = 'MITIGATE';
                        $klas = 'btn-mitigateo';
                    @endphp
                    @break
                @case(3)
                    @php
                        $ris = 'MEDIUM';
                        $kep = 'MITIGATE';
                        $klas = 'btn-mitigatey';
                    @endphp
                    @break
                @case(2)
                    @php
                        $ris = 'LOW';
                        $kep = 'ACCEPTED';
                        $klas = 'btn-accepted';
                    @endphp
                    @break
                @case(1)
                    @php
                        $ris = 'INSIGNIFICANT';
                        $kep = 'ACCEPTED';
                        $klas = 'btn-accepted';
                    @endphp
                    @break
                @default
                    <p>Data tidak tersedia</p>
            @endswitch
                    {{ $ris }}
                </td>
            </tr>
            @endforeach
        </tbody>
       
                </table>
              

</body>

</html>
