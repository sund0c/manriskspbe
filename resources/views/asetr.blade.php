<x-layout>
    <style>
        .custom-btn {
            min-width: 160px; /* Lebar minimum yang diinginkan */
    }
    </style>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Aset</li>
    </x-slot>
    <x-slot name="title">Risiko Aset SPBE Prov Bali</x-slot>

    <x-slot name="card_title">
    </x-slot>
           <div class="card-body">
                      <table id="dt" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="30px">No</th>
                        <th width="190px">Risiko Keamanan</th>
                        <th width="100px">Jenis</th>
                        <th width="200px">Layanan SPBE</th>
                        <th>Nama</th>
                        <th>OPD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aset as $no=>$data)
                    <tr>
                        <td align="right">{{ $no+1 }}</td>
                        <td align="center">
                            <a href="{{ route('asetinheren.tampil',$data->id) }}" class="btn btn-sm custom-btn btn-info fixed-size-button" title="Risiko Inheren">RISIKO</a>
                          </td>
                        <td>{{ $data->jenis }}</td>
                        <td>{{ $data->layananRelation->jenis }}:<BR>{{ $data->layananRelation->nama }}</td>
                        <td>
                            @if ($data->jenis == 'APLIKASI' || $data->jenis == 'INFRASTRUKTUR')
                                {{ $data->nama }}<br>
                                <i>URL: {{ $data->url }} / IP: {{ $data->ip }}</i>
                            @else
                                {{ $data->nama }}
                            @endif
                        </td>
                        {{-- <td>{{ $data->userRelation->opdRelation->singkatan }}</td> --}}
                        <td>{{ $data->opdRelation->singkatan }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>

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
            "stateSave": true,
          });
        });
      </script>
</script>

</x-layout>
