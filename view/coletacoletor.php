<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("C:/xampp/htdocs/ReCiclo/helper/head.php");
    session_start(); ?>
</head>

<body>
    <header id="header" class="fixed-top">
        <?php include("C:/xampp/htdocs/ReCiclo/helper/navbar.php");
        require_once("../model/coleta.php");
        if (!isset($_SESSION['idusuario'])) {
            header("Location: login.php");
        }
        ?>
    </header>
    <?php
    $pedido = new Pedido();
    $pedidos = $pedido->list_all_pedidos();
    ?>
    <main class="container">
        <section id="coleta" class="section ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-8  flex-column align-items-center justify-content-center">

                        <div class="section-title">
                            <span>Pedidos de Coleta em sua Região</span>
                            <h2>Pedidos de Coleta em sua Região</h2>
                            <p>Agende pedidos de coleta solicitados em sua região!<br>
                                Atente-se aos detalhes dos pedidos, solicite e compareça no horário informado!
                            </p>

                        </div>
                        <div class="row">
                            <div class="card">
                                <div class="card-body" style="height: 700px;">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Solicitadas na Região</button>

                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Meus pedidos agendados</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-2" id="borderedTabContent">
                                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="accordion" id="pedidos">
                                                <?php
                                                if (sizeof($pedidos) > 0) {
                                                    $count = 1;

                                                    foreach ($pedidos as $pedido) {
                                                        if ($pedido['status'] == 'solicitada') {

                                                            echo '<div class="accordion-item">';
                                                            echo '<h2 class="accordion-header" id="' . $count . '">';
                                                            echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#t' . $count . '" aria-expanded="true" aria-controls="' . $count . '">';
                                                            echo "Pedido " . $count . " - ID " . $pedido['idpedido_coleta'] . " - " . $pedido['status'];
                                                            echo "<a class='btn'>Agendar</a>";
                                                            echo '</button></h2>';

                                                            echo '<div id="t' . $count . '" class="accordion-collapse collapse " aria-labelledby="' . $count . '" data-bs-parent="#pedidos">';
                                                            echo '<div class="accordion-body">';
                                                            echo '<p class="card-text"> <b>Tipo de Material:</b> ' . $pedido['tipo_material'] . '</p>';
                                                            echo '<p class="card-text"><b>Quantidade:</b> ' . $pedido['quantidade'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação de Contato:</b> ' . $pedido['info_contato'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação de Coleta:</b> ' . $pedido['info_coleta'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação Adicional:</b> ' . $pedido['descricao'] . '</p>';
                                                            echo '<p class="card-text"><b> Tipo de Material:</b> ' . $pedido['tipo_material'] . '</p>';
                                                            echo '<p class="card-text"><b>Quantidade:</b>' . $pedido['quantidade'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação de Contato:</b> ' . $pedido['info_contato'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação de Coleta:</b> ' . $pedido['info_coleta'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação Adicional:</b> ' . $pedido['descricao'] . '</p>';

                                                            echo '</div>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                            $count++;
                                                        }
                                                    }
                                                } else {
                                                    echo '<div class="card">';
                                                    echo '<div class="card-body">';
                                                    echo '<h5 class="card-title">Nenhum pedido de coleta solicitado</h5>';
                                                    echo '<p>Você ainda não tem pedidos em sua região. <br> </p>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }

                                                ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">

                                            <div class="accordion" id="pedidos">
                                                <?php
                                                if (sizeof($pedidos) > 0) {
                                                    $count = 1;

                                                    foreach ($pedidos as $pedido) {
                                                        if ($pedido['status'] == 'agendada') {

                                                            echo '<div class="accordion-item">';
                                                            echo '<h2 class="accordion-header" id="' . $count . '">';
                                                            echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#t' . $count . '" aria-expanded="true" aria-controls="' . $count . '">';
                                                            echo "Pedido " . $count . " - " . $pedido['status'];
                                                            echo '</button></h2>';

                                                            echo '<div id="t' . $count . '" class="accordion-collapse collapse " aria-labelledby="' . $count . '" data-bs-parent="#pedidos">';
                                                            echo '<div class="accordion-body">';
                                                            echo '<p class="card-text"> <b>Tipo de Material:</b> ' . $pedido['tipo_material'] . '</p>';
                                                            echo '<p class="card-text"><b>Quantidade:</b> ' . $pedido['quantidade'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação de Contato:</b> ' . $pedido['info_contato'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação de Coleta:</b> ' . $pedido['info_coleta'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação Adicional:</b> ' . $pedido['descricao'] . '</p>';
                                                            echo '<p class="card-text"><b> Tipo de Material:</b> ' . $pedido['tipo_material'] . '</p>';
                                                            echo '<p class="card-text"><b>Quantidade:</b>' . $pedido['quantidade'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação de Contato:</b> ' . $pedido['info_contato'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação de Coleta:</b> ' . $pedido['info_coleta'] . '</p>';
                                                            echo '<p class="card-text"><b>Informação Adicional:</b> ' . $pedido['descricao'] . '</p>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                            $count++;
                                                        }
                                                    }
                                                } else {
                                                    echo '<div class="card">';
                                                    echo '<div class="card-body">';
                                                    echo '<h5 class="card-title">Nenhum pedido de coleta solicitado</h5>';
                                                    echo '<p>Sem coletas agendadas no momento. Logo um dos Coletores aceitará seu pedido!</p>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>

                                        </div>

                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </section>

    </main>
    <?php include("C:/xampp/htdocs/ReCiclo/helper/footer.php"); ?>
</body>