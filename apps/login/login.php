<?php
defined('APPS') OR exit('No direct script access allowed');
// echo password_hash(123456, PASSWORD_DEFAULT);
// exit();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php lang("Login");?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: 0.75rem;
        }

        .login,
        .image {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('assets/img/59516.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-heading {
            font-weight: 300;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
            border-radius: 2rem;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group>input,
        .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
            height: auto;
            border-radius: 2rem;
        }

        .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            cursor: text;
            /* Match the input under the label */
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }

        /* Fallback for Edge
-------------------------------------------------- */

        @supports (-ms-ime-align: auto) {
            .form-label-group>label {
                display: none;
            }

            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
        }

        /* Fallback for IE
-------------------------------------------------- */

        @media all and (-ms-high-contrast: none),
        (-ms-high-contrast: active) {
            .form-label-group>label {
                display: none;
            }

            .form-label-group input:-ms-input-placeholder {
                color: #777;
            }
        }
    </style>
</head>

<body cz-shortcut-listen="true" style="">


    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                            <div class="card">
                            <div class="card-body">
                            <?php if(isset($_SESSION["STATUS"]) && $_SESSION["STATUS"] === FALSE){?>
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION["MSG"];?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            <?php unset($_SESSION["STATUS"],$_SESSION["MSG"]);} ?>
                                <h3 class="login-heading mb-4"><?php lang("Welcome");?></h3>
                                <form action="apps/login/do_login.php?action=check_login" method="post" autocomplete="off">
                                    <div class="form-label-group">
                                        <input type="text" id="user" name="user" class="form-control" placeholder="<?php lang("Username");?>" required="" autofocus="">
                                        <label for="user"><?php lang("Username");?></label>
                                    </div>

                                    <div class="form-label-group">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="<?php lang("Password");?>" required="">
                                        <label for="password"><?php lang("Password");?></label>
                                    </div>
                                    <div class="form-label-group float-right">
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php
                                                if(isset($_SESSION["LANGUAGE"]) && $_SESSION["LANGUAGE"] == "th"){
                                            ?>
                                                <img src="assets/img/th.png" class="img-fluid" style="width:24px" alt="">
                                            <?php }elseif(isset($_SESSION["LANGUAGE"]) && $_SESSION["LANGUAGE"] == "en"  || !isset($_SESSION["LANGUAGE"])){ ?>
                                                <img src="assets/img/en.png" class="img-fluid" style="width:24px" alt="">
                                            <?php } ?>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="lang.php?lang=th" class="dropdown-item">
                                                    <img src="assets/img/th.png" class="img-fluid" style="width:24px" alt="">
                                                    <span class=" text-muted text-sm"> <?php lang("Thailand");?></span>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="lang.php?lang=en" class="dropdown-item">
                                                    <img src="assets/img/en.png" class="img-fluid" style="width:24px" alt="">
                                                    <span class="text-muted text-sm"> <?php lang("English");?></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit"><?php lang("Login");?></button>
                                </form>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    window.setTimeout(function () {
      $(".alert").fadeTo(700, 0).slideUp(1000, function () {
        $(this).remove()
      })
    }, 2e3);

  </script>

</body>

</html>
