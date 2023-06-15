<?php 
	class Home extends Controller
	{
		
		public function __construct()
		{
			parent:: __construct();
			session_start();
			if (isset($_SESSION['userId'])) {// Redirige al usuario a la página de inicio de sesión si no hay una sesión activa
				
			}else{
				header("Location: ".URL."login/index");
				exit;
			}
		}

		public function dashboard() //funcion para lanzar la vista 
		{
			$this->getView()->title = "Home | SF"; //se le agrega un titulo a la vista 
			$pagina = 'home_v';
			$this->getView()->LoadView($pagina);//se carga la pagina pasandole la variable con el nobre de la vista
		}
	}
?>