<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item"><a href="{{ route('inherentrisiko.tampil') }}">Jenis Aset</a></li>
        <li class="breadcrumb-item active">Inherent Risiko</li>
    </x-slot>
    <x-slot name="title">Inherent Risiko Aset SPBE: {{ $jenis }}</x-slot>
    <x-slot name="card_title">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button>
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Kerawanan</th>
                <th>Ancaman</th>
                <th>Aspek Risiko</th>
                <th>Uraian Dampak</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inherentrisiko as $no=>$data)
            <tr>
                <td>{{ $data->kerawanan }} ({{$data->kritikal}})</td>
                <td>{{ $data->ancaman }}</td>
                <td>{{ $data->aspekrisiko }}</td>
                <td>{{ $data->uraiandampak }}</td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('iteminherentrisiko.hapus',[$data->id, $jenisid]) }}" method="POST" id="delete-form-{{ $data->id }}">
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
            <form id="modalFormContent" action="{{ route('iteminherentrisiko.tambah') }}" method="POST">
                @csrf
                <input type="hidden" id="jenisid" name="jenisid" value="{{ $jenisid }}">
                <div class="form-group">
                    <label for="nama">Kerawanan</label>
                    <textarea class="form-control" id="kerawanan" name="kerawanan" autocomplete="false"></textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Ancaman</label>
                    <textarea class="form-control" id="ancaman" name="ancaman" autocomplete="false"></textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Aspek Risiko</label>
                    <textarea class="form-control" id="aspekrisiko" name="aspekrisiko" autocomplete="false"></textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Uraian Dampak</label>
                    <textarea class="form-control" id="uraiandampak" name="uraiandampak" autocomplete="false"></textarea>
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

    @foreach ($inherentrisiko as $datainherentrisiko)
    <div class="modal fade" id="modalFormEdit-{{ $datainherentrisiko->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('iteminherentrisiko.update',$datainherentrisiko->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="jenisid" name="jenisid" value="{{ $jenisid }}">
                <div class="form-group">
                    <label for="nama">Kerawanan*</label>
                    <textarea class="form-control" id="kerawanan" name="kerawanan" autocomplete="false">{{ $datainherentrisiko->kerawanan }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Pilihan Jawaban #1*</label>
                    <textarea class="form-control" id="ancaman" name="ancaman" autocomplete="false">{{ $datainherentrisiko->ancaman }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Pilihan Jawaban #2*</label>
                    <textarea class="form-control" id="aspekrisiko" name="aspekrisiko" autocomplete="false">{{ $datainherentrisiko->aspekrisiko }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Pilihan Jawaban #3*</label>
                    <textarea class="form-control" id="uraiandampak" name="uraiandampak" autocomplete="false">{{ $datainherentrisiko->uraiandampak }}</textarea>
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
                // var button = $(event.relatedTarget);
                // var jenisid = button.data('jenisid');
                // var modal = $(this);
                // modal.find('.modal-body #jenisidInput').val(jenisid);
             });

        });
      </script>

</x-layout>
