<x-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Aset</li>
    </x-slot>
    <x-slot name="title">Aset SPBE Prov Bali</x-slot>
    <x-slot name="card_title">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button>
        <button class="btn btn-primary"><i class="far fa-file-pdf"></i> PDF</button>
    </x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th width="30px">No</th>
                <th width="120px" align="center">Status Aset</th>
                <th width="150px">Jenis</th>
                <th>Nama</th>
                <th width="170px">OPD</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aset as $no=>$data)
            <tr>
                <td align="right">{{ $no+1 }}</td>
                <td align="right">
                    @if ($data->jenis == 'APLIKASI')
                        @php
                        switch ($data->kategorise) {
                            case 'STRATEGIS':
                                $buttonClass = 'btn-danger'; // Merah
                                break;
                            case 'TINGGI':
                                $buttonClass = 'btn-warning'; // Kuning
                                break;
                            case 'RENDAH':
                                $buttonClass = 'btn-success'; // Biru
                                break;
                            default:
                                $buttonClass = 'btn-secondary'; // Kelas default jika kategori tidak dikenali
                                break;
                        }
                    @endphp
                    <a href="{{ route('asetkategori.tampil',$data->id) }}" class="btn btn-sm <?php echo $buttonClass; ?> fixed-size-button" title="Kategori SE">K</a>
                    @endif
                    @php
                        switch ($data->klasifikasi) {
                            case 'RAHASIA':
                                $buttonClass = 'btn-danger'; // Merah
                                break;
                            case 'TERBATAS':
                                $buttonClass = 'btn-warning'; // Kuning
                                break;
                            case 'INTERNAL':
                                $buttonClass = 'btn-info'; // Biru
                                break;
                            case 'PUBLIK':
                                $buttonClass = 'btn-success'; // Hijau
                                break;
                            default:
                                $buttonClass = 'btn-secondary'; // Kelas default jika kategori tidak dikenali
                                break;
                        }
                    @endphp
                    <a href="#" class="btn btn-sm <?php echo $buttonClass; ?> fixed-size-button" title="Klasifikasi">L</a>
                    @php
                        switch ($data->risiko) {
                            case 'CRITICAL':
                                $buttonClass = 'btn-danger'; // Merah
                                break;
                            case 'HIGH':
                                $buttonClass = 'btn-warning'; // Kuning
                                break;
                            case 'MEDIUM':
                                $buttonClass = 'btn-info'; // Biru
                                break;
                            case 'LOW':
                                $buttonClass = 'btn-success'; // Hijau
                                break;
                            default:
                                $buttonClass = 'btn-secondary'; // Kelas default jika kategori tidak dikenali
                                break;
                        }
                    @endphp
                    <a href="#" class="btn btn-sm <?php echo $buttonClass; ?> fixed-size-button" title="Kontrol Risiko">R</a>
                </td>
                <td>{{ $data->jenis }}</td>
                <td>
                    @if ($data->jenis == 'APLIKASI' || $data->jenis == 'INFRASTRUKTUR')
                        {{ $data->nama }}<br>
                        <i>URL: {{ $data->url }} / IP: {{ $data->ip }}</i>
                    @else
                        {{ $data->nama }}
                    @endif
                </td>
                <td>{{ $data->userRelation->opdRelation->singkatan }}</td>
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
            <form id="modalFormContent" action="{{ route('aset.tambah') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user">User PIC*</label>
                    <select name="user" id="user" class="form-control">
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->opdRelation->singkatan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="singkatan">Nama*</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" autocomplete="false" value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                    <label for="url">URL (tanpa https://, tanpa www)</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="URL/Subdomain" autocomplete="false" value="{{ old('url') }}">
                </div>
                <div class="form-group">
                    <label for="ip">IP</label>
                    <input type="text" class="form-control" id="ip" name="ip" placeholder="IP" autocomplete="false" value="{{ old('ip') }}">
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Aset</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="APLIKASI" selected>APLIKASI</option>
                        <option value="INFRASTRUKTUR">INFRASTRUKTUR</option>
                        <option value="SDM">SDM</option>
                        <option value="DATA/INFORMASI">DATA/INFORMASI</option>
                    </select>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                <div class="form-group">
                    <label for="user">User PIC*</label>
                    <select name="user" id="user" class="form-control">
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ $u->id == $dataAset->user ? 'selected' : '' }}>
                                {{ $u->name }} - {{ $u->opdRelation->singkatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="singkatan">Nama*</label>
                    <input type="text" value="{{ old('nama',$dataAset->nama) }}" class="form-control" id="nama" name="nama" placeholder="Nama" autocomplete="false" value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                    <label for="url">URL (tanpa https://, tanpa www)</label>
                    <input type="text" value="{{ old('url',$dataAset->url) }}" class="form-control" id="url" name="url" placeholder="URL/Subdomain" autocomplete="false" value="{{ old('url') }}">
                </div>
                <div class="form-group">
                    <label for="ip">IP</label>
                    <input type="text" value="{{ old('ip',$dataAset->ip) }}" class="form-control" id="ip" name="ip" placeholder="IP" autocomplete="false" value="{{ old('ip') }}">
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Aset</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="APLIKASI" {{ $dataAset->jenis == 'APLIKASI' ? 'selected' : '' }}>APLIKASI</option>
                        <option value="INFRASTRUKTUR" {{ $dataAset->jenis == 'INFRASTRUKTUR' ? 'selected' : '' }}>INFRASTRUKTUR</option>
                        <option value="SDM" {{ $dataAset->jenis == 'SDM' ? 'selected' : '' }}>SDM</option>
                        <option value="DATA/INFORMASI" {{ $dataAset->jenis == 'DATA/INFORMASI' ? 'selected' : '' }}>DATA/INFORMASI</option>
                    </select>
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
