<?php 
	class usersModelo extends Model
	{
		
		public function __construct()
		{
			parent:: __construct();
		}

		public function signup($user, $pass, $rol_id, $status, $name){
			$sql = "INSERT INTO tbl_usuario (id, username, password, rol_id, status, name) VALUES (NULL, '".$user."', SHA1('".$pass."'), '".$rol_id."', '".$status."', '".$name."')";
			$db = $this->getDB()->conectar();
			$result = $db->query($sql);
				if ($result) {
					$res = 'ok';
				}else{
					$res = 'error';
				}
			return $res;
		}
        public function listarUsers(){
            $db = $this->getDB()->conectar();
            $datos = mysqli_query($db, "select * from tbl_usuario");
            return $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        
        }
        
	}
?>