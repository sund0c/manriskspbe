<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('dampakvital.tampil') }}">Domain</a></li>
        <li class="breadcrumb-item">Item</li>
    </x-slot>
    <x-slot name="title">Domain: {{ $iddampakvital->first()->nama }}</x-slot>
    <x-slot name="card_title">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button> --}}
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Kriteria</th>
                <th width="200px">Indikator #1</th>
                <th width="200px">Indikator #2</th>
                <th width="200px">Indikator #3</th>
                <th width="200px">Indikator #4</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itemdampakvitals as $no=>$data)
            <tr>
                <td>{{ $data->urut }}. {{ $data->tanya }}</td>
                <td>{{ $data->j1 }}</td>
                <td>{{ $data->j2 }}</td>
                <td>{{ $data->j3 }}</td>
                <td>{{ $data->j4 }}</td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    {{-- <form class="d-inline" action="{{ route('itemdampakvital.hapus',[$data->id, $data->domain]) }}" method="POST" id="delete-form-{{ $data->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger hapus" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button>
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>


    <!-- Modal Edit-->

    @foreach ($itemdampakvitals as $dataItemdampakvital)
    <div class="modal fade" id="modalFormEdit-{{ $dataItemdampakvital->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('itemdampakvital.update',[$dataItemdampakvital->id, $data->domain]) }}" method="POST">
                @csrf
                <input type="hidden" id="domain" name="domain" value="{{ $iddampakvital->first()->id }}">
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Kriteria*</label>
                    <textarea class="form-control" id="kriteria" name="kriteria" autocomplete="false">{{ $dataItemdampakvital->tanya }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Indikator #1*</label>
                    <textarea class="form-control" id="j1" name="j1" autocomplete="false">{{ $dataItemdampakvital->j1 }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Indikator #2*</label>
                    <textarea class="form-control" id="j2" name="j2" autocomplete="false">{{ $dataItemdampakvital->j2 }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Indikator #3*</label>
                    <textarea class="form-control" id="j3" name="j3" autocomplete="false">{{ $dataItemdampakvital->j3 }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nama">Indikator #4*</label>
                    <textarea class="form-control" id="j4" name="j4" autocomplete="false">{{ $dataItemdampakvital->j4 }}</textarea>
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
