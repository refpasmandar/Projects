<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <script type="text/javascript">
    window.history.forward();
    </script> -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Judul dan Logo pada Menu Bar -->
    <title>RAHAYU BERKAH</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/logo.png">

    <!-- Memanggil CSS -->
    <link href="<?php echo base_url() ?>assets/css/login.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Memanggil Font Kustom -->
    <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<body class="login bg-primary">
    <div class="container box-login">
        <!-- Box Login -->
        <div class="row ">
            <div class="col-xl-12">
                <div class="card card-block d-flex o-hidden border-0 shadow-lg">
                    <div class="card-body p-0 login-inner">
                        <!-- Bagian Dalam Box Login -->
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">MASUK ADMIN <br>
                                            PT. CAHAYA BUANA LESTARI
                                        </h1>
                                    </div>
                                    <!-- Form Login -->
                                    <?php echo $this->session->flashdata('pesan') ?>
                                    <form action="<?php echo base_url('auth/processlogin') ?>" method="post" class="user">
                                        <!-- Username -->
                                        <div class="form-group">
                                            <label for="">Nama Pengguna</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control fa fa-user" id="username" name="username" placeholder="Masukkan Nama Pengguna..">
                                            </div>
                                            <?php echo form_error('username') ?>
                                        </div>
                                        <!-- Kata Sandi -->
                                        <div class="form-group">
                                            <label for="">Kata Sandi</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-unlock"></i>
                                                    </div>
                                                </div>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Kata Sandi..">
                                            </div>
                                            <?php echo form_error('password') ?>
                                        </div>
                                        <!-- Pilihan Di Dalam Box Login -->
                                        <div class="form-group">
                                        </div>
                                        <button type="submit" name="login" class="btn rounded btn-primary btn-block">Masuk!</button>
                                        <button type="reset" class="btn btn-block rounded btn-danger">Ulang?</button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Memanggil Bootstrap Javascript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Memanggil Jquery-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>