<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('annex.tampil') }}">Domain</a></li>
        <li class="breadcrumb-item"><a href="{{ route('itemannex.tampil',$iditemannex->first()->id) }}">Item</a></li>
        <li class="breadcrumb-item active">Kriteria</li>
    </x-slot>
    <x-slot name="title">{{ $iditemannex->first()->nama }}</x-slot>
    <x-slot name="card_title"><button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button></x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th width="30px">Urut</th>
                <th width="500px">Kriteria</th>
                <th>Penjelasan</th>
                <th>Tujuan</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriteriaannexes as $no=>$data)
            <tr>
                <td>{{ $data->urut }}</td>
                <td>{{ $data->tanya }}</td>
                <td>{{ $data->penjelasan }}</td>
                <td>{{ $data->tujuan }}</td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('kriteriaannex.hapus',[$data->id, $data->item]) }}" method="POST" id="delete-form-{{ $data->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger hapus" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button>
                    </form
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <!-- Modal Tambah-->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContent" action="{{ route('kriteriaannex.tambah') }}" method="POST">
                @csrf
                <input type="hidden" id="item" name="item" value="{{ $iditemannex->first()->id }}">
                <div class="form-group">
                    <label for="nama">No Urutan*</label>
                    <input type="text" class="form-control" id="urut" name="urut" autocomplete="false">
                </div>
                <div class="form-group">
                    <label for="nama">Kriteria*</label>
                    <textarea class="form-control" id="kriteria" name="kriteria" autocomplete="false"></textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Penjelasan*</label>
                    <textarea class="form-control" id="penjelasan" name="penjelasan" autocomplete="false"></textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Tujuan*</label>
                    <textarea class="form-control" id="tujuan" name="tujuan" autocomplete="false"></textarea>
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

    @foreach ($kriteriaannexes as $dataAnnexes)
    <div class="modal fade" id="modalFormEdit-{{ $dataAnnexes->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('kriteriaannex.update',[$dataAnnexes->id, $data->item]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="item" name="item" value="{{ $iditemannex->first()->id }}">
                <div class="form-group">
                    <label for="urut">No Urutan*</label>
                    <input type="text" class="form-control" id="urut" name="urut" autocomplete="false" value="{{ old('urut',$dataAnnexes->urut) }}">
                </div>
                <div class="form-group">
                    <label for="nama">Kriteria*</label>
                    <textarea class="form-control" id="kriteria" name="kriteria" autocomplete="false">{{ $dataAnnexes->tanya }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Penjelasan*</label>
                    <textarea class="form-control" id="penjelasan" name="penjelasan" autocomplete="false">{{ $dataAnnexes->penjelasan }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Tujuan*</label>
                    <textarea class="form-control" id="tujuan" name="tujuan" autocomplete="false">{{ $dataAnnexes->tujuan }}</textarea>
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
            "ordering": true,
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
