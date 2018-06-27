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

			$sql = $this->db->query("Select * From usuario");
			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll();
			}
			return $array;
		}
	}
?>