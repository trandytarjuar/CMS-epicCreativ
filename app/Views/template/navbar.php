<ul class="navbar-nav ms-auto">

  <!--begin::Fullscreen Toggle-->

  <!--end::Fullscreen Toggle-->
  <!--begin::User Menu Dropdown-->
  <li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
      <img
        src="<?= session('image')
                  ? base_url('image/user/' . session('image'))
                  : base_url('image/user/default.png') ?>"
        class="user-image rounded-circle shadow"
        alt="User Image" />
      <!-- nama user -->
      <span class="d-none d-md-inline"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
      <!--begin::User Image-->
      <li class="user-header text-bg-primary">
        <img
          src="<?= session('image')
                  ? base_url('image/user/' . session('image'))
                  : base_url('image/user/default.png') ?>"
          class="rounded-circle shadow"
          alt="User Image" />
        <p>
          <?= session()->get('name') ?> - <?= session()->get('role') ?>
        </p>
      </li>
      <!--end::User Image-->
      <!--begin::Menu Body-->

      <!--end::Menu Body-->
      <!--begin::Menu Footer-->
      <li class="user-footer">
        <a href="<?= base_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
        <a href="<?= base_url('logout') ?>" class="btn btn-default btn-flat float-end">Sign out</a>
      </li>
      <!--end::Menu Footer-->
    </ul>
  </li>
  <!--end::User Menu Dropdown-->
</ul>