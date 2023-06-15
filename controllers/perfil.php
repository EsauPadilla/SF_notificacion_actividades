<?php
class perfil extends Controller
{

    public function __construct()
    {
        parent::__construct();
        session_start();
        if (isset($_SESSION['userId'])) { // Redirige al usuario a la página de inicio de sesión si no hay una sesión activa

        } else {
            header("Location: " . URL . "login/index");
            exit;
        }
    }

    public function configurar_perfil() //funcion para lanzar la vista 
    {
        $this->getView()->title = "Perfil | SF"; //se le agrega un titulo a la vista 
        $pagina = 'perfil_v';
        $this->getView()->LoadView($pagina); //se carga la pagina pasandole la variable con el nobre de la vista
    }

    public function configPerfil()
    {
        $msg = array();
        if (isset($_FILES['profile-image'])) {
            // Obtener los datos del formulario
            $imagen = $_FILES['profile-image']['name'];
            $nombre = $_POST['name'];
            $telefono = $_POST['phone'];
            $direccion = $_POST['adress'];
            $descripcion = $_POST['desc'];

            $file_type = strtolower(pathinfo($imagen, PATHINFO_EXTENSION)); //se extrae la extencion del archivo
            $imagenname = 'img_'.$_SESSION['userId'].'.'.$file_type; //se personaliza el nombre que tendra el archivo dentro del servidor
            $url_temp = $_FILES['profile-image']['tmp_name']; // ruta temporal

            // Ruta de destino para la imagen
            $directorio = dirname(__DIR__) . '/public/assets/img/Img_perfil'; // Corregir la ruta del directorio
            $directorio_destino = str_replace('\\', '/', $directorio) . '/' . $imagenname;
            $url_Imagen = URL.'public/assets/img/Img_perfil/'. $imagenname;

            //Solo se permiten imagenes tipo JPG, JPEG, PNG
            if ($file_type == "jpg" || $file_type == "jpeg" || $file_type == "png") {
                // Mover la imagen al directorio de destino
                move_uploaded_file($url_temp, $directorio_destino);

                // Actualizar los datos en el modelo
                $data = $this->getModel()->actualizarPerfil($nombre, $telefono, $direccion, $descripcion, $url_Imagen);
                if ($data == 'ok') {
                    // Actualizar los datos en la session
                    $_SESSION['name'] = $nombre;
                    $_SESSION['phone'] = $telefono;
                    $_SESSION['adress'] = $direccion;
                    $_SESSION['description'] = $descripcion;
                    $_SESSION['profile_image'] = $url_Imagen;

                    $msg = array('msg' => 'Datos modificados', 'estado' => true, 'tipo' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar datos', 'estado' => false, 'tipo' => 'error');
                }
            } else {
                $msg = array('msg' => 'Solo se permiten imagenes tipo JPG, JPEG, PNG', 'estado' => false, 'tipo' => 'error');
            }
        } 
        echo json_encode($msg);
    }
}
