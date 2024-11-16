<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">kriteriakemungkinan</li>
    </x-slot>
    <x-slot name="title">Kriteria Nilai Kemungkinan (Likelihood)</x-slot>
    <x-slot name="card_title">
      <a href="{{ route('kriteriakemungkinan.pdf') }}" class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</a>
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Rare</th>
                <th>Unlikely</th>
                <th>Possible</th><th>Likely</th><th>Almost Certain</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriteriakemungkinan as $no=>$data)
            <tr>
                <td>{!! $data->rare !!}</td>
                <td>{!! $data->unlikely !!}</td>
                <td>{!! $data->possible !!}</td>
                <td>{!! $data->likely !!}</td>
                <td>{!! $data->almost !!}</td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>                    
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <!-- Modal Edit-->

    @foreach ($kriteriakemungkinan as $datakriteriakemungkinan)
    <div class="modal fade" id="modalFormEdit-{{ $datakriteriakemungkinan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('kriteriakemungkinan.update',$datakriteriakemungkinan->id) }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="form-group">
                    <label for="uraian">Rare*</label>
                    <textarea class="form-control" name="rare" id="rare">{!! old('rare',$datakriteriakemungkinan->rare) !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="unlikely">Unlikely*</label>
                    <textarea class="form-control" name="unlikely" id="unlikely">{!! old('unlikely',$datakriteriakemungkinan->unlikely) !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="possible">Possible*</label>
                    <textarea class="form-control" name="possible" id="possible">{!! old('possible',$datakriteriakemungkinan->possible) !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="likely">Likely*</label>
                    <textarea class="form-control" name="likely" id="likely">{!! old('likely',$datakriteriakemungkinan->likely) !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="almost">Almost Certain*</label>
                    <textarea class="form-control" name="almost" id="almost">{!! old('almost',$datakriteriakemungkinan->almost) !!}</textarea>
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
