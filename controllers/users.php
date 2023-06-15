<?php
class users extends Controller
{

	public function __construct()
	{
		parent::__construct();
		session_start();
		if (isset($_SESSION['userId']) && $_SESSION['rolId'] == 1) { // Redirige al usuario a la página del home si no hay una sesión activa y no tiene los permisos de rol de admin
		} else {
			header("Location: " . URL . "home/dashboard");
			exit; // Finaliza la ejecución del script después de la redirección
		}
	}

	public function administrar_usuarios() //funcion para lanzar la vista 
	{
		$this->getView()->title = "Usuarios | SF";  //se le agrega un titulo a la vist
		$pagina = 'users_v';
		$this->getView()->LoadView($pagina); //se carga la pagina pasandole la variable con el nobre de la vista
	}

	public function startSignup()
	{
		$msg = array();

		if (isset($_POST)) {
			$name = $_POST['name']; 
			$user = $_POST['user']; 
			$id = $_POST['id']; 
			$rol_id = 2; // ID del rol del usuario (2 para un rol de usuario normal)
			$status = 1; // Estado del usuario ( 1 para un usuario activo)

			if ($id == '') {
				// Si el ID está vacío, se trata de un nuevo registro de usuario
				if (empty($_POST['user']) || empty($_POST['pass'])) {// Si el usuario o la contraseña están vacíos, no se hace nada
					
				} else {
					$pass = $_POST['pass']; // Obtener la contraseña del usuario
					$data =  $this->getModel()->registrar($user, $pass, $rol_id, $status, $name);
					if ($data == 'ok') {
						$msg = array('msg' => 'Usuario Registrado', 'estado' => true, 'tipo' => 'success');
					} else {
						$msg = array('msg' => 'Error al Registrar', 'estado' => false, 'tipo' => 'error');
					}
				}
			} elseif ($id != '') {
				// Si el ID no está vacío, se trata de una edición de usuario
				if (!empty($_POST['user']) and empty($_POST['pass'])) {// Si el nombre de usuario no está vacío y la contraseña está vacía, se edita solo el nombre y el correo
					
					$data =  $this->getModel()->editar($id, $user, $name);
					if ($data == 'ok') {
						$msg = array('msg' => 'Usuario Editado', 'estado' => true, 'tipo' => 'success');
					} else {
						$msg = array('msg' => 'Error al Editar', 'estado' => false, 'tipo' => 'error');
					}
				} elseif (!empty($_POST['user']) and !empty($_POST['pass'])) {
					// Si tanto el nombre de usuario como la contraseña no están vacíos, se edita el nombre , la contraseña y el correo
					$pass = $_POST['pass']; // Obtener la nueva contraseña del usuario
					$data =  $this->getModel()->editarpass($id, $user, $pass, $name);
					if ($data == 'ok') {
						$msg = array('msg' => 'Usuario Editado', 'estado' => true, 'tipo' => 'success');
					} else {
						$msg = array('msg' => 'Error al Editar', 'estado' => false, 'tipo' => 'error');
					}
				}
			}
		} else {
			$msg = array('msg' => 'No se recibieron datos', 'estado' => false, 'tipo' => 'error');
		}

		echo json_encode($msg); // Enviar la respuesta como un objeto JSON
	}

	public function borrar($id) // eliminar dependiendo el id
	{
		$data = $this->getModel()->borrar($id);
		if ($data == 'ok') {
			$msg = array('msg' => 'Usuario Eliminado', 'estado' => true, 'tipo' => 'success');
		} else {
			$msg = array('msg' => 'Error al Eliminar', 'estado' => false, 'tipo' => 'error');
		}
		echo json_encode($msg);
	}

	public function mostrarUsers() // se obtienen los datos de todos los usuarios y se mandan por json
	{
		$datos = $this->getModel()->listarUsers();
		echo json_encode($datos);
	}
}
