<?php 
	class Login extends Controller
	{
		
		public function __construct()
		{
			parent:: __construct();

		}

		public function index()
		{
			$pagina = 'login_v';
			$this->getView()->LoadView($pagina);
		}

		public function startLogin(){
			$username = $_POST['user'];
			$password = $_POST['pass'];
			$msg = "";
			$status = false;
			if ($username != "") {
				if ($password != "") {
					$status =  $this->getModel()->login($username, $password);
					if ($status) {
						$status = true;
					}else{
						$msg = "Usuario o Contraseña incorrectos";
						$status = false;
					}
				}else{
					$msg = "Contraseña requerida";
				}
			}else{
				$msg = "Usuario requerido";
			}
			$datos = array('estado' => $status, 'mensaje' => $msg);
			echo json_encode($datos);
		}

		public function cerrarSession(){
			session_start();
			$_SESSION = array();
			session_destroy();

			echo json_encode(array('status' => true));
		}
	}
 ?>