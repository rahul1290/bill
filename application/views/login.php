<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from yetiadmin.yetithemes.net/demo/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Feb 2022 04:47:08 GMT -->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

   <title>Login - <?php echo $this->config->item('project_name'); ?></title>


  <!-- Generics -->
  <link rel="icon" href="<?= base_url(); ?>assets/images/favicon/favicon-32.png" sizes="32x32">
  <link rel="icon" href="<?= base_url(); ?>assets/images/favicon/favicon-128.png" sizes="128x128">
  <link rel="icon" href="<?= base_url(); ?>assets/images/favicon/favicon-192.png" sizes="192x192">

  <!-- Android -->
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon/favicon-196.png" sizes="196x196">

  <!-- iOS -->
  <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/images/favicon/favicon-152.png" sizes="152x152">
  <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/images/favicon/favicon-167.png" sizes="167x167">
  <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/images/favicon/favicon-180.png" sizes="180x180">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css" />
</head>

<body>
    <section class="top-bar">
        <span class="brand"><?php echo $this->config->item('project_name'); ?></span>

        <nav class="flex items-center ltr:ml-auto rtl:mr-auto">

            <!-- Dark Mode -->
            <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
                <input id="darkModeToggler" type="checkbox">
                <span></span>
            </label>

            <!-- Fullscreen -->
            <button id="fullScreenToggler" type="button"
                class="hidden lg:inline-block btn-link ltr:ml-5 rtl:mr-5 text-2xl leading-none la la-expand-arrows-alt"
                data-toggle="tooltip" data-tippy-content="Fullscreen"></button>
        </nav>
    </section>

    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">It’s Great To See You!</h2>
                <h4 class="uppercase">Login Here</h4>
            </div>
            <form name="f1" class="card mt-5 p-5 md:p-10" method="POST" action="<?php echo base_url()?>Auth_ctrl/login">
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Email</label>
                    <input id="email" name="identity" type="text" class="form-control" placeholder="example@example.com">
                    <?php echo form_error('identity'); ?>
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password">Password</label>
                    <label class="form-control-addon-within">
                        <input id="password" name="password" type="password" class="form-control border-none" value="">
                        <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button"
                                class="btn btn-link text-gray-600 dark:text-gray-600 la la-eye text-xl leading-none"
                                data-toggle="password-visibility"></button>
                        </span>
                    </label>
                    <?php echo form_error('password'); ?>
                </div>
                <div class="flex items-center">
                    <a href="#" class="text-sm uppercase">Forgot Password?</a>
                    <button type="submit" class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url(); ?>assets/js/vendor.js"></script>
    <script src="<?= base_url(); ?>assets/js/script.js"></script>

</body>
</html>
