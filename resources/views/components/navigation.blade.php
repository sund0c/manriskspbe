<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="far fa-home nav-icon"></i><p>Home</p>
            </a>
            </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Master Data
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-danger right">...</span>
            </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link">
              <i class="far fa-users nav-icon"></i>
              <p>Users</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{ route('riskregister.index') }}" class="nav-link">
            <i class="far fa-list nav-icon"></i><p>Risk Register</p>
            <span class="badge badge-danger right">...</span>

        </a>
        </li>

        </ul>
      </li>

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
