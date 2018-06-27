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

			$sql = $this->db->query('Select * From usuario');
			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll();
			}
			return $array;
		}
        
        public function getTipoUser(){
            $array = array();
            $sql = $this->db->query("select Descricao from tipo_usuario");
            $array = $sql->fetchAll();
            return $array;
        }
	}
?>