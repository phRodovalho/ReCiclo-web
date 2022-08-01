<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("C:/xampp/htdocs/ReCiclo/helper/head.php");
    session_start();
    if (!isset($_SESSION['idusuario'])) {
        header("Location: login.php");
    }
    ?>
</head>

<body>
    <header id="header" class="fixed-top">
        <?php include("C:/xampp/htdocs/ReCiclo/helper/navbar.php"); ?>
    </header>
    <main id="main">
        <section id="calculadora" class="calculadora">
            <div class="container">
                <div class="section-title">
                    <span>Calculadora de impacto positivo</span>
                    <h2>Calculadora de impacto positivo</h2>
                    <p>Insira a quantidade aproximada dos materiais reciclados e veja o quanto ajudou o planeta...</p>
                    <p><b>Informe o peso aproximado dos materiais que você reciclou. Depois é só compartilhar o resultado com seus amigos!</b></p>
                </div>
                <!-- Form Calculadora to inform how much recicle and show stats of planet!-->
                <form action="calculadora.php" method="post">
                    <div class="row" style="margin-top:20px;">
                        <!-- Input number of kilos the 'Papel e Papelão' and 'Vidro' and 'Alumínio' and 'Outros Metais' and 'Plástico' -->
                        <div class="form-group col-md-2">
                            <label for="papel">Papel e Papelão</label>
                            <input type="number" class="form-control" id="papel" name="papel" placeholder="Kilos" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="plastico">Plástico</label>
                            <input type="number" class="form-control" id="plastico" name="plastico" placeholder="Kilos" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="vidro">Vidro</label>
                            <input type="number" class="form-control" id="vidro" name="vidro" placeholder="Kilos" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="aluminio">Alumínio</label>
                            <input type="number" class="form-control" id="aluminio" name="aluminio" placeholder="Kilos" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="outros">Outros Metais</label>
                            <input type="number" class="form-control" id="outros" name="outros" placeholder="Kilos" required>
                        </div>
                    </div>

                    <div class="row" style="margin-top:30px;">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Calcular</button>
                        </div>
                    </div>
                </form>

                <!-- Show graphics and stats of 'Energia' 'Agua' -->
                <?php
                if (isset($_POST['papel']) && isset($_POST['plastico']) && isset($_POST['vidro']) && isset($_POST['aluminio']) && isset($_POST['outros'])) {
                    $papel = $_POST['papel'];
                    $plastico = $_POST['plastico'];
                    $vidro = $_POST['vidro'];
                    $aluminio = $_POST['aluminio'];
                    $outros = $_POST['outros'];
                    $total = $papel + $plastico + $vidro + $aluminio + $outros;
                    $energia = $total * 0.8;
                    $agua = $total * 0.8;
                    $resultado = "Você reciclou $total kilos de materiais e gerou $energia KWh de energia e $agua litros de água.";
                    echo "<div class='row'>
                            <div class='col-lg-12'>
                                <h3>$resultado</h3>
                            </div>
                        </div>";
                }
                ?>

            </div>

        </section>

    </main>
    <?php include("C:/xampp/htdocs/ReCiclo/helper/footer.php"); ?>
</body>