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
                 <p class="login-box-msg">Reset Password</p>
                 <div id="loginAlert" class="alert alert-danger d-none"></div>

                 <!-- <form id="loginForm"> -->
                 <input
                     type="hidden"
                     id="token"
                     value="<?= $token ?>">
                 <!-- <div class="input-group mb-1">
                     <div class="form-floating">
                     </div>
                     <div class="input-group-text"><span class="bi bi-person"></span></div>
                 </div> -->

                 <div class="input-group mb-1">
                     <div class="form-floating">
                         <input id="password" name="password" type="password" class="form-control" placeholder="" />
                         <label for="password">Password</label>
                     </div>
                     <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                 </div>




                 <!--begin::Row-->

                 <!--end::Row-->
                 <!-- </form> -->
                 <div class="social-auth-links text-center mb-3 d-grid gap-2">
                     <!-- <a href="#" class="btn btn-primary">
                         Sign
                     </a> -->
                     <button
                         class="btn btn-primary w-100"
                         id="btnChangePassword">

                         Reset Password

                     </button>
                 </div>
                 <!-- /.social-auth-links -->
                 <div class="text-center mt-3">
                     <a href="<?= base_url('login') ?>">Back to login</a>
                 </div>

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
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

     <!--end::OverlayScrollbars Configure-->
     <!--end::Script-->
     <script>
         toastr.options = {
             "closeButton": true,
             "progressBar": true,
             "positionClass": "toast-top-right",
             "timeOut": "3000"
         };
     </script>
     <?= $this->include('js/resetPassword') ?>
 </body>
 <!--end::Body-->

 </html>