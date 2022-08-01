<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("C:/xampp/htdocs/ReCiclo/helper/head.php");
    session_start(); ?>
</head>

<body>
    <header id="header" class="fixed-top">
        <?php include("C:/xampp/htdocs/ReCiclo/helper/navbar.php"); ?>
    </header>
    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <div class="section-title">
                    <span>Sobre nós</span>
                    <h2>Sobre nós</h2>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <img src="assets/img/about.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                        <h3>Ajudando o planeta, conscientizando e disseminando a Coleta Seletiva...</h3>
                        <p class="fst-italic">
                            Diariamente produzimos diversos tipos de resíduos,
                            que quando não são descartados da maneira correta, geram impacto socioambiental.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i>
                                A reciclagem e o reaproveitamento são uma das respostas para diminuir o impacto da poluição no meio ambiente.
                            </li>
                            <li><i class="bi bi-check-circle"></i>
                                Visando facilitar e promover a coleta seletiva, o ReCiclo é um sistema web que otimiza o processo de coleta de resíduos.
                            </li>
                            <li><i class="bi bi-check-circle"></i>
                                Aproximando pessoas que desejam fazer o descarte de materiais e coletores que fazem o aproveitamento dos mesmos.
                            </li>
                        </ul>
                        <p>
                            Crie um perfil de Cliente/Colaborador e abra Pedidos de Coleta para que os colaboradores possam realizar a coleta de resíduos em sua casa.
                        </p>
                        <p>
                            Ou, Crie um perfil de Coletor para que possa visualizar os Pedidos de Coleta próximos a sua região facilitando o trabalho do dia-a-dia.
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

    </main>
    <?php include("C:/xampp/htdocs/ReCiclo/helper/footer.php"); ?>
</body>