<?php
class calendar extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (isset($_SESSION['userId'])) { // Redirige al usuario a la página de inicio de sesión si no hay una sesión activa
        } else {
            header("Location: " . URL . "login/index");
            exit;// Finaliza la ejecución del script después de la redirección
        }
    }
    public function registrar_act() //funcion para lanzar la vista 
    {
        $this->getView()->title = "Horarios | SF"; //se le agrega un titulo a la vista 
        $pagina = 'calendar_v';  
        $this->getView()->loadView($pagina); //se carga la pagina pasandole la variable con el nobre de la vista
    }
    public function listar() // se obtienen los datos de todas las actividades del usiario iniciado
    {
        $userID = $_SESSION['userId'];
        $datos = $this->getModel()->listarH($userID);
        echo json_encode($datos);
    }
    public function registrar()
    {
        $msg = array();
        if (!empty($_POST['title']) && !empty($_POST['datestart']) && !empty($_POST['cliente'])&& !empty($_POST['sitio'])&& !empty($_POST['actividad']) && !empty($_POST['ticket'])) { //campos reqeridos para la insecion o modificacion de una actividad
            $title = $_POST['title'];
            $datestart = $_POST['datestart'];
            $timestart = $_POST['timestart'];
            $timeend = $_POST['timeend'];
            $ticket = $_POST['ticket'];
            $client = $_POST['cliente'];
            $site = $_POST['sitio'];
            $typeact = $_POST['actividad'];
            $description = $_POST['description'];
            $id = $_POST['id']; //id de actividad

            $start = $datestart . ' ' . $timestart . ':00'; // se completa el tipo de dato date-time
            $end = $datestart . ' ' . $timeend . ':00';

            $starttime = new DateTime($timestart);
            $endtime = new DateTime($timeend);
            $diferencia = $starttime->diff($endtime);
            $durationMinutos = ($diferencia->h * 60) + $diferencia->i;// se saca la diferencia en minutos entre en timpo de inicio y el final

            $userid = $_SESSION['userId'];//id de usuario

            if ($id == '') {// Agregar una nueva actividad si el id de act es vacio
                $data = $this->getModel()->agregar($title, $start, $end, $durationMinutos, $ticket, $client, $site, $typeact, $description, $userid);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Actividad Registrada', 'estado' => true, 'tipo' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Registrar', 'estado' => false, 'tipo' => 'error');
                }
            } else { // de lo contrario Modificar una actividad existente, con su id
                $data = $this->getModel()->modificar($id, $title, $start, $end, $durationMinutos, $ticket, $client, $site, $typeact, $description);
                if ($data == 'ok') {
                    $msg = array('msg' => 'Actividad Modificada', 'estado' => true, 'tipo' => 'success');
                } else {
                    $msg = array('msg' => 'Error al Modificar', 'estado' => false, 'tipo' => 'error');
                }
            }
        } else {
            $msg = array('msg' => 'No se recibieron datos requeridos', 'estado' => false, 'tipo' => 'error');
        }
        echo json_encode($msg); // se retorna el mensaje en json
    }
    public function eliminar($id) // eliminar dependiendo el id
    {
        $data = $this->getModel()->borrar($id);
        if ($data == 'ok') {
            $msg = array('msg' => 'Evento Eliminado', 'estado' => true, 'tipo' => 'success');
        } else {
            $msg = array('msg' => 'Error al Eliminar', 'estado' => false, 'tipo' => 'error');
        }
        echo json_encode($msg);
    }
    public function drag() // funcion para la modificacion de la actividad por medio de la vista, en el tamaño del tiempo y date
    {
        $id = $_POST['id'];
        $dateend = $_POST['dateend'];
        $datestart = $_POST['datestart'];
        $timestart = $_POST['timestart'];
        $timeend = $_POST['timeend'];


        $start = $datestart . ' ' . $timestart . ':00';
        $end = $dateend . ' ' . $timeend . ':00';
        $starttime = new DateTime($timestart);
        $endtime = new DateTime($timeend);
        $diferencia = $starttime->diff($endtime);
        $durationMinutos = ($diferencia->h * 60) + $diferencia->i;

        $data = $this->getModel()->dragOver($start, $end,  $id, $durationMinutos);
        if ($data == 'ok') {
            $msg = array('msg' => 'Evento Modificado', 'estado' => true, 'tipo' => 'success');
        } else {
            $msg = array('msg' => 'Error al Modificar', 'estado' => false, 'tipo' => 'error');
        }
        echo json_encode($msg);
    }
    public function listar_catalogos($tabla) // funcion para obtener los datos para bombos dependiendo de la tabla
    {
        $datos = $this->getModel()->listar_catalogos($tabla);
        echo json_encode($datos);
    }
}
