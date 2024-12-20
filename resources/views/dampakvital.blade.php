<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Domain</li>
    </x-slot>
    <x-slot name="title">Domain Vitalitas Sistem Elektronik</x-slot>
    <x-slot name="card_title">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button> --}}
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Domains</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dampakvital as $no=>$data)
            <tr>
                <td><a href="{{ route('itemdampakvital.tampil',$data->id) }}" class="btn btn-primary">{{ $data->nama }}</a></td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <!-- Modal Edit-->

    @foreach ($dampakvital as $dataDampakvital)
    <div class="modal fade" id="modalFormEdit-{{ $dataDampakvital->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('klasifikasi.update',$dataDampakvital->id) }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="form-group">
                    <label for="nama">Nama*</label>
                    <input type="text" class="form-control" value="{{ old('nama',$dataDampakvital->nama) }}" name="nama" id="nama" placeholder="nama" autocomplete="false">
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
