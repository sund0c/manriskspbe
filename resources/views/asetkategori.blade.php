<x-layout>
    <style>
        .confidentiality-table th, .confidentiality-table td {
            width: 700px;
        }
        .confidentiality-table th:nth-child(2), .confidentiality-table td:nth-child(2) {
            width: 500px; /* Define width for the second column */
        }

        /* .confidentiality-table th:nth-child(4), .confidentiality-table td:nth-child(4) {
            width: 100px; /* Define width for the fourth column */
        } */
    </style>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('aset.tampil') }}">Aset</a></li>
        <li class="breadcrumb-item">Kategori Aset</li>
    </x-slot>
    @php
    switch ($idaset->first()->kategorise) {
        case 'STRATEGIS':
            $buttonClass = 'btn-danger';
            break;
        case 'TINGGI':
            $buttonClass = 'btn-warning';
            break;
        case 'RENDAH':
            $buttonClass = 'btn-success';
            break;
    }
    @endphp
    <x-slot name="title">{{ $idaset->first()->nama }}
        <p style="font-size: 0.5em;">Jenis Aset: {{ $idaset->first()->jenis }} |
            Pemilik Aset: {{ $idaset->first()->userRelation->opdRelation->singkatan }}
            @if($idaset->first()->jenis=='APLIKASI')| <button class="btn btn-sm <?php echo $buttonClass; ?>">Kategori SE: {{ $idaset->first()->kategorise }}</button>
            @endif
        </p>
    </x-slot>
    <x-slot name="card_title">
        @if ($asetkategoris->isEmpty())
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="far fa-exclamation"></i> CEK KATEGORI</button> --}}
        @else
            <a href="{{ route('asetkategori.edit',$asetkategoris->first()->aset) }}" class="btn btn-warning"><i class="fas fa-edit"></i>UPDATE</a>
            <a href="{{ route('asetkategori.pdf', $asetkategoris->first()->aset) }}" class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</a>
        @endif
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover confidentiality-table">
            <thead>
            <tr>
                <th>Kriteria</th>
                <th width="200px">Jawaban</th>
                <th width="200px">Keterangan</th>
                {{-- <th width="100px">Aksi</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($asetkategoris as $no=>$data)
            <tr>
                <td>{{ $data->kategoriseRelation->urut}}. {{ $data->kategoriseRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(5)
                        {{ $data->kategoriseRelation->j1 }}
                        @break
                    @case(3)
                        {{ $data->kategoriseRelation->j2 }}
                        @break
                    @case(1)
                        {{ $data->kategoriseRelation->j3 }}
                        @break
                    @default
                        <p>Data tidak tersedia</p>
                @endswitch
                </td>
                <td>{{ $data->keterangan }}</td>
                {{-- <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <script>
        $(function () {
          $('#dt').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
           $('#modalForm').on('shown.bs.modal', function () {
                $(this).find('form')[0].reset();
             });
        });
      </script>



</x-layout>
