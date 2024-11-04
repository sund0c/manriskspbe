<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Jenis Aset</li>
    </x-slot>
    <x-slot name="title">Inherent Risiko Aset SPBE</x-slot>
    <x-slot name="card_title">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button> --}}
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Jenis Aset SPBE</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><a href="{{ route('iteminherentrisiko.tampil','1') }}" class="btn btn-primary">APLIKASI</a></td></tr>
            <tr><td><a href="{{ route('iteminherentrisiko.tampil','2') }}" class="btn btn-primary">INFRASTRUKTUR</a></td></tr>
            <tr><td><a href="{{ route('iteminherentrisiko.tampil','3') }}" class="btn btn-primary">SDM</a></td></tr>
            <tr><td><a href="{{ route('iteminherentrisiko.tampil','4') }}" class="btn btn-primary">DATA/INFORMASI</a></td></tr>
        </tbody>
        </table>
    </div>

    <script>
        $(function () {
          $('#dt').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>

</x-layout>
