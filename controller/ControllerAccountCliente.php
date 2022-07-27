<?php
session_start();

require_once("../model/user.php");

//echo all variables
echo $name;
echo $email;
echo $cpfcnpj;
echo $txtphone;
echo $date_birth;
echo $password;
echo $cep;
echo $adress;
echo $number;
echo $complement;
echo $bairro;
echo $city;
echo $state;


echo "<script type='text/javascript'>alert('Account created successfully!');window.location.href = '../view/login.php';</script>";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_input(INPUT_POST, "userOp") == 1) { //insert

        //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - User

        $name = filter_input(INPUT_POST, "txtname");
        $email = filter_input(INPUT_POST, "txtemail");
        $cpfcnpj = filter_input(INPUT_POST, "txtcpfcnpj");
        $txtphone = filter_input(INPUT_POST, "txtphone");
        $date_birth = filter_input(INPUT_POST, "txtdate");
        $password = filter_input(INPUT_POST, "password");

        $cep = filter_input(INPUT_POST, "txtcep");
        $adress = filter_input(INPUT_POST, "txtadress");
        $number = filter_input(INPUT_POST, "txtnumberadress");
        $complement = filter_input(INPUT_POST, "txtcomplement");
        $bairro = filter_input(INPUT_POST, "txtbairro");
        $city = filter_input(INPUT_POST, "txtcity");
        $state = filter_input(INPUT_POST, "txtstate");

        // verifico se as variaveis estão vazias
        if (isset($name) && isset($date_birth) && isset($cpfcnpj) && isset($email) && isset($password)) {

            //pt-br inserindo valores do formulário para o obj user
            //todo: criar classe user e inserir valores no banco de dados 
            $user = new User();
            $user->set_name($name);
            $user->set_email($email);
            $user->set_password($psw);
            $user->set_usertype($usr_type);
            $user->set_birthdate($date_birth);


            //inserindo localizaçao e retornando id da localização
            $isrloc = $loc->insert_location($loc->getstate(), $loc->getcountry(), $loc->getcity(), $loc->getadress(), $loc->getdistrict());
            $isruser = $user->insert_user($user->getname(), $user->getemail(), $user->getpassword(), $user->getuser_type(), $user->getbirth_date(), $last_a, $idLoc);

            if ($idLoc != false) { //se idloc tem conteudo entao insertUser
                if ($user->insert_user($user->getname(), $user->getemail(), $user->getpassword(), $user->getuser_type(), $user->getbirth_date(), $last_a, $idLoc)  == true) {
                    echo "<script type='text/javascript'>alert('Account created successfully!')
                    ;window.location.href = '../view/login.php';</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Error registering User, please try again');window.location.href = '../view/create-account.php';</script>";
                }
            } else echo "<script type='text/javascript'>alert('Error to get id location or insert location, please try again');window.location.href = '../view/create-account.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error all information User has set');window.location.href = '../view/create-account.php';</script>";
        }
    } else if (filter_input(INPUT_POST, "userOp") == 2) { //login
        $email = filter_input(INPUT_POST, "email");     // pegando email
        $psw = filter_input(INPUT_POST, "password");    // pegando senha 

        $user_login = new User();       //instanciando um obj do tipo user
        $date = new DateTime();         // instanciando um obj do tipo data
        $date->setTimezone(new DateTimeZone('America/Sao_Paulo'));      /// setando o horário da região sp
        $last_a = $date->format('Y-m-d H:i:s');

        $value = $user_login->select_user($email, $psw); // recebo de user um obj e salvo em value

        //eu verifico se meu value é diferente de falso - se falso user não existe no banco
        if ($value != false) {
            //pt-br pegando o as variavel do obj user e setando elas nas variaveis de sessão
            $_SESSION['idUser'] = $value['idUser'];
            $_SESSION['nameUser'] = $value['name'];
            $_SESSION['emailUser'] = $value['email'];
            $_SESSION['passwordUser'] = $value['password'];
            $_SESSION['userType'] = $value['user_type'];
            $_SESSION['birth_dateUser'] = $value['birth_date'];
            $_SESSION['lastAcessUser'] = $value['last_acess'];
            $_SESSION['idLocationUser'] = $value['location_idlocation'];

            // pt-br setando o ultimo acesso e relacionando com usuario da sessão
            $user_login->set_lastacess($last_a, $value['idUser']); //chamando a função de ultimo acesso que salva no banco a ultima vez que o user fez o login

            echo "<script type='text/javascript'>alert('Login sucess');window.location.href = '../view/home.php';</script>";
        } else echo "<script type='text/javascript'>alert('Access not allowed, try again or create account');window.location.href = '../view/login.php';</script>";
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
