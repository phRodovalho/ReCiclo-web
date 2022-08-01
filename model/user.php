<?php
require_once("banco.php");

class User
{
    ///pt-br criando os atributos privados
    private $nome;
    private $cpfcnpj;
    private $data_nascimento;
    private $email;
    private $telefone;
    private $senha;
    private $user_type;
    private $descricao;
    private $idendereco;
    private $conexao;

    public function __construct()
    {
        //pt-br criando o objeto para conexão com o banco
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    //pt-br getters e setters
    public function get_name()
    {
        return $this->nome;
    }
    public function set_name($nome)
    {
        $this->nome = $nome;
    }
    public function get_cpfcnpj()
    {
        return $this->cpfcnpj;
    }
    public function set_cpfcnpj($cpfcnpj)
    {
        $this->cpfcnpj = $cpfcnpj;
    }
    public function get_data_nascimento()
    {
        return $this->data_nascimento;
    }
    public function set_data_nascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function set_email($email)
    {
        $this->email = $email;
    }
    public function get_telefone()
    {
        return $this->telefone;
    }
    public function set_telefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function get_senha()
    {
        return $this->senha;
    }
    public function set_senha($senha)
    {
        $hashed_senha = password_hash($senha, PASSWORD_BCRYPT);
        $this->senha = $hashed_senha;
    }
    public function get_user_type()
    {
        return $this->user_type;
    }
    public function set_user_type($user_type)
    {
        $this->user_type = $user_type;
    }
    public function get_descricao()
    {
        return $this->descricao;
    }
    public function set_descricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function get_idendereco()
    {
        return $this->idendereco;
    }
    public function set_idendereco($idendereco)
    {
        $this->idendereco = $idendereco;
    }
    //CRUD
    //inserir usuário
    public function insert_user($nome, $cpfcnpj, $data_nascimento, $email, $telefone, $senha, $user_type, $descricao)
    {
        /*
        INSERT INTO reciclo_db.usuario (nome, CPF, data_nascimento, email, telefone, senha, usertype, descricao) 
        VALUES ('Mestre dos Magos', '12345678909', '1998-12-08','adm@gmail.com', '64987564289', '123', 'adm', 'Me chame de mestre dos magos');
        */
        //pt-br recebendo os valores do usuário e atribuindo ao objeto
        //verificar se o tamnho é 11 ou 14
        echo " nome: " . $nome;
        echo " cpfcnpj: " . $cpfcnpj;
        echo " data_nascimento: " . $data_nascimento;
        echo " email: " . $email;
        echo " telefone: " . $telefone;
        echo " senha: " . $senha;
        echo " user_type: " . $user_type;
        echo " descricao: " . $descricao;

        if (strlen($cpfcnpj) <= 11) {
            $sql = 'INSERT INTO reciclo_db.usuario (nome, CPF, data_nascimento, email, telefone, senha, usertype, descricao) VALUES (?,?,?,?,?,?,?,?)';
            $prepare = $this->conexao->prepare($sql);

            $prepare->bindParam(1, $nome);
            $prepare->bindParam(2, $cpfcnpj);
            $prepare->bindParam(3, $data_nascimento);
            $prepare->bindParam(4, $email);
            $prepare->bindParam(5, $telefone);
            $prepare->bindParam(6, $senha);
            $prepare->bindParam(7, $user_type);
            $prepare->bindParam(8, $descricao);
        } else if (strlen($cpfcnpj) > 11) {
            $sql = 'INSERT INTO reciclo_db.usuario (nome, CNPJ, data_nascimento, email, telefone, senha, usertype, descricao) VALUES (?,?,?,?,?,?,?,?)';
            $prepare = $this->conexao->prepare($sql);

            $prepare->bindParam(1, $nome);
            $prepare->bindParam(2, $cpfcnpj);
            $prepare->bindParam(3, $data_nascimento);
            $prepare->bindParam(4, $email);
            $prepare->bindParam(5, $telefone);
            $prepare->bindParam(6, $senha);
            $prepare->bindParam(7, $user_type);
            $prepare->bindParam(8, $descricao);
        }
        if ($prepare->execute() == TRUE) {
            //pt-br pega o id da linha que acabou de ser inserida e retorna
            $last_id = $this->conexao->lastInsertId();
            return $last_id;
        } else {
            return false;
        }
    }

    //Função usava para fazer o login
    public function select_user($email, $senha)
    {
        //pt-br Ela verifica se o usuário e senha existem no bd
        //SELECT * FROM reciclo_db.usuario where email = 'phefsfsantos@gmail.com';
        $stmt = $this->conexao->prepare("SELECT * from reciclo_db.usuario where email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        //todo: verificar se o usuário existe e a senha está correta
        if ($user != null) {
            if (password_verify($senha, $user['senha'])) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function listUsers()
    {
        //pt-br comando select do banco de dados buscando os atributos no banco
        //en-us database select command fetching the attributes in the database
        $sql = 'SELECT * FROM reciclo_db.usuario;';

        //pt-br declarando um array que vai ser preenchido e retornado
        //en-us declaring an array that will be filled and returned
        $user = [];

        foreach ($this->conexao->query($sql) as $value) {  //pt-br pegando a lista de obj do user e inserindo no user | en-us taking the user obj list and inserting it into the user array
            array_push($user, $value);
        }
        return $user;
    }

    public function delete($idUser)
    {
        $sql = 'delete from user where idUser = ?';

        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $idUser);

        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

class Location
{
    ///pt-br criando os atributos privados
    /// en-us creating the private atributes
    private $cep;
    private $cidade;
    private $estado;
    private $bairro;
    private $numero;
    private $logradouro;
    private $complemento;

    private $conex;

    public function __construct()
    {
        $banco = new Banco();
        $this->conex = $banco->getConnection();
    }

    //pt-br atribuindo os valores com set e get
    public function set_cep($cep)
    {
        $this->cep = $cep;
    }
    public function get_cep()
    {
        return $this->cep;
    }
    public function set_cidade($cidade)
    {
        $this->cidade = $cidade;
    }
    public function get_cidade()
    {
        return $this->cidade;
    }
    public function set_estado($estado)
    {
        $this->estado = $estado;
    }
    public function get_estado()
    {
        return $this->estado;
    }
    public function set_bairro($bairro)
    {
        $this->bairro = $bairro;
    }
    public function get_bairro()
    {
        return $this->bairro;
    }
    public function set_numero($numero)
    {
        $this->numero = $numero;
    }
    public function get_numero()
    {
        return $this->numero;
    }
    public function set_logradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }
    public function get_logradouro()
    {
        return $this->logradouro;
    }
    public function set_complemento($complemento)
    {
        $this->complemento = $complemento;
    }
    public function get_complemento()
    {
        return $this->complemento;
    }


    //função que insere localização no banco
    public function insert_location($cep, $cidade, $estado, $bairro, $numero, $logradouro, $complemento, $idUser)
    {
        /*
        INSERT INTO reciclo_db.endereco (CEP, cidade, estado, bairro, numero, logradouro, complemento, usuario_idusuario)
        VALUES ('38408196', 'Caverna do Dragao', 'Teste', 'Teste', 1222, 'Rua dos magos', 'TV Globinho', 9);
        */

        $sql = 'INSERT INTO reciclo_db.endereco (CEP, cidade, estado, bairro, numero, logradouro, complemento, usuario_idusuario) VALUES (?,?,?,?,?,?,?,?)';
        $prepare = $this->conex->prepare($sql);
        $prepare->bindParam(1, $cep);
        $prepare->bindParam(2, $cidade);
        $prepare->bindParam(3, $estado);
        $prepare->bindParam(4, $bairro);
        $prepare->bindParam(5, $numero);
        $prepare->bindParam(6, $logradouro);
        $prepare->bindParam(7, $complemento);
        $prepare->bindParam(8, $idUser);

        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
