<x-layout>
    <style>
        .confidentiality-table th, .confidentiality-table td {
            width: 700px;
        }
        .confidentiality-table th:nth-child(2), .confidentiality-table td:nth-child(2) {
            width: 500px; /* Define width for the second column */
        }

        .confidentiality-table th:nth-child(4), .confidentiality-table td:nth-child(4) {
            width: 100px; /* Define width for the fourth column */
        }
    hr {
        border: 0.3px solid;
    }
    </style>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('aset.tampil') }}">Aset</a></li>
        <li class="breadcrumb-item">Klasifikasi Aset</li>
    </x-slot>
    @php
    switch ($idaset->first()->klasifikasi) {
        case 'RAHASIA':
            $buttonClass = 'btn-danger'; // Merah
            break;
        case 'TERBATAS/INTERNAL':
            $buttonClass = 'btn-warning'; // Kuning
            break;
        case 'PUBLIK':
            $buttonClass = 'btn-success'; // Hijau
            break;
    }
    @endphp
    <x-slot name="title">{{ $idaset->first()->nama }}
        <p style="font-size: 0.5em;">Jenis Aset: {{ $idaset->first()->jenis }} |
            Pemilik Aset: {{ $idaset->first()->userRelation->opdRelation->singkatan }}
            @if($idaset->first()->jenis=='APLIKASI')| <button class="btn btn-sm <?php echo $buttonClass; ?>">Klasifikasi SE: {{ $idaset->first()->klasifikasi }}</button>
            @endif
        </p>
    </x-slot>
    <x-slot name="card_title">
        @if (!$asetklasifikasis->isEmpty())
        <a href="{{ route('asetklasifikasi.edit',$asetklasifikasis->first()->aset) }}" class="btn btn-warning"><i class="fas fa-edit"></i>UPDATE</a>
        <a href="{{ route('asetklasifikasi.pdf', $asetklasifikasis->first()->aset) }}" class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</a>
        @endif
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover confidentiality-table">
            <thead>
            <tr>
                <th>Kriteria Aspek CONFIDENTIALITY</th>
                <th>Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetklasifikasis as $no=>$data)
            @if ($data->klasifikasiRelation->domain == 1)
            <tr>
                <td>{{ $data->klasifikasiRelation->urut}}. {{ $data->klasifikasiRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->klasifikasiRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->klasifikasiRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->klasifikasiRelation->j3 }}
                        @break
                    @case(4)
                        {{ $data->klasifikasiRelation->j4 }}
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
            @endif
            @endforeach
        </tbody>
        </table>
    </div>
    <hr>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover confidentiality-table">
            <thead>
            <tr>
                <th>Kriteria Aspek INTEGRITY</th>
                <th>Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetklasifikasis as $no=>$data)
            @if ($data->klasifikasiRelation->domain == 2)
            <tr>
                <td>{{ $data->klasifikasiRelation->urut}}. {{ $data->klasifikasiRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->klasifikasiRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->klasifikasiRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->klasifikasiRelation->j3 }}
                        @break
                    @case(4)
                        {{ $data->klasifikasiRelation->j4 }}
                    @break
                @endswitch
                </td>
                <td>{{ $data->keterangan }}</td>
                {{-- <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                </td> --}}
            </tr>
            @endif
            @endforeach
        </tbody>
        </table>
    </div>
    <hr>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover confidentiality-table">
            <thead>
            <tr>
                <th>Kriteria Aspek AVALAIBILITY</th>
                <th>Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetklasifikasis as $no=>$data)
            @if ($data->klasifikasiRelation->domain == 3)
            <tr>
                <td>{{ $data->klasifikasiRelation->urut}}. {{ $data->klasifikasiRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->klasifikasiRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->klasifikasiRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->klasifikasiRelation->j3 }}
                        @break
                    @case(4)
                        {{ $data->klasifikasiRelation->j4 }}
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
            @endif

            @endforeach
        </tbody>
        </table>
    </div>




    <!-- Modal Edit-->

    @foreach ($asetklasifikasis as $dataItemklasifikasi)
    <div class="modal fade" id="modalFormEdit-{{ $dataItemklasifikasi->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('asetklasifikasi.update',[$dataItemklasifikasi->id, $data->aset]) }}" method="POST">
                @csrf
                <input type="hidden" id="aset" name="aset" value="{{ $idaset->first()->id }}">
                @method('PUT')
                <div class="form-group">
                    <strong>Kriteria :</strong> <br>
                    {{ $dataItemklasifikasi->klasifikasiRelation->tanya }}
                </div>
                <div class="form-group">
                    <label for="jawab">Jawab</label>
                    <select name="jawab" id="jawab" class="form-control">
                        @if ($dataItemklasifikasi && $dataItemklasifikasi->klasifikasiRelation)
                            <option value="1" {{ $dataItemklasifikasi->jawab == 1 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j1 }}</option>
                            <option value="2" {{ $dataItemklasifikasi->jawab == 2 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j1 }}</option>
                            <option value="3" {{ $dataItemklasifikasi->jawab == 3 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j3 }}</option>
                            <option value="4" {{ $dataItemklasifikasi->jawab == 4 ? 'selected' : '' }}>{{ $dataItemklasifikasi->klasifikasiRelation->j4 }}</option>
                        @else
                            <option value="">Data tidak tersedia</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Keterangan*</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" autocomplete="false">{{ $dataItemklasifikasi->keterangan }}</textarea>
                </div>
                <div class="form-group">
                    <small id="namaHelp" class="form-text text-muted">*) harus diisi</small>
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

    <script>
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
           $('#modalForm').on('shown.bs.modal', function () {
                $(this).find('form')[0].reset();
             });
        });
      </script>



</x-layout>
