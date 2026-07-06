<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Login SMAN 8 Bandung </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/vendor.css">
        <!-- Theme initialization -->
        	<link rel="stylesheet" id="theme-style" href="<?php echo base_url(); ?>css/app.css">
		<link rel="stylesheet" id="theme-style" href="<?php echo base_url(); ?>css/app-blue.css">
    </head>

    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
            APLIKASI SANKSI DAN PELANGGARAN
      </h1> </header>
                    <div class="auth-content">
                        <p class="text-xs-center">LOGIN</p>
                        <form id="login-form" action="<?php echo site_url(); ?>/login/validasiLogin" method="POST" novalidate="">
                            <div class="form-group"> <label for="username">Username</label> <input type="text" class="form-control underlined" name="username" id="username" placeholder="Masukan Username" required> </div>
                            <div class="form-group"> <label for="password">Password</label> <input type="password" class="form-control underlined" name="password" id="password" placeholder="password" required> </div>
                            <div class="form-group"> <label for="remember">
            <input class="checkbox" id="remember" type="checkbox"> 
            <span>Remember me</span>
          </label> </div>
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary">Login</button> </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>js/vendor.js"></script>
        <script src="<?php echo base_url(); ?>js/app.js"></script>
    </body>

</html>