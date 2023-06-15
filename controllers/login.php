<?php 
	class Login extends Controller
	{
		
		public function __construct()
		{
			parent:: __construct();

		}

		public function index() //funcion para lanzar la vista 
		{
			$pagina = 'login_v';
			$this->getView()->LoadView($pagina);//se carga la pagina pasandole la variable con el nobre de la vista
		}

		public function startLogin(){
			// Obtener el nombre de usuario y la contraseña enviados por POST
			$username = $_POST['user'];
			$password = $_POST['pass'];
			$msg = "";
			$status = false;
			if ($username != "") {// Validar que se haya proporcionado un nombre de usuario
				if ($password != "") { // Validar que se haya proporcionado una contraseña
					 // Verificar el inicio de sesión llamando a la función de modelo 'login'
					$status =  $this->getModel()->login($username, $password);
					if ($status) {// Si el inicio de sesión fue exitoso
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
			$_SESSION = array(); // Limpiar la sesión
			session_destroy(); // Destruir la sesión
			  
			echo json_encode(array('status' => true));// Enviar la respuesta como un objeto JSON indicando que el cierre de sesión fue exitoso
		}
	}
 ?>