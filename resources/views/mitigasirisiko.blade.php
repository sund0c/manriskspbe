<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('inherentrisiko.tampil') }}">Jenis Aset</a></li>
        <li class="breadcrumb-item"><a href="{{ route('iteminherentrisiko.tampil',$idaset) }}">Inherent Risiko</a></li>
        {{-- 'jenisid','kerawanan')); --}}
        <li class="breadcrumb-item active">Mitigasi Risiko</li>
    </x-slot>
    <x-slot name="title">{{ $kerawanan }}</x-slot>
    <x-slot name="card_title">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button>
        {{-- <a href="{{ route('itemmitigasirisiko.csv', '1') }}" class="btn btn-success"><i class="fas fa-file-csv"></i> Ekspor ke CSV</a> --}}
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>PoC</th>
                <th>Mitigasi</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mitigasirisiko as $no=>$data)
            <tr>
                <td>{{ $data->poc }}</td>
                <td>{{ $data->mitigasi }}</td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('mitigasirisiko.hapus',[$data->id,$idinherent,$idaset,$kerawanan]) }}" method="POST" id="delete-form-{{ $data->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger hapus" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <!-- Modal Tambah-->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContent" action="{{ route('mitigasirisiko.tambah') }}" method="POST">
                @csrf
                <input type="hidden" id="idaset" name="idaset" value="{{ $idaset }}">
                <input type="hidden" id="idinherent" name="idinherent" value="{{ $idinherent }}">
                <input type="hidden" id="kerawanan" name="kerawanan" value="{{ $kerawanan }}">
                <div class="form-group">
                    <label for="nama">PoC Kerentanan</label>
                    <textarea class="form-control" id="poc" name="poc" autocomplete="false"></textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Mitigasi</label>
                    <textarea class="form-control" id="mitigasi" name="mitigasi" autocomplete="false"></textarea>
                </div>
                <div class="form-group">
                    <small id="namaHelp" class="form-text text-muted">*) harus diisi</small>
                </div>
            </div>
            <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->

    @foreach ($mitigasirisiko as $datamitigasirisiko)
    <div class="modal fade" id="modalFormEdit-{{ $datamitigasirisiko->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('mitigasirisiko.update',$datamitigasirisiko->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="idaset" name="idaset" value="{{ $idaset }}">
                <input type="hidden" id="idinherent" name="idinherent" value="{{ $idinherent }}">
                <input type="hidden" id="kerawanan" name="kerawanan" value="{{ $kerawanan }}">
                <div class="form-group">
                    <label for="nama">PoC*</label>
                    <textarea class="form-control" id="poc" name="poc" autocomplete="false">{{ $datamitigasirisiko->poc }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Mitigasi*</label>
                    <textarea class="form-control" id="mitigasi" name="mitigasi" autocomplete="false">{{ $datamitigasirisiko->mitigasi }}</textarea>
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
            "stateSave": true,
          });

           $('#modalForm').on('shown.bs.modal', function () {
                $(this).find('form')[0].reset();
                // var button = $(event.relatedTarget);
                // var jenisid = button.data('jenisid');
                // var modal = $(this);
                // modal.find('.modal-body #jenisidInput').val(jenisid);
             });

        });
      </script>

</x-layout>
