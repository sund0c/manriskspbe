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
        <li class="breadcrumb-item">Vitalitas Aset</li>
    </x-slot>
    @php
    switch ($idaset->first()->dampakvital) {
        case 'SERIUS':
            $buttonClass = 'btn-dark'; // Merah
            break;
        case 'SIGNIFIKAN':
            $buttonClass = 'btn-danger'; // Merah
            break;
        case 'TERBATAS':
            $buttonClass = 'btn-warning'; // Kuning
            break;
        case 'MINOR':
            $buttonClass = 'btn-success'; // Hijau
            break;
    }
    @endphp
    <x-slot name="title">{{ $idaset->first()->nama }}
        <p style="font-size: 0.5em;">Jenis Aset: {{ $idaset->first()->jenis }} |
            Pemilik Aset: {{ $idaset->first()->opdRelation->singkatan }}
            @if($idaset->first()->jenis=='APLIKASI')| <button class="btn btn-sm <?php echo $buttonClass; ?>">Vitalitas SE: {{ $idaset->first()->dampakvital }}</button>
            @endif
        </p>
    </x-slot>
    <x-slot name="card_title">
        @if (!$asetdampakvitals->isEmpty())
        <a href="{{ route('asetdampakvital.edit',$asetdampakvitals->first()->aset) }}" class="btn btn-warning"><i class="fas fa-edit"></i>UPDATE</a>
        <a href="{{ route('asetdampakvital.pdf', $asetdampakvitals->first()->aset) }}" class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</a>
        @endif
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover confidentiality-table">
            <thead>
            <tr>
                <th>Dampak OPERASIONAL</th>
                <th>Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetdampakvitals as $no=>$data)
            @if ($data->dampakvitalRelation->domain == 1)
            <tr>
                <td>{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->dampakvitalRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->dampakvitalRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->dampakvitalRelation->j3 }}
                        @break
                    @case(4)
                        {{ $data->dampakvitalRelation->j4 }}
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
                <th>Dampak DATA dan/atau INFORMASI</th>
                <th>Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetdampakvitals as $no=>$data)
            @if ($data->dampakvitalRelation->domain == 2)
            <tr>
                <td>{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->dampakvitalRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->dampakvitalRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->dampakvitalRelation->j3 }}
                        @break
                    @case(4)
                        {{ $data->dampakvitalRelation->j4 }}
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
                <th>Dampak FINANSIAL</th>
                <th>Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetdampakvitals as $no=>$data)
            @if ($data->dampakvitalRelation->domain == 3)
            <tr>
                <td>{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->dampakvitalRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->dampakvitalRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->dampakvitalRelation->j3 }}
                        @break
                    @case(4)
                        {{ $data->dampakvitalRelation->j4 }}
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
                <th>Dampak UMUM</th>
                <th>Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetdampakvitals as $no=>$data)
            @if ($data->dampakvitalRelation->domain == 4)
            <tr>
                <td>{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->dampakvitalRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->dampakvitalRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->dampakvitalRelation->j3 }}
                        @break
                    @case(4)
                        {{ $data->dampakvitalRelation->j4 }}
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
                <th>Dampak KETERGANTUNGAN</th>
                <th>Jawaban</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asetdampakvitals as $no=>$data)
            @if ($data->dampakvitalRelation->domain == 5)
            <tr>
                <td>{{ $data->dampakvitalRelation->urut}}. {{ $data->dampakvitalRelation->tanya}}</td>
                <td>
                    @switch($data->jawab)
                    @case(1)
                        {{ $data->dampakvitalRelation->j1 }}
                        @break
                    @case(2)
                        {{ $data->dampakvitalRelation->j2 }}
                        @break
                    @case(3)
                        {{ $data->dampakvitalRelation->j3 }}
                        @break
                    @case(4)
                        {{ $data->dampakvitalRelation->j4 }}
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

    @foreach ($asetdampakvitals as $dataItemklasifikasi)
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
            <form id="modalFormContentEdit" action="{{ route('asetdampakvital.update',[$dataItemklasifikasi->id, $data->aset]) }}" method="POST">
                @csrf
                <input type="hidden" id="aset" name="aset" value="{{ $idaset->first()->id }}">
                @method('PUT')
                <div class="form-group">
                    <strong>Kriteria :</strong> <br>
                    {{ $dataItemklasifikasi->dampakvitalRelation->tanya }}
                </div>
                <div class="form-group">
                    <label for="jawab">Jawab</label>
                    <select name="jawab" id="jawab" class="form-control">
                        @if ($dataItemklasifikasi && $dataItemklasifikasi->dampakvitalRelation)
                            <option value="1" {{ $dataItemklasifikasi->jawab == 1 ? 'selected' : '' }}>{{ $dataItemklasifikasi->dampakvitalRelation->j1 }}</option>
                            <option value="2" {{ $dataItemklasifikasi->jawab == 2 ? 'selected' : '' }}>{{ $dataItemklasifikasi->dampakvitalRelation->j1 }}</option>
                            <option value="3" {{ $dataItemklasifikasi->jawab == 3 ? 'selected' : '' }}>{{ $dataItemklasifikasi->dampakvitalRelation->j3 }}</option>
                            <option value="4" {{ $dataItemklasifikasi->jawab == 4 ? 'selected' : '' }}>{{ $dataItemklasifikasi->dampakvitalRelation->j4 }}</option>
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
