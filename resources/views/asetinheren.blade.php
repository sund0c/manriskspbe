<x-layout>
    <style>
        /* .confidentiality-table th, .confidentiality-table td {
            width: 700px;
        }
        .confidentiality-table th:nth-child(2), .confidentiality-table td:nth-child(2) {
            width: 500px; /* Define width for the second column */
        } */

        /* .confidentiality-table th:nth-child(4), .confidentiality-table td:nth-child(4) {
            width: 100px; /* Define width for the fourth column */
        } */
    hr {
        border: 0.3px solid;
    }
    .kecil {
        font-size: 0.8px;
        padding-left: 20px;

    }
    .custom-btn {
            min-width: 160px; /* Lebar minimum yang diinginkan */
    }
    
  
    .table-bordered thead td, .table-bordered thead th  {
        vertical-align: middle !important;
        border-bottom: none !important;
        border-top: none !important;
        text-align: center;  
    } 
        
    th, td { padding: 10px; }

    .btn-mitigater { background-color: #8B0000; color: white; transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out; } 
    .btn-mitigater:hover { background-color: #A52A2A; color: white;} 
    .btn-mitigateo { background-color: #FF4500; color: white; transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out; } 
    .btn-mitigateo:hover { background-color: #FF6347; color: white;} 
    .btn-mitigatey { background-color: #FFD700; color: black; transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out; } 
    .btn-mitigatey:hover { background-color: #FFEA00; /* Warna yang sedikit lebih terang untuk efek hover */ } 
    .btn-accepted { background-color: #008000; color: white; transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out; } 
    .btn-accepted:hover { background-color: #32CD32; color: white; }
    
    </style>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('asetr.tampil') }}">Aset</a></li>
        <li class="breadcrumb-item active">Risiko Inheren</li>
    </x-slot>
   
    <x-slot name="title">{{ $idaset->first()->nama }}
        <ul style="list-style-type: none; padding: 0; margin: 0; font-size: 0.5em;">
            <li>Jenis Aset: {{ $idaset->first()->jenis }}</li>
            <li>LAYANAN SPBE: {{ $idaset->first()->layananRelation->nama }} ({{ $idaset->first()->layananRelation->jenis }})</li>
            <li>Pemilik Aset: {{ $idaset->first()->opdRelation->singkatan }}</li>
        </ul>

    </x-slot>
    <x-slot name="card_title">
        <a href="{{ route('asetinheren.pdf', $asetinherens->first()->aset) }}" class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF Inherent Risk</a>
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th rowspan="2">Vulnerability</th> 
                <th colspan="3">INHERENT (Risiko Tanpa Adanya Kontrol Apapun)</th> 
                <th rowspan="2" width="150px">CURRENT RISK</th> 
            </tr> 
            <tr> 
                <th width="150px">Likelihood</th> 
                <th width="150px">Impact</th> 
                <th width="150px">Risk</th> 
            </tr> 
          </thead>
        <tbody>
            @foreach ($asetinherens as $no=>$data)           
            <tr>
                <td>{{ $data->kerawanan }}</td>
                {{-- <td>{{ $data->ancaman }}</td> --}}
                <td>
                    @php $kem='';@endphp
                    @switch($data->nilaikemungkinan)
                        @case(5)
                            @php $kem='ALMOST CERTAIN';@endphp
                            @break
                        @case(4)
                            @php $kem='LIKELY';@endphp
                            @break
                        @case(3)
                            @php $kem='POSSIBLE';@endphp
                            @break
                        @case(2)
                            @php $kem='UNLIKELY';@endphp
                            @break
                        @case(1)
                            @php $kem='RARE';@endphp
                            @break
                        @default
                            <p>Data tidak tersedia</p>
                    @endswitch
                    <a href="#" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}" class="btn btn-sm custom-btn btn-light fixed-size-button" title="Nilai Kemungkinan">{{ $kem }}</a>
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
                    <a href="#" data-toggle="modal" data-target="#modalFormImpact-{{ $data->id }}" class="btn btn-sm custom-btn btn-light fixed-size-button" title="Nilai Dampak">{{ $dam }}</a>
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
                    <a href="#" class="btn btn-sm custom-btn <?php echo $klas; ?> fixed-size-button" title="Nilai Risiko">{{ $ris }}</a>
                </td>
                <td>
                     <a href="#" class="btn btn-sm custom-btn <?php echo $klas; ?> fixed-size-button" title="Keputusan">{{ $kep }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>


<!-- Modal Edit Likelihood-->

@foreach ($asetinherens as $dataInheren)
<div class="modal fade" id="modalFormEdit-{{ $dataInheren->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form id="modalFormContentEdit" action="{{ route('asetinheren.update',$dataInheren->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="idaset" id="idaset" value="{{ $dataInheren->aset }}">
                <div class="form-group">
                    <label for="user">Kemungkinan Ekploitasi (Likelihood)</label>
                    <select name="kemungkinan" id="kemungkinan" class="custom-select">
                        @foreach($mungkin as $inh)
                        <option value="1" {{ "1" == $dataInheren->nilaikemungkinan ? 'selected' : '' }}>{!! $inh->rare !!}</option>
                        <option value="2" {{ "2" == $dataInheren->nilaikemungkinan ? 'selected' : '' }}>{!! $inh->unlikely !!}</option>
                        <option value="3" {{ "3" == $dataInheren->nilaikemungkinan ? 'selected' : '' }}>{!! $inh->possible !!}</option>
                        <option value="4" {{ "4" == $dataInheren->nilaikemungkinan ? 'selected' : '' }}>{!! $inh->likely !!}</option>
                        <option value="5" {{ "5" == $dataInheren->nilaikemungkinan ? 'selected' : '' }}>{!! $inh->almost !!}</option>
                    @endforeach
                    </select>
                </div>    
        </div>
        <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    </div>
    </div>
</div>
@endforeach


<!-- Modal Edit Impact-->

@foreach ($asetinherens as $dataInheren)
<div class="modal fade" id="modalFormImpact-{{ $dataInheren->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitle-{{ $dataInheren->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle-{{ $dataInheren->id }}">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalFormImpact-{{ $dataInheren->id }}" action="{{ route('asetinheren.updatedampak') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="idaset" id="idaset-{{ $dataInheren->id }}" value="{{ $dataInheren->aset }}">
                <div class="modal-body">
                    <!-- Konten form akan diisi oleh AJAX -->
                    <p>Memuat data...</p>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


<script>
    $(document).ready(function() {
    $('[data-toggle="modal"]').on('click', function() {
        // Mengambil ID dari tombol yang diklik dan mengambil ID modal yang sesuai
        var id = $(this).data('target').split('-').pop(); 
        var modalBody = $('#modalFormImpact-' + id + ' .modal-body');  // Mengambil body modal berdasarkan ID
        var modalTitle = $('#modalTitle-' + id);  // Menentukan modal title yang sesuai dengan ID modal

        // Tampilkan loading message sementara
        modalBody.html('<p>Memuat data...</p>');

        // Mengirim permintaan AJAX untuk mengambil data modal berdasarkan ID
        $.ajax({
            url: `/impact-data/${id}`, // Pastikan rute ini benar
            type: 'GET',
            success: function(response) {
                console.log(response);  // Debugging: periksa respons dari server

                if (response.error) {
                    // Jika ada error dalam respons, tampilkan pesan kesalahan
                    modalBody.html('<p>' + response.error + '</p>');
                    return;
                }

                // Mengosongkan modal body dan memuat data baru
                modalBody.empty();  // Hapus konten sebelumnya

                 // Loop melalui setiap elemen dalam response
    response.forEach(function(item, index) {
          // Tentukan option yang akan dipilih berdasarkan nilai impact
          var formHtml = `
            <div class="form-group">
                <label for="inherenInput-${item.id}">${item.area}</label>
                <select name="inherenInput-${item.id}" id="inherenInput-${item.id}" class="custom-select">
                    <option value="1" ${item.nilaiimpact == 1 ? 'selected' : ''}>${item.n1}</option>
                    <option value="2" ${item.nilaiimpact == 2 ? 'selected' : ''}>${item.n2}</option>
                    <option value="3" ${item.nilaiimpact == 3 ? 'selected' : ''}>${item.n3}</option>
                    <option value="4" ${item.nilaiimpact == 4 ? 'selected' : ''}>${item.n4}</option>
                    <option value="5" ${item.nilaiimpact == 5 ? 'selected' : ''}>${item.n5}</option>
                </select>
                <input type="hidden" name="inheren" id="inheren" value="${item.inheren}">
            </div>
        `;
        modalBody.append(formHtml);
    });
            },
            error: function () {
                // Jika AJAX gagal, tampilkan pesan kesalahan
                modalBody.html('<p>Terjadi kesalahan. Coba lagi.</p>');
            }
        });
    });

    // Konfigurasi DataTable
    $(function () {
        $('#dt').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });

        // Reset form saat modal ditutup
        $('#modalForm').on('shown.bs.modal', function () {
            $(this).find('form')[0].reset();
        });
    });
});

</script>



</x-layout>
