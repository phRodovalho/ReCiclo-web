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
        } else if ($_SESSION['usertype'] == 'coletor') {
            header("Location: coletacoletor.php");
        }
        ?>
    </header>
    <?php
    $pedido = new Pedido();
    $pedidos = $pedido->list_pedidos($_SESSION['idusuario']);
    ?>

    <main class="container">
        <section id="coleta" class="section ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-8  flex-column align-items-center justify-content-center">

                        <div class="section-title">
                            <span>Pedido de Coleta</span>
                            <h2>Pedido de Coleta</h2>
                            <p>Tem material para descartar?<br>
                                Abra um novo pedido de coleta e solicite o serviço de um catador ou catadora!
                            </p>

                        </div>
                        <div class="row">
                            <div class="card">
                                <div class="card-body" style="height: 700px;">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Solicitadas</button>

                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Agendadas</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Nova Coleta</button>
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
                                                    echo '<p>Você ainda não tem pedidos. <br> Que tal solicitar uma coleta na aba <b>"Nova Coleta".</b></p>';
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
                                        <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">

                                            <!-- Form to Pedido de Coleta, set Material, local e melhor horário !-->
                                            <form class="row needs-validation" action="../controller/ControllerColeta.php" method="post">

                                                <div class="row" style="margin-top:20px;">
                                                    <label class="form-label" for="material">Material</label>
                                                    <!-- Check box to select material recicle -->
                                                    <div class="form-check col-2">
                                                        <input class="form-check-input" type="checkbox" value="Papel " name="material[]" id="material1">
                                                        <label class="form-check-label" for="material1">Papel</label>
                                                    </div>
                                                    <div class="form-check col-2">
                                                        <input class="form-check-input" type="checkbox" value="Plastico " name="material[]" id="material2">
                                                        <label class="form-check-label" for="material2">Plastico</label>
                                                    </div>
                                                    <div class="form-check col-2">
                                                        <input class="form-check-input" type="checkbox" value="Vidro " name="material[]" id="material3">
                                                        <label class="form-check-label" for="material3">Vidro</label>
                                                    </div>
                                                    <div class="form-check col-2">
                                                        <input class="form-check-input" type="checkbox" value="Metal " name="material[]" id="material4">
                                                        <label class="form-check-label" for="material4">Metal</label>
                                                    </div>
                                                    <div class="form-check col-2">
                                                        <input class="form-check-input" type="checkbox" value="Outro " name="material[]" id="material5">
                                                        <label class="form-check-label" for="material5">Outro</label>
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top:20px;">
                                                    <div class="col-4">
                                                        <label class="form-label" for="quantidade">Quantidade: </label>
                                                        <input class="form-input" placeholder="Kilos" type="text" name="quantidade" id="quantidade">
                                                    </div>

                                                    <div class="col-4">
                                                        <label class="form-label" for="horario">Melhor Horário: </label>
                                                        <select id="horario" name="horario" class="form-control">
                                                            <option value="manha">Manhã</option>
                                                            <option value="tarde">Tarde</option>
                                                            <option value="noite">Noite</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label" for="data">Data</label>
                                                        <input type="date" class="form-control" id="data" name="data" placeholder="Data">
                                                    </div>

                                                </div>
                                                <div class="row" style="margin-top:20px;">
                                                    <div class="col-6">
                                                        <label class="form-label" for="telefone">Telefone </label>
                                                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="form-label" for="foto">Foto </label>
                                                        <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto">
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top:20px;">
                                                    <div class="col-12">
                                                        <label for="local">Local</label>
                                                        <select id="local" name="local" class="form-control">
                                                            <option value="1">Casa</option>
                                                            <option value="2">Trabalho</option>
                                                            <option value="3">Escola</option>
                                                            <option value="4">Outros</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top:20px;">
                                                    <div class="col-12">
                                                        <label for="descricao">Informação adicional</label>
                                                        <textarea class="form-control" id="descricao" name="descricao" placeholder="Escreva alguma informação adicional se achar necessário" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top:30px;">
                                                    <div class="col-12">
                                                        <input type="hidden" name="pedidoOp" value="1">
                                                        <button type="submit" class="btn btn-primary">Solicitar Coleta</button>
                                                    </div>
                                                </div>

                                            </form>

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