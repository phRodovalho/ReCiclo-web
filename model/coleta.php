<?php
//metodos de envio para o banco com PDO
require_once("banco.php");

class Pedido
{
    //pt-br criando os atributos privados
    //en-us creating the private atributes
    private $nome;
    private $tipo_material;
    private $quantidade;
    private $midia;
    private $info_contato;
    private $info_coleta;
    private $descricao;
    private $userId;
    private $conexao;
    private $status;

    public function __construct()
    {
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
        $this->status = 'solicitada';
    }
    public function list_pedidos($userId)
    {
        $sql = "SELECT * FROM reciclo_db.pedido_coleta WHERE usuario_idusuario = $userId;";

        $pedidos = [];

        foreach ($this->conexao->query($sql) as $key => $value) {
            array_push($pedidos, $value);
        }

        return $pedidos;
    }
    public function list_all_pedidos()
    {
        $sql = "SELECT * FROM reciclo_db.pedido_coleta;";

        $pedidos = [];

        foreach ($this->conexao->query($sql) as $key => $value) {
            array_push($pedidos, $value);
        }

        return $pedidos;
    }


    public function insert_pedido($nome, $tipo_material, $quantidade, $midia, $info_contato, $info_coleta, $descricao, $userId)
    {
        /*
        INSERT INTO reciclo_db.pedido_coleta (nome, tipo_material, quantidade, midia, info_contato, info_coleta, descricao, usuario_idusuario)
        VALUES ("Joao Cliente", 'Vidro, Papelão', '2 kl', NULL, '23456789876543', 'endereço rua cep', 'teste', 10);
        */

        $sql = 'INSERT INTO reciclo_db.pedido_coleta (nome, tipo_material, quantidade, midia, info_contato, info_coleta, descricao, usuario_idusuario, status) VALUES (?,?,?,?,?,?,?,?,?)';
        $prepare = $this->conexao->prepare($sql);

        $prepare->bindValue(1, $this->nome);
        $prepare->bindValue(2, $this->tipo_material);
        $prepare->bindValue(3, $this->quantidade);
        $prepare->bindValue(4, $this->midia);
        $prepare->bindValue(5, $this->info_contato);
        $prepare->bindValue(6, $this->info_coleta);
        $prepare->bindValue(7, $this->descricao);
        $prepare->bindValue(8, $this->userId);
        $prepare->bindValue(9, $this->status);

        if ($prepare->execute() == TRUE) {   //pt-br se executar então retorna true | en-us if run then return true
            return true;
        } else {
            return false;
        }
    }

    public function update_status($status, $idPedido)
    {
        $sql = 'UPDATE reciclo_db.pedido_coleta SET status = ? WHERE idpedido_coleta = ?;';
        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $status);
        $prepare->bindParam(2, $idPedido);

        if ($prepare->execute() == TRUE) {  //pt-br se executar então retorna true | en-us if run then return true
            return true;
        } else {
            return false;
        }
    }

    // pt-br atribuindo os valores com set
    // en-us setting the values with set
    public function set_nome($nome)
    {
        $this->nome = $nome;
    }
    public function set_tipo_material($tipo_material)
    {
        $this->tipo_material = $tipo_material;
    }
    public function set_quantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }
    public function set_midia($midia)
    {
        $this->midia = $midia;
    }
    public function set_info_contato($info_contato)
    {
        $this->info_contato = $info_contato;
    }
    public function set_info_coleta($info_coleta)
    {
        $this->info_coleta = $info_coleta;
    }
    public function set_descricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function set_userId($userId)
    {
        $this->userId = $userId;
    }
    // pt-br pegando os valores com get
    // en-us getting the values with get
    public function get_nome()
    {
        return $this->nome;
    }
    public function get_tipo_material()
    {
        return $this->tipo_material;
    }
    public function get_quantidade()
    {
        return $this->quantidade;
    }
    public function get_midia()
    {
        return $this->midia;
    }
    public function get_info_contato()
    {
        return $this->info_contato;
    }
    public function get_info_coleta()
    {
        return $this->info_coleta;
    }
    public function get_descricao()
    {
        return $this->descricao;
    }
    public function get_userId()
    {
        return $this->userId;
    }
}

class Ponto
{
    //pt-br criando os atributos privados
    //en-us creating the private atributes
    private $nome;
    private $tipo;
    private $descricao;
    private $horario_funcionamento;
    private $info_contato;
    private $idEndereco;
    private $idUser;

    public function __construct()
    {
        //pt-br após instanciar os atributos, crio um obj PDO para conexão com banco 
        //en-us after instantiating the attributes, I create a PDO obj for database connection
        $banco = new Banco();
        $this->conexao = $banco->getConnection();


        $sql = "SELECT * FROM reciclo_db.ponto_coleta;";

        foreach ($this->conexao->query($sql) as $value) {

            //pt-br pegando os dados no formulário e seto no obj post
            $this->nome = $value['nome'];
            $this->tipo = $value['tipo'];
            $this->descricao = $value['descricao'];
            $this->horario_funcionamento = $value['horario_funcionamento'];
            $this->info_contato = $value['info_contato'];
            $this->idEndereco = $value['endereco_idendereco'];
            $this->idUser = $value['usuario_idusuario'];
        }
    }

    //get e set
    public function get_nome()
    {
        return $this->nome;
    }
    public function get_tipo()
    {
        return $this->tipo;
    }
    public function get_descricao()
    {
        return $this->descricao;
    }
    public function get_horario_funcionamento()
    {
        return $this->horario_funcionamento;
    }
    public function get_info_contato()
    {
        return $this->info_contato;
    }
    public function get_idEndereco()
    {
        return $this->idEndereco;
    }
    public function get_idUser()
    {
        return $this->idUser;
    }
    public function set_nome($nome)
    {
        $this->nome = $nome;
    }
    public function set_tipo($tipo)
    {
        $this->tipo = $tipo;
    }
    public function set_descricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function set_horario_funcionamento($horario_funcionamento)
    {
        $this->horario_funcionamento = $horario_funcionamento;
    }
    public function set_info_contato($info_contato)
    {
        $this->info_contato = $info_contato;
    }
    public function set_idEndereco($idEndereco)
    {
        $this->idEndereco = $idEndereco;
    }
    public function set_idUser($idUser)
    {
        $this->idUser = $idUser;
    }


    //pt-br método para inserir novo ponto no banco de dados
    //en-us method to insert new point in database
    public function insert($nome, $tipo, $descricao, $horario_funcionamento, $info_contato, $idEndereco, $idUser)
    {
        $prepare = $this->conexao->prepare("INSERT INTO reciclo_db.ponto_coleta (nome, tipo, descricao, horario_funcionamento, info_contato, endereco_idendereco, usuario_idusuario) VALUES (?, ?, ?, ?, ?, ?, ?);");
        $prepare->bindValue(1, $nome);
        $prepare->bindValue(2, $tipo);
        $prepare->bindValue(3, $descricao);
        $prepare->bindValue(4, $horario_funcionamento);
        $prepare->bindValue(5, $info_contato);
        $prepare->bindValue(6, $idEndereco);
        $prepare->bindValue(7, $idUser);

        if ($prepare->execute() == TRUE) {   //pt-br se executar então retorna true | en-us if run then return true
            return true;
        } else {
            return false;
        }
    }
}
