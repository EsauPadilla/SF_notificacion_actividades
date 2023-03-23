<?php
class users extends Controller {
		
		public function __construct()
		{
			parent:: __construct();
			session_start();
            if (isset($_SESSION['userId']) && $_SESSION['rolId'] = 1 ) {
                    
            }else{
                header("Location: ".URL."home/dashboard");
            }

		}

		public function users_v()
		{
			$this->getView()->title = "Admin. Usuarios | SF";
			$pagina = 'users_v';
			$this->getView()->LoadView($pagina);
		}

		public function startSignup(){
			$name = $_POST['name'];
			$username = $_POST['user'];
			$password = $_POST['pass'];
			$rol_id = 2;
			$status = 1;

			$data =  $this->getModel()->signup($username, $password, $rol_id, $status, $name);
			if ($data == 'ok') {
				$msg = array('msg' => 'Usuario Registrado', 'estado' => true, 'tipo' => 'success');
			}else{
				$msg = array('msg' => 'Error al Registrar', 'estado' => false, 'tipo' => 'error');
			}
			echo json_encode($msg);
		}

        public function mostrarUsers(){
            $datos = $this->getModel()->listarUsers();
            echo json_encode($datos);
		}
    }
?>