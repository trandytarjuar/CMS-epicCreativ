<!--begin::App Wrapper-->
<div class="app-wrapper">
  <!--begin::Header-->
  <nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Start Navbar Links-->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list"></i>
          </a>
        </li>
      </ul>
      <!--end::Start Navbar Links-->
      <!--begin::End Navbar Links-->
      <?= $this->include('template/navbar') ?>
      <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
  </nav>
  <!--end::Header-->
  <!--begin::Sidebar-->
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="./index.html" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="<?= base_url('assets/logo1.png') ?>"
          alt="AdminLTE Logo"
          class="brand-image opacity-75 shadow" />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">Epic Creative</span>
        <!--end::Brand Text-->
      </a>

      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <?php if (session()->get('role') == "superadmin") : ?>
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <!--begin::Sidebar Menu-->
          <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="navigation"
            aria-label="Main navigation"
            data-accordion="false"
            id="navigation">
            <li class="nav-item menu-open">

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('/') ?>" class="nav-link active">
                    <i class="nav-icon bi bi-house"></i>
                    <p>Dashboard</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item menu-open">

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('/user') ?>" class="nav-link active">
                    <i class="nav-icon bi bi-people"></i>
                    <p>User</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item menu-open">

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('client') ?>" class="nav-link active">
                    <i class="nav-icon bi bi-buildings"></i>
                    <p>Client</p>
                  </a>
                </li>

              </ul>
            </li>



            <li class="nav-item menu-open">
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('language') ?>" class="nav-link active">
                    <i class="nav-icon bi bi-globe"></i>
                    <p>Language</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="https://flagcdn.com/w20/id.png"
                  style="width:20px; margin-right:8px;">
                <p>
                  Indonesian Language
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./widgets/small-box.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./widgets/info-box.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>About Us</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('portfolio') ?>" class="nav-link">
                    <i class="nav-icon bi bi-youtube"></i>
                    <p>Portfolio</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="https://flagcdn.com/w20/us.png"
                  style="width:20px; margin-right:8px;">
                <p>
                  English Language
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./layout/unfixed-sidebar.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./layout/fixed-sidebar.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>About Us</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./layout/fixed-header.html" class="nav-link">
                    <i class="nav-icon bi bi-youtube"></i>
                    <p>portfolio</p>
                  </a>
                </li>

              </ul>
            </li>
          </ul>
          <!--end::Sidebar Menu-->
        </nav>
      </div>
    <?php else : ?>
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <!--begin::Sidebar Menu-->
          <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="navigation"
            aria-label="Main navigation"
            data-accordion="false"
            id="navigation">
            <li class="nav-item menu-open">

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('/') ?>" class="nav-link active">
                    <i class="nav-icon bi bi-house"></i>
                    <p>Dashboard</p>
                  </a>
                </li>

              </ul>
            </li>
            
            <li class="nav-item menu-open">

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('client') ?>" class="nav-link active">
                    <i class="nav-icon bi bi-buildings"></i>
                    <p>Client</p>
                  </a>
                </li>

              </ul>
            </li>



            

            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="https://flagcdn.com/w20/id.png"
                  style="width:20px; margin-right:8px;">
                <p>
                  Indonesian Language
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./widgets/small-box.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./widgets/info-box.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>About Us</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('portfolio') ?>" class="nav-link">
                    <i class="nav-icon bi bi-youtube"></i>
                    <p>Portfolio</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="https://flagcdn.com/w20/us.png"
                  style="width:20px; margin-right:8px;">
                <p>
                  English Language
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./layout/unfixed-sidebar.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./layout/fixed-sidebar.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>About Us</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./layout/fixed-header.html" class="nav-link">
                    <i class="nav-icon bi bi-youtube"></i>
                    <p>portfolio</p>
                  </a>
                </li>

              </ul>
            </li>
          </ul>
          <!--end::Sidebar Menu-->
        </nav>
      </div>
    <?php endif; ?>
    <!--end::Sidebar Wrapper-->
  </aside>