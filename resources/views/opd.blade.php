<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"></li>
        {{-- <li class="breadcrumb-item active">Blank Page</li> --}}
    </x-slot>
    <x-slot name="title">Perangkat Daerah</x-slot>
    <x-slot name="card_title"><button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button></x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th width="30px">No</th>
                <th width="150px">Singkatan</th>
                <th>Nama OPD</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opd as $no=>$data)
            <tr>
                <td align="right">{{ $no+1 }}</td>
                <td>{{ $data->singkatan }}</td>
                <td>{{ $data->nama }}</td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('opd.hapus', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            <form id="modalFormContent" action="{{ route('opd.tambah') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="singkatan">Singkatan*</label>
                    <input type="text" class="form-control @error('singkatan') is-invalid @enderror" id="singkatan" name="singkatan" placeholder="Singkatan" autocomplete="false" value="{{ old('singkatan') }}">
                    @error('singkatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama*</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama" autocomplete="false" value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

    @foreach ($opd as $dataOpd)
    <div class="modal fade" id="modalFormEdit-{{ $dataOpd->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('opd.update',$dataOpd->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">Singkatan*</label>
                    <input type="text" class="form-control" value="{{ old('singkatan',$dataOpd->singkatan) }}" id="singkatan" name="singkatan" placeholder="Singkatan" autocomplete="false">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama*</label>
                    <input type="text" class="form-control" value="{{ old('singkatan',$dataOpd->nama) }}" name="nama" id="nama" placeholder="nama" autocomplete="false">

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

    //         $('#modalFormContent').on('submit', function (e) {
    //     e.preventDefault(); // Prevent default form submission

    //     $.ajax({
    //         url: $(this).attr('action'),
    //         method: 'POST',
    //         data: $(this).serialize(),
    //         success: function (response) {
    //             Swal.fire({
    //                     title: "Berhasil!",
    //                     text: response.success,
    //                     icon: "success",
    //                     confirmButtonText: "OK"
    //                 }).then(() => {
    //                     $('#modalForm').modal('hide');
    //                     window.location.reload();
    //                 });
    //         },
    //         error: function (xhr) {
    //             // Handle errors
    //             var errors = xhr.responseJSON.errors;
    //             if (errors) {
    //                 $('.form-control').removeClass('is-invalid');
    //                 $('.invalid-feedback').remove();
    //                 $.each(errors, function (field, messages) {
    //                     $('#' + field).addClass('is-invalid');
    //                     $('#' + field).after('<div class="invalid-feedback">' + messages[0] + '</div>');
    //                 });
    //                 $('#modalForm').modal('show');
    //             }
    //         }
    //     });
    // });

        });
      </script>

</x-layout>
