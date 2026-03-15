 <?= $this->include('template/login/header') ?>
 <!--end::Head-->
 <!--begin::Body-->

 <body class="login-page bg-body-secondary">
     <div class="login-box">
         <div class="card card-outline card-primary">
             <div class="card-header">
                 <!-- <a
            href="../index2.html"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          > -->
                 <!-- <h1 class="mb-0"><b>Admin</b>Epic Creative</h1> -->
                 <img src="<?= base_url('assets/logo1.png') ?>" alt="Logo" class="img-fluid d-block mx-auto"
                     style="height:60px;">
                 <!-- </a> -->
             </div>
             <div class="card-body login-card-body">
                 <p class="login-box-msg">Sign in </p>
                 <div id="loginAlert" class="alert alert-danger d-none"></div>

                 <form id="loginForm">
                     <div class="input-group mb-1">
                         <div class="form-floating">
                             <input id="username" type="text" name="email" class="form-control" value="" placeholder="" />
                             <label for="username">Email/Username</label>
                         </div>
                         <div class="input-group-text"><span class="bi bi-person"></span></div>
                     </div>
                     <div class="input-group mb-1">
                         <div class="form-floating">
                             <input id="password" name="password" type="password" class="form-control" placeholder="" />
                             <label for="password">Password</label>
                         </div>
                         <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                     </div>
                     <!--begin::Row-->
                     <div class="row">
                         <div class="col-8 d-inline-flex align-items-center">
                             <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="" id="showPassword" />
                                 <label class="form-check-label" for="flexCheckDefault"> Show Password </label>
                             </div>
                         </div>
                         <!-- /.col -->
                         <!-- <div class="col-4">
                             <div class="d-grid gap-2">
                                 <button type="submit" class="btn btn-primary">Sign In</button>
                             </div>
                         </div> -->
                         <!-- /.col -->
                     </div>
                     <!--end::Row-->
                 </form>
                 <div class="social-auth-links text-center mb-3 d-grid gap-2">
                     <!-- <a href="#" class="btn btn-primary">
                         Sign
                     </a> -->
                     <button id="btnLogin" type="button" class="btn btn-primary">

                         <span id="loginText">Sign In</span>

                         <span id="loginSpinner" class="spinner-border spinner-border-sm d-none"></span>

                     </button>

                 </div>
                 <!-- /.social-auth-links -->
                 <p class="mb-1"><a href="<?= base_url('/forgot-password') ?>">I forgot my password</a></p>

             </div>
             <!-- /.login-card-body -->
         </div>
     </div>
     <!-- /.login-box -->
     <!--begin::Third Party Plugin(OverlayScrollbars)-->
     <script
         src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
         crossorigin="anonymous"></script>
     <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
     <script
         src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
         crossorigin="anonymous"></script>
     <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
     <script
         src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
         crossorigin="anonymous"></script>
     <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
     <script src="../js/adminlte.js"></script>
     <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

     <!--end::OverlayScrollbars Configure-->
     <!--end::Script-->
     <?= $this->include('js/login') ?>
 </body>
 <!--end::Body-->

 </html>