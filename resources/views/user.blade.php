<x-layout>
    <style>
        #password-strength-status {
            padding: 5px 10px;
            border-radius: 4px;
            margin-top: 5px;
        }

        .medium-password {
            background-color: #fd0;
        }

        .weak-password {
            background-color: #FBE1E1;
        }

        .strong-password {
            background-color: #D5F9D5;
        }
        </style>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Users</li>
    </x-slot>
    <x-slot name="title">Users</x-slot>
    <x-slot name="card_title"><button class="btn btn-primary" data-toggle="modal" data-target="#modalForm"><i class="fas fa-plus"></i> Tambah</button></x-slot>
    <div class="card-body">
        <table id="dt" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th width="30px">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>OPD</th>
                <th width="150px">Role</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $no=>$data)
            <tr>
                <td align="right">{{ $no+1 }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->opdRelation ? $data->opdRelation->singkatan : '-' }}</td>
                <td>
                    @foreach ($data->roles as $role)
                        {{ $role->name }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </td>
                <td align="center">
                    @if ($data->id !== Auth::id())
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#modalFormEdit-{{ $data->id }}"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('user.hapus', $data->id) }}" method="POST" id="delete-form-{{ $data->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger hapus" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
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
            <form id="modalFormContent" action="{{ route('user.tambah') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="singkatan">Nama Lengkap*</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" autocomplete="false" value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                    <label for="nama">Email*</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="false" value="{{ old('email') }}">
                </div>
                    <!-- Field Password -->
                    <div class="form-group">
                        <label for="password">Password*</label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="password" autocomplete="false" autocomplete="off" onkeyup="checkPasswordStrength();">
                        <div id="password-strength-status"></div>
                    </div>

                <div class="form-group">
                    <label for="opd">OPD</label>
                    <select name="opd_id" id="opd_id" class="form-control">
                        @foreach($opd as $o)
                            <option value="{{ $o->id }}">{{ $o->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="opd" selected>OPD</option>
                        <option value="persandian">Persandian</option>
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

    @foreach ($users as $dataOpd)
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
            <form id="modalFormContentEdit" action="{{ route('user.update',$dataOpd->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">Singkatan*</label>
                    <input type="text" class="form-control" value="{{ old('singkatan',$dataOpd->name) }}" id="singkatan" name="singkatan" placeholder="Singkatan" autocomplete="false">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama*</label>
                    <input type="text" class="form-control" value="{{ old('singkatan',$dataOpd->email) }}" name="nama" id="nama" placeholder="nama" autocomplete="false">

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
        });
      </script>

<script>
function checkPasswordStrength() {
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	var password = $('#password').val().trim();
	if (password.length < 8) {
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('weak-password');
		$('#password-strength-status').html("Lemah (panjangnya minimal 8 karater)");
	} else {
		if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('strong-password');
			$('#password-strength-status').html("Kuat, ini baru password yang baik");
		}
		else {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('medium-password');
			$('#password-strength-status').html("Medium (pastikan ada kombinasi huruf, angka, simbol)");
		}
	}
}
</script>



</x-layout>
