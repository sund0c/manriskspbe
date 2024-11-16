<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">areadampak</li>
    </x-slot>
    <x-slot name="title">Kriteria Nilai Dampak (Impact) </x-slot>
    <x-slot name="card_title">
      <a href="{{ route('areadampak.pdf') }}" class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</a>
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Area</th>
                <th>Insignificant</th>
                <th>Low</th><th>Medium</th><th>High</th><th>Critical</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($areadampak as $no=>$data)
            <tr>
                <td>{{ $data->area }}<br><i>{{ $data->keterangan}}</i></td>
                <td>{!! $data->insignificant !!}</td>
                <td>{!! $data->low !!}</td>
                <td>{!! $data->medium !!}</td>
                <td>{!! $data->high !!}</td>
                <td>{!! $data->critical !!}</td>
                <td align="center">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>                    
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    @foreach ($areadampak as $dataareadampak)
    <div class="modal fade" id="modalFormEdit-{{ $dataareadampak->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('areadampak.update',$dataareadampak->id) }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="form-group">
                    <label for="area">Area Dampak Risiko*</label>
                    <input type="text" class="form-control" value="{{ old('area',$dataareadampak->area) }}" name="area" id="area" placeholder="area" autocomplete="false">
                  </div>
                  <div class="form-group">
                    <label for="uraian">Keterangan*</label>
                    <textarea class="form-control" name="uraian" id="uraian">{{ old('uraian',$dataareadampak->uraian) }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="low">Insignificant*</label>
                    <textarea class="form-control" name="insignificant" id="insignificant">{!! old('insignificant',$dataareadampak->insignificant) !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="low">Low*</label>
                    <textarea class="form-control" name="low" id="low">{!! old('low',$dataareadampak->low) !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="medium">Medium*</label>
                    <textarea class="form-control" name="medium" id="medium">{!! old('medium',$dataareadampak->medium) !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="high">High*</label>
                    <textarea class="form-control" name="high" id="high">{!! old('high',$dataareadampak->high) !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="critical">Critical*</label>
                    <textarea class="form-control" name="critical" id="critical">{!! old('critical',$dataareadampak->critical) !!}</textarea>
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
