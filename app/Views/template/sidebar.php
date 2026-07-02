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
    <?php if (has_role('superadmin')): ?>

      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview">

            <!-- Dashboard -->
            <li class="nav-item">
              <a href="<?= base_url('/') ?>"
                class="nav-link <?= is_dashboard() ?>">
                <i class="nav-icon bi bi-house"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <!-- User -->
            <li class="nav-item">
              <a href="<?= base_url('user') ?>"
                class="nav-link <?= is_active('user') ?>">
                <i class="nav-icon bi bi-people"></i>
                <p>User</p>
              </a>
            </li>

            <!-- Client -->
            <li class="nav-item">
              <a href="<?= base_url('client') ?>"
                class="nav-link <?= is_active('client') ?>">
                <i class="nav-icon bi bi-buildings"></i>
                <p>Client</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('banner') ?>"
                class="nav-link <?= is_active('banner') ?>">
                <i class="nav-icon bi bi-images"></i>
                <p>Banner</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('portfolio-behind-scenes') ?>"
                class="nav-link <?= is_active('portfolio-behind-sceness') ?>">
                <i class="nav-icon bi bi-youtube"></i>
                <p>Behind The Scenes</p>
              </a>
            </li>

            <!-- Language -->
            <li class="nav-item">
              <a href="<?= base_url('language') ?>"
                class="nav-link <?= is_active('language') ?>">
                <i class="nav-icon bi bi-globe"></i>
                <p>Language</p>
              </a>
            </li>

            <!-- 🇮🇩 Indonesian -->
            <li class="nav-item <?= (current_page() == 'service' && current_lang() == 'id') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link">
                <img src="https://flagcdn.com/w20/id.png" style="width:20px; margin-right:8px;">
                <p>Indonesian Language <i class="nav-arrow bi bi-chevron-right"></i></p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('portfolio-category/id') ?>"
                    class="nav-link <?= is_active('portfolio-category', 'id') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('service/id') ?>"
                    class="nav-link <?= is_active('service', 'id') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('subservice/id') ?>"
                    class="nav-link <?= is_active('subservice', 'id') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Sub Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('about/id') ?>"
                    class="nav-link <?= is_active('about', 'id') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>About Us</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?= base_url('portfolio/id') ?>"
                    class="nav-link <?= is_active('portfolio', 'id') ?>">
                    <i class="nav-icon bi bi-youtube"></i>
                    <p>Portfolio</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- 🇺🇸 English -->
            <li class="nav-item <?= (current_page() == 'service' && current_lang() == 'en') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link">
                <img src="https://flagcdn.com/w20/us.png" style="width:20px; margin-right:8px;">
                <p>English Language <i class="nav-arrow bi bi-chevron-right"></i></p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('portfolio-category/en') ?>"
                    class="nav-link <?= is_active('portfolio-category', 'en') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Category</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="<?= base_url('service/en') ?>"
                    class="nav-link <?= is_active('service', 'en') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('subservice/en') ?>"
                    class="nav-link <?= is_active('subservice', 'en') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Sub Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('about/en') ?>"
                    class="nav-link <?= is_active('about', 'en') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>About Us</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?= base_url('portfolio/en') ?>"
                    class="nav-link <?= is_active('portfolio', 'en') ?>">
                    <i class="nav-icon bi bi-youtube"></i>
                    <p>Portfolio</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
      </div>
    <?php else : ?>
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview">

            <!-- Dashboard -->
            <li class="nav-item">
              <a href="<?= base_url('/') ?>"
                class="nav-link <?= is_dashboard() ?>">
                <i class="nav-icon bi bi-house"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <!-- User -->
            

            <!-- Client -->
            <li class="nav-item">
              <a href="<?= base_url('client') ?>"
                class="nav-link <?= is_active('client') ?>">
                <i class="nav-icon bi bi-buildings"></i>
                <p>Client</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('client') ?>"
                class="nav-link <?= is_active('client') ?>">
                <i class="nav-icon bi bi-images"></i>
                <p>Banner</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('portfolio-behind-scenes') ?>"
                class="nav-link <?= is_active('portfolio-behind-scenes') ?>">
                <i class="nav-icon bi bi-youtube"></i>
                <p>Behind The Scenes</p>
              </a>
            </li>

            <!-- Language -->
            <li class="nav-item">
              <a href="<?= base_url('language') ?>"
                class="nav-link <?= is_active('language') ?>">
                <i class="nav-icon bi bi-globe"></i>
                <p>Language</p>
              </a>
            </li>

            <!-- 🇮🇩 Indonesian -->
            <li class="nav-item <?= (current_page() == 'service' && current_lang() == 'id') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link">
                <img src="https://flagcdn.com/w20/id.png" style="width:20px; margin-right:8px;">
                <p>Indonesian Language <i class="nav-arrow bi bi-chevron-right"></i></p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('service/id') ?>"
                    class="nav-link <?= is_active('service', 'id') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('subservice/id') ?>"
                    class="nav-link <?= is_active('subservice', 'id') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Sub Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('about/id') ?>"
                    class="nav-link <?= is_active('about', 'id') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>About Us</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?= base_url('portfolio/id') ?>"
                    class="nav-link <?= is_active('portfolio', 'id') ?>">
                    <i class="nav-icon bi bi-youtube"></i>
                    <p>Portfolio</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- 🇺🇸 English -->
            <li class="nav-item <?= (current_page() == 'service' && current_lang() == 'en') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link">
                <img src="https://flagcdn.com/w20/us.png" style="width:20px; margin-right:8px;">
                <p>English Language <i class="nav-arrow bi bi-chevron-right"></i></p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('service/en') ?>"
                    class="nav-link <?= is_active('service', 'en') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('subservice/en') ?>"
                    class="nav-link <?= is_active('subservice', 'en') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Sub Service</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('about/en') ?>"
                    class="nav-link <?= is_active('about', 'en') ?>">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>About Us</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?= base_url('portfolio/en') ?>"
                    class="nav-link <?= is_active('portfolio', 'en') ?>">
                    <i class="nav-icon bi bi-youtube"></i>
                    <p>Portfolio</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
      </div>
    <?php endif; ?>
    <!--end::Sidebar Wrapper-->
  </aside>