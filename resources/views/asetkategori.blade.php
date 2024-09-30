<x-layout>
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
        @else <a href="{{ route('asetkategori.pdf', $asetkategoris->first()->aset) }}" class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</a>
        @endif
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Kriteria</th>
                <th width="200px">Jawaban</th>
                <th width="200px">Keterangan</th>
                <th width="100px">Aksi</th>
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
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>


    <!-- Modal Edit-->

    @foreach ($asetkategoris as $dataItemklasifikasi)
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
            <form id="modalFormContentEdit" action="{{ route('asetkategori.update',[$dataItemklasifikasi->id, $data->aset]) }}" method="POST">
                @csrf
                <input type="hidden" id="aset" name="aset" value="{{ $idaset->first()->id }}">
                @method('PUT')
                <div class="form-group">
                    <strong>Kriteria :</strong> <br>
                    {{ $dataItemklasifikasi->kategoriseRelation->tanya }}
                </div>
                <div class="form-group">
                    <label for="jawab">Jawab</label>
                    <select name="jawab" id="jawab" class="form-control">
                        @if ($dataItemklasifikasi && $dataItemklasifikasi->kategoriseRelation)
                            <option value="5" {{ $dataItemklasifikasi->jawab == 5 ? 'selected' : '' }}>{{ $dataItemklasifikasi->kategoriseRelation->j1 }}</option>
                            <option value="3" {{ $dataItemklasifikasi->jawab == 3 ? 'selected' : '' }}>{{ $dataItemklasifikasi->kategoriseRelation->j2 }}</option>
                            <option value="1" {{ $dataItemklasifikasi->jawab == 1 ? 'selected' : '' }}>{{ $dataItemklasifikasi->kategoriseRelation->j3 }}</option>
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
