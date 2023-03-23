<?php 
	class Home extends Controller
	{
		
		public function __construct()
		{
			parent:: __construct();
			session_start();
			if (isset($_SESSION['userId'])) {
				
			}else{
				header("Location: ".URL."login/index");
			}
		}

		public function dashboard()
		{
			$this->getView()->title = "Home | SF";
			$pagina = 'home_v';
			$this->getView()->LoadView($pagina);
		}
	}
?>