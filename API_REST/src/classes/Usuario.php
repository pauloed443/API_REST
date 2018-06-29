<?php
	class Usuario
	{
		private $db;
		public function __construct($db)
		{
			$this->db = $db;
		}

		public function getUsuario(){
			$array = array();

			$sql = $this->db->query('Select u.Id,u.Nome,u.Email,u.Senha,tu.Descricao 
									 From usuario u
									 inner join tipo_usuario tu
									 on u.Id_Tipo_Usuario = tu.Id');
			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll();
			}
			return $array;
		}

		public function searchUser($user){
			$array = array();
			$nome = $user['nome'];
			$sql = $this->db->query("Select Id,
											Nome,
											Email,
											Senha,
											Case When Id_Tipo_Usuario = 1 then
												'Admin'
											Else 'Comum' end as	Descricao 
									from usuario 
									where Nome like '%".$nome."%'");
			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll();
			}
			return $array;
		}
        
        public function getTipoUser(){
            $array = array();
            $sql = $this->db->query("select * from tipo_usuario");
            if ($sql->rowCount() > 0) {
            	$array = $sql->fetchAll();
            }
            return $array;
        }

        public function addUser($lista){
        	$sql = $this->db->prepare("INSERT INTO usuario
        								SET Nome = :nome,
        									Email = :email,
        									Senha = :senha,
        									Id_Tipo_Usuario = :tipo_usuario");
        	$sql->bindValue(":nome", $lista['Nome']);
        	$sql->bindValue(":email", $lista['Email']);
        	$sql->bindValue(":senha", $lista['Senha']);
        	$sql->bindValue(":tipo_usuario", $lista['tipo_usuario']);
        	$sql->execute();
        }
        public function updateUser($lista){
        	$sql = $this->db->prepare("UPDATE usuario
        								SET Nome = :nome,
        									Email = :email,
        									Senha = :senha
        								WHERE Id = :id");
        	$sql->bindValue(":id", $lista['Id']);
        	$sql->bindValue(":nome", $lista['Nome']);
        	$sql->bindValue(":email", $lista['Email']);
        	$sql->bindValue(":senha", $lista['Senha']);
        	$sql->execute();
        }

        public function findUserById($id){
        	$array = array();
        	$sql = $this->db->prepare("SELECT * FROM usuario WHERE Id = :id");
        	$sql->bindValue(":id", $id);
        	$sql->execute();
        	if ($sql->rowCount() > 0) {
        		$array = $sql->fetch();
        	}
        	return $array;
        }
	}
?>