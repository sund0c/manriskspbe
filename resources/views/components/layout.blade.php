<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MANRISK KEAMANAN SPBE Pemprov Bali</title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css')}}">
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
  <style>
    .brand-link {
   background: rgb(255, 255, 255);
   // here you can add also a image
}
    /* Gaya kustom untuk link aktif */
    .nav-sidebar .nav-link.active {
        background-color: #ffffff!important; /* Warna latar belakang aktif */
        color: #343a40!important; /* Warna teks aktif */
    }

    /* Gaya untuk ikon dalam link aktif */
    .nav-sidebar .nav-link.active .nav-icon {
        color: #343a40!important; /* Warna ikon aktif */
    }

    .nav-treeview {
    display: none;
    }

    .menu-open .nav-treeview {
        display: block;
    }

    .fixed-size-button {
        width: 40px;  /* Lebar tombol */
        height: 30px; /* Tinggi tombol */
        display: flex; /* Memastikan ikon di tengah */
        align-items: center; /* Vertikal tengah */
        justify-content: center; /* Horizontal tengah */
        padding: 0; /* Menghapus padding default */
    }
</style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function(){
            // Mengikat event pada tombol hapus dengan class "hapus"
            $(document).on('click', '.hapus', function(e){
                e.preventDefault();  // Mencegah aksi default (submit) dari tombol
                var id = $(this).data('id');  // Mendapatkan ID data yang akan dihapus
                var form = $('#delete-form-' + id);  // Mendapatkan form yang sesuai dengan ID

                Swal.fire({
                    title: "Hapus ?",
                    text: "Data yang terhapus tidak bisa dikembalikan lagi",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();  // Submit form setelah konfirmasi
                    }
                });
            });
        });
    </script>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            {{ Auth::user()->name }} ({{ Auth::user()->getRoleNames()->first() }})
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>
          <div class="dropdown-divider"></div>

<!-- Authentication -->
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-dropdown-link>
</form>

        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/img/logomanrisk1.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    </a> --}}
    <a href="#" class="brand-link logo-switch">
        <img src="{{ asset('assets/img/manriskspbepemprovbali1.png')}}" alt="manrisk spbe" class="brand-image-xl logo-xs">
        <img src="{{ asset('assets/img/logomanrisk1.png')}}" alt="manrisk spbe" class="brand-image-xs logo-xl">
      </a>

    <!-- Sidebar -->
    <div class="sidebar">
      @include('components.navigation')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{ $title ?? 'Blank Page' }}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                {{ $breadcrumb ?? 'breadcrumb' }}
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ $card_title ?? 'Card Title'}}</h3>
            </div>
            {{ $slot }}
          </div>
        </section>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
   @include('components.footer')
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
{{-- <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


<!-- Script SweetAlert -->
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "OK"
        });
    });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({
        title: "Gagal!",
        text: "{{!! session('error') !!}}",
        icon: "error",
        confirmButtonText: "OK"
    });
</script>
@endif
@if(session('validasi'))
<script>
     document.addEventListener('DOMContentLoaded', function() {
     Swal.fire({
         title: "Validasi Gagal!",
         html: `{!! session('validasi') !!}`,
         icon: "error",
         confirmButtonText: "OK"
     });
});
</script>
@endif



<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>



<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js')}}"></script>




</body>
</html>

