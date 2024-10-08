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
    <x-slot name="title">Aset SPBE Prov Bali</x-slot>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab-kategori" data-toggle="tab" href="#content-kategori" role="tab" aria-controls="content-kategori" aria-selected="true">Kategori</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab-klasifikasi" data-toggle="tab" href="#content-klasifikasi" role="tab" aria-controls="content-klasifikasi" aria-selected="false">Klasifikasi</a>
        </li>
    </ul>
    <x-slot name="card_title">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button>
        <button class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</button>
    </x-slot>

    <div class="tab-content" id="myTabContent">
        <!-- Tab A Content -->
        <div class="tab-pane fade show active" id="content-kategori" role="tabpanel" aria-labelledby="tab-kategori">
            <div class="card-body">
                <table id="dt" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="30px">No</th>
                        <th width="190px">SKOR:KATEGORI</th>
                        <th width="100px">Jenis</th>
                        <th width="200px">Layanan SPBE</th>
                        <th>Nama</th>
                        <th>OPD</th>
                        <th width="130px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aset as $no=>$data)
                    <tr>
                        <td align="right">{{ $no+1 }}</td>
                        <td align="center">
                            @if ($data->jenis == 'APLIKASI')
                                @php
                                switch ($data->kategorise) {
                                    case 'STRATEGIS':
                                        $buttonClass = 'btn-danger'; // Merah
                                        $na='S';
                                        break;
                                    case 'TINGGI':
                                        $buttonClass = 'btn-warning'; // Kuning
                                        $na='T';
                                        break;
                                    case 'RENDAH':
                                        $buttonClass = 'btn-success'; // Biru
                                        $na='R';
                                        break;
                                    default:
                                        $buttonClass = 'btn-secondary'; // Kelas default jika kategori tidak dikenali
                                        break;
                                }
                            @endphp
                            <a href="{{ route('asetkategori.tampil',$data->id) }}" class="btn btn-sm custom-btn <?php echo $buttonClass; ?> fixed-size-button" title="Kategori SE">{{ $data->skorkategori }}: {{ $data->kategorise }}</a>
                            @endif
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
                        <td align="center">
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                            <form class="d-inline" action="{{ route('aset.hapus', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
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
        </div>

        <div class="tab-pane fade" id="content-klasifikasi" role="tabpanel" aria-labelledby="tab-klasifikasi">
            <div class="card-body">
                <table id="dtk" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="30px">No</th>
                        <th width="190px">KLASIFIKASI</th>
                        <th width="100px">Jenis</th>
                        <th width="200px">Layanan SPBE</th>
                        <th>Nama</th>
                        <th>OPD</th>
                        <th width="130px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asetk as $no=>$datak)
                    <tr>
                        <td align="right">{{ $no+1 }}</td>
                        <td align="center">
                            @if ($datak->jenis == 'APLIKASI')
                                @php
                                switch ($datak->klasifikasi) {
                                    case 'RAHASIA':
                                        $buttonClass = 'btn-danger'; // Merah
                                        $na='R';
                                        break;
                                    case 'TERBATAS/INTERNAL':
                                        $buttonClass = 'btn-warning'; // Kuning
                                        $na='T';
                                        break;
                                    case 'PUBLIK':
                                        $buttonClass = 'btn-success'; // Hijau
                                        $na='P';
                                        break;
                                    default:
                                        $buttonClass = 'btn-secondary'; // Kelas default jika kategori tidak dikenali
                                        break;
                                }
                                @endphp
                            <a href="{{ route('asetklasifikasi.tampil',$datak->id) }}" class="btn btn-sm custom-btn <?php echo $buttonClass; ?> fixed-size-button" title="Klasifikasi">{{ $datak->klasifikasi }}</a>
                            @endif
                        </td>
                        <td>{{ $datak->jenis }}</td>
                        <td>{{ $datak->layananRelation->jenis }}:<BR>{{ $datak->layananRelation->nama }}</td>
                        <td>
                            @if ($datak->jenis == 'APLIKASI' || $datak->jenis == 'INFRASTRUKTUR')
                                {{ $datak->nama }}<br>
                                <i>URL: {{ $datak->url }} / IP: {{ $datak->ip }}</i>
                            @else
                                {{ $datak->nama }}
                            @endif
                        </td>
                        {{-- <td>{{ $data->userRelation->opdRelation->singkatan }}</td> --}}
                        <td>{{ $datak->opdRelation->singkatan }}</td>
                        <td align="center">
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $datak->id }}"><i class="fas fa-edit"></i></a>
                            <form class="d-inline" action="{{ route('aset.hapus', $datak->id) }}" method="POST" id="delete-form-{{ $datak->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger hapus" data-id="{{ $datak->id }}"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>

        </div>
    </div>


    <!-- Modal Tambah-->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContent" action="{{ route('aset.tambah') }}" method="POST">
                @csrf
                <div class="form-row">
                    {{-- <div class="form-group col-md-4">
                        <label for="user">User PIC*</label>
                        <select name="user" id="user" class="form-control">
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->opdRelation->singkatan }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label for="user">Pemilik Aset/OPD*</label>
                        <select name="user" id="user" class="form-control">
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->singkatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="singkatan">Nama Aset*</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" autocomplete="false" value="{{ old('nama') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="url">URL (tanpa https://, tanpa www)</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="URL/Subdomain" autocomplete="false" value="{{ old('url') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ip">IP Address</label>
                        <input type="text" class="form-control" id="ip" name="ip" placeholder="IP" autocomplete="false" value="{{ old('ip') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="jenis">Jenis Aset</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="APLIKASI" selected>APLIKASI</option>
                            <option value="INFRASTRUKTUR">INFRASTRUKTUR</option>
                            <option value="SDM">SDM</option>
                            <option value="DATA/INFORMASI">DATA/INFORMASI</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="jenis">Kategori Layanan SPBE</label>
                        <select name="layanan" id="layanan" class="form-control">
                            @foreach ($layananspbe as $layanan)
                                        <option value="{{ $layanan->id}}">{{ $layanan->jenis}}:{{ $layanan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="url">Keterangan/Fungsi/Manfaat/Kegunaan</label>
                        <textarea class="form-control" id="penjelasan" name="penjelasan"></textarea>
                    </div>
                </div>
                  <div class="form-group">
                    <small id="namaHelp" class="form-text text-muted">*) harus diisi. Kolom URL dan IP hanya perlu diisi untuk aset APLIKASI & INFRASTRUKTUR</small>
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

    @foreach ($aset as $dataAset)
    <div class="modal fade" id="modalFormEdit-{{ $dataAset->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form id="modalFormContentEdit" action="{{ route('aset.update',$dataAset->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="user">User PIC*</label>
                        <select name="user" id="user" class="form-control">
                            {{-- @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ $u->id == $dataAset->user ? 'selected' : '' }}>
                                    {{ $u->name }} - {{ $u->opdRelation->singkatan }}
                                </option>
                            @endforeach --}}
                            @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ $u->id == $dataAset->user ? 'selected' : '' }}>
                                {{ $u->singkatan }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="singkatan">Nama*</label>
                        <input type="text" value="{{ old('nama',$dataAset->nama) }}" class="form-control" id="nama" name="nama" placeholder="Nama" autocomplete="false" value="{{ old('nama') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="url">URL (tanpa https://, tanpa www)</label>
                        <input type="text" value="{{ old('url',$dataAset->url) }}" class="form-control" id="url" name="url" placeholder="URL/Subdomain" autocomplete="false" value="{{ old('url') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ip">IP</label>
                        <input type="text" value="{{ old('ip',$dataAset->ip) }}" class="form-control" id="ip" name="ip" placeholder="IP" autocomplete="false" value="{{ old('ip') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="jenis">Jenis Aset</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="APLIKASI" {{ $dataAset->jenis == 'APLIKASI' ? 'selected' : '' }}>APLIKASI</option>
                            <option value="INFRASTRUKTUR" {{ $dataAset->jenis == 'INFRASTRUKTUR' ? 'selected' : '' }}>INFRASTRUKTUR</option>
                            <option value="SDM" {{ $dataAset->jenis == 'SDM' ? 'selected' : '' }}>SDM</option>
                            <option value="DATA/INFORMASI" {{ $dataAset->jenis == 'DATA/INFORMASI' ? 'selected' : '' }}>DATA/INFORMASI</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="jenis">Kategori Layanan SPBE</label>
                        <select name="layanan" id="layanan" class="form-control">
                            @foreach ($layananspbe as $layanan)
                                <option value="{{ $layanan->id}}" {{ $layanan->id == $dataAset->layanan ? 'selected' : '' }}>{{ $layanan->jenis}}:{{ $layanan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="url">Keterangan/Fungsi/Manfaat/Kegunaan</label>
                        <textarea class="form-control" id="penjelasan" name="penjelasan">{{ $dataAset->keterangan }}</textarea>
                    </div>
                </div>
                  <div class="form-group">
                    <small id="namaHelp" class="form-text text-muted">*) harus diisi. Kolom URL dan IP hanya perlu diisi untuk aset APLIKASI & INFRASTRUKTUR</small>
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
            "stateSave": true,
          });
          $('#dtk').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "stateSave": true,
          });
           $('#modalForm').on('shown.bs.modal', function () {
                $(this).find('form')[0].reset();
             });

        });
      </script>

</x-layout>
