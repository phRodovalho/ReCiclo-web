<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("C:/xampp/htdocs/ReCiclo/helper/head.php");
    session_start(); ?>
    <!-- Template Main CSS File -->
    <link href="/ReCiclo/view/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <main>
        <div class="container ">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4 ">
                                <h1 class="logo"><a href="index.php">ReCiclo</a></h1>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Fazer Login</h5>
                                        <p class="text-center small">Entre com e-mail e senha</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">E-mail</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Digite seu e-mail.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Senha</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Digite sua senha!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Salvar sessão</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Novo por aqui? <a href="pages-register.html">Criar sua conta ReCiclo</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <div class="copyright">
                                    &copy; Copyright <strong><span>ReCiclo</span></strong>. All Rights Reserved
                                </div>
                                <div class="credits">
                                    Designed by <a href="https://www.linkedin.com/in/phelipe-rodovalho-ufu/">Phelipe R Santos</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="/ReCiclo/view/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/ReCiclo/view/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/ReCiclo/view/assets/vendor/chart.js/chart.min.js"></script>
    <script src="/ReCiclo/view/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/ReCiclo/view/assets/vendor/quill/quill.min.js"></script>
    <script src="/ReCiclo/view/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/ReCiclo/view/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/ReCiclo/view/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/ReCiclo/view/assets/js/login_register.js"></script>

</body>

</html>