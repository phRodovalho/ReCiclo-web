<div class="container d-flex align-items-center justify-content-between">

    <h1 class="logo"><a href="index.php">ReCiclo</a></h1>

    <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto active" href="#contact">Pontos de Coleta </a></li>
            <li><a class="nav-link scrollto" href="#about">Pedido de Coleta </a></li>
            <li><a class="nav-link scrollto" href="#services">Calculadora de Impacto</a></li>
            <li><a class="nav-link scrollto " href="#portfolio">Sobre nós </a></li>

            <?php
            if (isset($_SESSION['nameUser']) == true) { //se tem usuário setado
                if ($_SESSION['userType'] == 'P') { //se usuario é padrão não habilita crud de admin
                    echo '<li><a class="getstarted scrollto"> ' . $_SESSION['nameUser'] . '</b></a></li>';
                    echo '<li><a class="getstarted scrollto" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <b>Logout</b></a></li>';
                } else { //usuário admin
                    echo '<li><a class="getstarted scrollto" href="adminUser.php"> ' . $_SESSION['nameUser'] . '</b></a></li>';
                    echo '<li><a class="getstarted scrollto" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <b>Logout</b></a></li>';
                }
            } else echo '<li><a class="getstarted scrollto" href="login.php"> Login ou Crie sua Conta </a></li>';
            ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
</div>