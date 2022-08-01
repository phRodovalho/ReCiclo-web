<?php
session_start();
require_once("../model/coleta.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_input(INPUT_POST, "pedidoOp") == 1) { //insert
        $materiais = $_POST['material'];
        $material = " ";
        foreach ($materiais as $m) {
            $material .= $m . " ";
        }
        $material;
        $quantidade = filter_input(INPUT_POST, "quantidade");
        $horario = filter_input(INPUT_POST, "horario");
        $data = filter_input(INPUT_POST, "data");
        $telefone = filter_input(INPUT_POST, "telefone");
        $foto = filter_input(INPUT_POST, "foto");
        $descricao = filter_input(INPUT_POST, "descricao");
        $local = filter_input(INPUT_POST, "local");

        if (isset($material) && isset($quantidade) && isset($horario) && isset($data) && isset($telefone) && isset($descricao)) {
            $pedido = new Pedido();
            $pedido->set_nome($_SESSION['nameUser']);
            $pedido->set_tipo_material($material);
            $pedido->set_quantidade($quantidade);
            $pedido->set_midia($foto);
            $pedido->set_info_contato("Telefone: " . $telefone . "<br> E-mail: " . $_SESSION['email']);
            $pedido->set_info_coleta("Horario: " . $horario . "<br> Data: " . $data . "<br> Endereço: " . $local);
            $pedido->set_descricao($descricao);
            $pedido->set_userId($_SESSION['idusuario']);

            //insert
            $isrpedido = $pedido->insert_pedido($pedido->get_nome(), $pedido->get_tipo_material(), $pedido->get_quantidade(), $pedido->get_midia(), $pedido->get_info_contato(), $pedido->get_info_coleta(), $pedido->get_descricao(), $pedido->get_userId());

            if ($isrpedido == true) {
                echo "<script type='text/javascript'>window.location.href = '../view/coleta.php';</script></script>";
            } else echo "<script type='text/javascript'>alert('ERRO de cadastro na Coleta');window.location.href = '../view/coleta.php';</script></script>";
        } else echo "<script type='text/javascript'>alert('Preencha todos os campos!');window.location.href = '../view/coleta.php';</script></script>";
    } else if (filter_input(INPUT_POST, "pedidoOp") == 2) { //update


    } else if (filter_input(INPUT_POST, "pedidoOp") == 3) { //delete


    }
}
