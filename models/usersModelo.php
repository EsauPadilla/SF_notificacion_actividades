<?php 
	class usersModelo extends Model
	{
		
		public function __construct()
		{
			parent:: __construct();
		}

		public function registrar($user, $pass, $rol_id, $status, $name){
			$sql = "INSERT INTO `tbl_usuario`(`id`, `username`, `password`, `rol_id`, `status`, `name`) VALUES (NULL,'".$user."',SHA1('".$pass."'),'".$rol_id."','".$status."','".$name."')";
			$db = $this->getDB()->conectar();
			$result = $db->query($sql);
				if ($result) {
					$res = 'ok';
				}else{
					$res = 'error';
				}
			return $res;
		}
		public function editar($id, $user, $name){ 
            $sql = "UPDATE `tbl_usuario` SET username='".$user."', name= '".$name."' WHERE id='".$id."'";
            $db = $this->getDB()->conectar();
			$result = $db->query($sql);
				if ($result) {
					$res = 'ok';
				} else {
					$res = 'error';
				}
			return $res;
			}
		public function editarpass($id, $user, $pass, $name){ 
            $sql = "UPDATE `tbl_usuario` SET username='".$user."', password = SHA1('".$pass."'), name= '".$name."' WHERE id='".$id."'";
            $db = $this->getDB()->conectar();
			$result = $db->query($sql);
				if ($result) {
					$res = 'ok';
				} else {
					$res = 'error';
				}
			return $res;
			}
			public function borrar($id){
				$sql = "DELETE FROM `tbl_usuario` WHERE `id`='".$id."'";
				$db = $this->getDB()->conectar();
				$result = $db->query($sql);
					if ($result) {
						$res = 'ok';
					} else {
						$res = 'error';
					}
				return $res;
	
			}


        public function listarUsers(){
            $db = $this->getDB()->conectar();
            $datos = mysqli_query($db, "select * from tbl_usuario WHERE rol_id = 2");
            return $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        
        }
        
	}
?>