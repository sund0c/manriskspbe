<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">layananspbes</li>
    </x-slot>
    <x-slot name="title">Layanan SPBE</x-slot>
    <x-slot name="card_title"><button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button></x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th width="30px">No</th>
                <th width="150px">Kategori</th>
                <th>Layanan</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($layananspbe as $no=>$data)
            <tr>
                <td align="right">{{ $no+1 }}</td>
                <td>{{ $data->jenis }}</td>
                <td>{{ $data->nama }}</td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('layananspbe.hapus', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
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
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContent" action="{{ route('layananspbe.tambah') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama*</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama" autocomplete="false" value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis">Kategori</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="ADPEM">ADMINISTRASI PEMERINTAHAN</option>
                        <option value="PUBLIK" selected>PUBLIK</option>
                    </select>
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

    @foreach ($layananspbe as $datalayananspbe)
    <div class="modal fade" id="modalFormEdit-{{ $datalayananspbe->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('layananspbe.update',$datalayananspbe->id) }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="form-group">
                    <label for="nama">Nama*</label>
                    <input type="text" class="form-control" value="{{ old('nama',$datalayananspbe->nama) }}" name="nama" id="nama" placeholder="nama" autocomplete="false">
                  </div>
                  <div class="form-group">
                    <label for="jenis">Kategori</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="ADPEM" {{ $data->jenis == 'ADPEM' ? 'selected' : '' }}>ADMINISTRASI PEMERINTAHAN</option>
                        <option value="PUBLIK" {{ $data->jenis == 'PUBLIK' ? 'selected' : '' }}>PUBLIK</option>
                    </select>
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
