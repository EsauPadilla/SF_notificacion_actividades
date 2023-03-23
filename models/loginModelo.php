<?php 
	class LoginModelo extends Model
	{
		
		public function __construct()
		{
			parent:: __construct();
		}

		public function login($user, $pass){
			$sql = "SELECT COUNT(u.id) AS 'login', u.id, u.username, r.id AS 'rolId', r.nombre FROM tbl_usuario u INNER JOIN tbl_rol r ON r.id=u.rol_id WHERE u.username='".$user."' AND u.password='".sha1($pass)."'";
			$db = $this->getDB()->conectar();
			$result = $db->query($sql);
			$res = $result->fetch_assoc();
			$status = false;
			if ($res['login'] == 1) {
				$status = true;
				session_start();
				$_SESSION['userId'] = $res['id'];
				$_SESSION['username'] = $res['username'];
				$_SESSION['rolId'] = $res['rolId'];
				$_SESSION['rolname'] = $res['nombre'];
			}
			return $status;
		}
	}
 ?>