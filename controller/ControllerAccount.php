<?php
session_start();

require_once("../model/user.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_input(INPUT_POST, "userOp") == 1) { //insert

        //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - User

        $nome = filter_input(INPUT_POST, "txtname");
        $email = filter_input(INPUT_POST, "txtemail");
        $cpfcnpj = filter_input(INPUT_POST, "txtcpfcnpj");
        $telefone = filter_input(INPUT_POST, "txtphone");
        $data_nascimento = filter_input(INPUT_POST, "txtdate");
        $senha = filter_input(INPUT_POST, "password");
        $confirsenha = filter_input(INPUT_POST, "confirpassword");
        $usertype = filter_input(INPUT_POST, "optuser");
        $descricao = filter_input(INPUT_POST, "txtdescricao");

        $cep = filter_input(INPUT_POST, "txtcep");
        $logradouro = filter_input(INPUT_POST, "txtadress");
        $numero = filter_input(INPUT_POST, "txtnumberadress");
        $complemento = filter_input(INPUT_POST, "txtcomplement");
        $bairro = filter_input(INPUT_POST, "txtbairro");
        $cidade = filter_input(INPUT_POST, "txtcity");
        $estado = filter_input(INPUT_POST, "txtstate");

        // verifico se as variaveis estão vazias
        if (isset($nome) && isset($email) && isset($cpfcnpj) && isset($senha)) {

            //pt-br inserindo valores do formulário para o obj user
            //todo: criar classe user e inserir valores no banco de dados 
            $user = new User();
            $user->set_name($nome);
            $user->set_data_nascimento($data_nascimento);
            $user->set_email($email);
            $user->set_telefone($telefone);
            $user->set_senha($senha);
            $user->set_cpfcnpj($cpfcnpj);
            $user->set_user_type($usertype);
            $user->set_descricao($descricao);

            $loc = new Location();
            $loc->set_cep($cep);
            $loc->set_cidade($cidade);
            $loc->set_estado($estado);
            $loc->set_bairro($bairro);
            $loc->set_numero($numero);
            $loc->set_logradouro($logradouro);
            $loc->set_complemento($complemento);


            //inserindo user e retornando id
            $idUser = $user->insert_user($user->get_name(), $user->get_cpfcnpj(), $user->get_data_nascimento(), $user->get_email(), $user->get_telefone(), $user->get_senha(), $user->get_user_type(), $user->get_descricao());

            if ($idUser != false) { //se iduser tem conteudo entao insertLoc
                $idloc = $loc->insert_location($loc->get_cep(), $loc->get_cidade(), $loc->get_estado(), $loc->get_bairro(), $loc->get_numero(), $loc->get_logradouro(), $loc->get_complemento(), $idUser);
                if ($idloc == true) {
                    echo "<script type='text/javascript'>alert('Account created successfully!')
                    ;window.location.href = '../view/login.php';</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Error registering User, please try again');window.location.href = '../view/register.php';</script>";
                }
            } else echo "<script type='text/javascript'>alert('Error to get id location or insert location, please try again');window.location.href = '../view/register.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error all information User has to be set');window.location.href = '../view/register.php';</script>";
        }
    } else if (filter_input(INPUT_POST, "userOp") == 2) { //login
        $email = filter_input(INPUT_POST, "email");     // pegando email
        $psw = filter_input(INPUT_POST, "password");    // pegando senha 
        $remenber = filter_input(INPUT_POST, "remember");

        $user_login = new User();       //instanciando um obj do tipo user
        $user = $user_login->select_user($email, $psw);

        //eu verifico se meu value é diferente de falso - se falso user não existe no banco
        if ($user != false) {
            //pt-br pegando o as variavel do obj user e setando elas nas variaveis de sessão
            $_SESSION['idusuario'] = $user['idusuario'];
            $_SESSION['nameUser'] = $user['nome'];
            $_SESSION['CPF'] = $user['CPF'];
            $_SESSION['CNPJ'] = $user['CNPJ'];
            $_SESSION['data_nascimento'] = $user['data_nascimento'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['telefone'] = $user['telefone'];
            $_SESSION['usertype'] = $user['usertype'];
            $_SESSION['descricao'] = $user['descricao'];

            echo "<script type='text/javascript'>window.location.href = '../view/index.php';</script>";
        } else echo "<script type='text/javascript'>alert('Access not allowed, try again or create account');window.location.href = '../view/index.php';</script>";
    } else if (filter_input(INPUT_POST, "userOp") == 3) { //delete
        $idUser = filter_input(INPUT_POST, "idUser");
        $idlocation = filter_input(INPUT_POST, "idLoc");
        $user = new User();                         //instanciando um obj do tipo user
        $location = new Location();             //instanciando um obj do tipo location

        if ($user->delete($idUser) == true) {
            if ($location->deleteLoc($idlocation) == true) {
                echo "<script type='text/javascript'>alert('User delete successfully!');window.location.href = '../view/adminUser.php';</script>";
            } else echo "<script type='text/javascript'>alert('Attencion! Delete User but not delete Location, try again');window.location.href = '../view/adminUser.php';</script>";
        } else echo "<script type='text/javascript'>alert('Something wrong to delete User, try again');window.location.href = '../view/adminUser.php';</script>";
    }
}
