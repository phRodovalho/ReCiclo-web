<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("C:/xampp/htdocs/ReCiclo/helper/head.php");
    session_start(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Template Main CSS File -->
    <link href="/ReCiclo/view/assets/css/style.css" rel="stylesheet">
    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Adicionando Javascript -->
    <script src="/ReCiclo/view/assets/js/getAdress.js"></script>
    <!-- Adicionando Ajax -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
    <style>
        button {
            background-color: #04AA6D;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
            margin-top: 40px;
        }

        button:hover {
            opacity: 0.8;
        }

        #prevBtn {
            background-color: #bbbbbb;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        /* Hide all steps by default:*/
        .tab {
            display: none;
        }

        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }

        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
        }
    </style>

</head>

<body class="bg-secondary-light">
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6  d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4 ">
                                <h1 class="pagetitle"><a href="index.php">ReCiclo</a></h1>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center">Crie sua Conta</h5>
                                        <p class="text-center small">Entre com seus dados pessoais para ter acesso a todos os beneficios!</p>
                                    </div>

                                    <form id="regForm" class="row needs-validation" novalidate method="post" action="../controller/ControllerAccountCliente.php">
                                        <div class="tab">
                                            <div class="col-12">
                                                <label class="form-label">Nome completo</label>
                                                <input type="text" name="txtname" class="form-control" id="yourName" oninput="this.className = 'form-control'">
                                                <div class="invalid-feedback">Por favor, digite seu nome!</div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">E-mail</label>
                                                <input type="email" name="txtemail" class="form-control" id="yourEmail" required oninput="this.className = 'form-control'">
                                                <div class="invalid-feedback">Por favor, digite seu e-mail!</div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">CPF/CNPJ</label>
                                                <input type="text" name="txtcpfcnpj" class="form-control" id="cpfcnpj" required oninput="this.className = 'form-control'">
                                                <div class="invalid-feedback">Por favor, digite seu CPF ou CNPJ</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label">Telefone</label>
                                                    <input type="text" name="txtphone" class="form-control" id="phone" required oninput="this.className = 'form-control'">
                                                    <div class="invalid-feedback">Por favor, digite seu telefone!</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Data Nascimento</label>
                                                    <input required type="date" class="form-control" name="txtdate" oninput="this.className = 'form-control'">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label">Senha</label>
                                                    <input type="password" name="password" class="form-control" id="yourPassword" required oninput="this.className = 'form-control'">
                                                    <div class="invalid-feedback">Por favor, digite uma senha válida! 8-20 caracteres.</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Confirme Senha</label>
                                                    <input type="password" name="confirPassword" class="form-control" id="confirPassword" required oninput="this.className = 'form-control'">
                                                    <div class="invalid-feedback">Por favor, digite uma senha válida! 8-20 caracteres.</div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab">
                                            <div class="col-12">
                                                <label class="form-label">CEP:</label>
                                                <input type="text" name="txtcep" class="form-control" id="cep" required oninput="this.className = 'form-control'">
                                                <div class="invalid-feedback">Por favor, digite seu CEP!</div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Endereço</label>
                                                <input type="text" name="txtadress" class="form-control" id="rua" size="10" maxlength="9" required oninput="this.className = 'form-control'">
                                                <div class="invalid-feedback">Por favor, digite seu endereço!</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label">Número</label>
                                                    <input type="text" name="txtnumberadress" class="form-control" id="number" required oninput="this.className = 'form-control'">
                                                    <div class="invalid-feedback">Por favor, digite seu número!</div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Complemento</label>
                                                    <input type="text" name="txtcomplement" class="form-control" id="complement" oninput="this.className = 'form-control'">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Bairro</label>
                                                <input type="text" name="txtbairro" class="form-control" id="bairro" required oninput="this.className = 'form-control'">
                                                <div class="invalid-feedback">Por favor, digite seu bairro!</div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Cidade</label>
                                                <input type="text" name="txtcity" class="form-control" id="cidade" required oninput="this.className = 'form-control'">
                                                <div class="invalid-feedback">Por favor, digite sua cidade!</div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Estado</label>
                                                <input type="text" name="txtstate" class="form-control" id="uf" required oninput="this.className = 'form-control'">
                                            </div>
                                        </div>
                                        <div style="overflow:auto;">
                                            <div style="float:right;">
                                                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                            </div>
                                        </div>
                                        <!-- Circles which indicates the steps of the form: -->
                                        <div style="text-align:center;margin-top:20px;">
                                            <span class="step"></span>
                                            <span class="step"></span>
                                        </div>
                                        <input type="hidden" value="1" name="userOp">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </main>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // function to compare password and confirm password if not eguals return false
            psw1 = document.getElementById("yourPassword").value;
            psw2 = document.getElementById("confirPassword").value;
            if (psw1 != psw2) {
                alert("Senhas não conferem! Por favor, digite novamente.");
                return false;
            }

            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>


</body>


</html>