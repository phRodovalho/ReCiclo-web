<?php
require_once("banco.php");

class User
{
    ///pt-br criando os atributos privados
    private $nome;
    private $cpf;
    private $cnpj;
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
    public function get_cpf()
    {
        return $this->cpf;
    }
    public function set_cpf($cpf)
    {
        $this->cpf = $cpf;
    }
    public function get_cnpj()
    {
        return $this->cnpj;
    }
    public function set_cnpj($cnpj)
    {
        $this->cnpj = $cnpj;
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

    // pt-br atribuindo os valores com set
    //Função que atualiza o ultimo acesso do usuário
    public function set_lastacess($last_acess, $idUser)
    {
        //pt-br recebendo o ultimo acesso setando ele no obj usuário e atualizando com o update

        $this->last_acess = $last_acess;

        $sql = 'UPDATE user SET last_acess = ? WHERE idUser = ?';
        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $last_acess);
        $prepare->bindParam(2, $idUser);

        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }


    //CRUD
    //inserir usuário
    public function insert_user($nome, $cpf, $cnpj, $data_nascimento, $email, $telefone, $senha, $user_type, $descricao, $idendereco)
    {
        /*
        INSERT INTO reciclo_db.usuario (nome, CPF, data_nascimento, email, telefone, senha, usertype ,endereco_idendereco)
        VALUES ('Phelipe R','03412345608', '1998-12-08','phefsfsantos@gmail.com', '64983493292', 'hashdessenhaexemplo', 'adm', 1)
        */
        //pt-br recebendo os valores do usuário e atribuindo ao objeto
        if ($cpf == null) {
            $sql = 'INSERT INTO reciclo_db.usuario (nome, CPF, data_nascimento, email, telefone, senha, usertype, descricao, endereco_idendereco) VALUES (?,?,?,?,?,?,?,?,?)';
            $prepare = $this->conexao->prepare($sql);
            $prepare->bindParam(2, $cpf);
        } else {
            $sql = 'INSERT INTO reciclo_db.usuario (nome, CNPJ, data_nascimento, email, telefone, senha, usertype, descricao, endereco_idendereco) VALUES (?,?,?,?,?,?,?,?,?)';
            $prepare = $this->conexao->prepare($sql);
            $prepare->bindParam(2, $cnpj);
        }

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $nome);
        $prepare->bindParam(3, $data_nascimento);
        $prepare->bindParam(4, $email);
        $prepare->bindParam(5, $telefone);
        $prepare->bindParam(6, $senha);
        $prepare->bindParam(7, $user_type);
        $prepare->bindParam(8, $descricao);
        $prepare->bindParam(9, $idendereco);

        if ($prepare->execute() == TRUE) {
            return true;
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

    private $country;
    private $city;
    private $adress;
    private $district;

    private $conex;

    public function __construct()
    {
        $banco = new Banco();
        $this->conex = $banco->getConnection();
    }

    // pt-br atribuindo os valores com set
    public function set_state($state)
    {
        $this->state = $state;
    }

    public function set_country($country)
    {
        $this->country = $country;
    }

    public function set_city($city)
    {
        $this->city = $city;
    }

    public function set_adress($adress)
    {
        $this->adress = $adress;
    }

    public function set_district($district)
    {
        $this->district = $district;
    }

    public function set_latitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function set_longitude($longitude)
    {
        $this->longitude = $longitude;
    }

    //pt-br pegando os dados com get

    public function getstate()
    {
        return $this->state;
    }

    public function getcountry()
    {
        return $this->country;
    }

    public function getcity()
    {
        return $this->city;
    }

    public function getadress()
    {
        return $this->adress;
    }

    public function getdistrict()
    {
        return $this->district;
    }

    public function getlatitude()
    {
        return $this->latitude;
    }

    public function getlongitude()
    {
        return $this->longitude;
    }

    //função que insere localização no banco
    public function insert_location($state, $country, $city, $adress, $district)
    {
        /*
        INSERT INTO reciclo_db.endereco ( CEP, cidade, estado, bairro, numero, logradouro, complemento)
        VALUES ('38408196', 'Uberlândia', 'Minas Gerais','Santa Mônica', 590, 'Rua Cecilio Jorge', 'apt201');
        */

        $sql = 'INSERT INTO location (state , country , city , adress , district) VALUES (?,?,?,?,?)';

        $prepare = $this->conex->prepare($sql);

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $state);
        $prepare->bindParam(2, $country);
        $prepare->bindParam(3, $city);
        $prepare->bindParam(4, $adress);
        $prepare->bindParam(5, $district);

        if ($prepare->execute() == TRUE) {

            //pt-br pega o id da linha que acabou de ser inserida e retorna
            $last_id = $this->conex->lastInsertId();
            return $last_id;
        } else {
            return false;
        }
    }

    public function deleteLoc($idLocation)
    { {
            $sql = 'delete from location where idlocation = ?';

            $prepare = $this->conex->prepare($sql);

            $prepare->bindParam(1, $idLocation);

            if ($prepare->execute() == TRUE) {
                return true;
            } else {
                return false;
            }
        }
    }
}
