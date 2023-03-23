<?php
    class calendar extends Controller{
        public function __construct() {
            parent::__construct();
            session_start();
            if (isset($_SESSION['userId'])) {
                    
            }else{
                header("Location: http://localhost/myapp/login/index");
            }
        }
        public function calendar_v(){
            $this->getView()-> title = "Horarios | SF";
            $pagina = 'calendar_v';
            $this->getView()->loadView($pagina);
        }
        public function listar(){
            $userID = $_SESSION['userId'];
            $datos = $this->getModel()->listarH($userID);

            echo json_encode($datos);
        }
        public function registrar(){
            if (isset($_POST)) {
                if (empty($_POST['title']) || empty($_POST['datestart'])) {
                }else{
                    $title = $_POST['title'];
                    $datestart = $_POST['datestart'];
                    $timestart = $_POST['timestart'];
                    $timeend = $_POST['timeend'];
                    $ticket = $_POST['ticket'];
                    $client = $_POST['client'];
                    $site = $_POST['site'];
                    $typeact = $_POST['typeact'];
                    $description = $_POST['description'];
                    $id = $_POST['id'];
                    
                    $start = $datestart.' '.$timestart.':00';
                    $end = $datestart.' '.$timeend.':00'; 
                    $starttime = new DateTime($timestart);
                    $endtime = new DateTime($timeend);                   
                    $duration = $starttime->diff($endtime);
                    $userid = $_SESSION['userId'];

                    if ($id == '') {
                        $data = $this->getModel()->agregar($title, $start, $end, $duration, $ticket, $client, $site, $typeact, $description, $userid);
                        if ($data == 'ok') {
                            $msg = array('msg' => 'Actividad Registrada', 'estado' => true, 'tipo' => 'success');
                        }else{
                            $msg = array('msg' => 'Error al Registrar', 'estado' => false, 'tipo' => 'error');
                        }
                    } else {
                        $data = $this->getModel()->modificar($id, $title, $start, $end, $duration, $ticket, $client, $site, $typeact, $description);
                        if ($data == 'ok') {
                            $msg = array('msg' => 'Actividad Modificada', 'estado' => true, 'tipo' => 'success');
                        } else {
                            $msg = array('msg' => 'Error al Modificar', 'estado' => false, 'tipo' => 'error');
                        }
                    }
                    
                }
                echo json_encode($msg);
            }
            
        }
        public function eliminar($id){
            $data = $this->getModel()->borrar($id);
            if ($data == 'ok') {
                $msg = array('msg' => 'Evento Eliminado', 'estado' => true, 'tipo' => 'success');
            } else {
                $msg = array('msg' => 'Error al Eliminar', 'estado' => false, 'tipo' => 'error');
            }
            echo json_encode($msg);
            
        }
        public function drag(){
            $id = $_POST['id'];
            $dateend = $_POST['dateend'];
            $datestart = $_POST['datestart'];
            $timestart = $_POST['timestart'];
            $timeend = $_POST['timeend'];


            $start = $datestart.' '.$timestart.':00';
            $end = $dateend.' '.$timeend.':00';
            $starttime = new DateTime($timestart);
            $endtime = new DateTime($timeend);                   
            $duration = $starttime->diff($endtime);

            $data = $this->getModel()->dragOver($start, $end,  $id, $duration);
            if ($data == 'ok') {
                $msg = array('msg' => 'Evento Modificado', 'estado' => true, 'tipo' => 'success');
            } else {
                $msg = array('msg' => 'Error al Modificar', 'estado' => false, 'tipo' => 'error');
            }
        
            echo json_encode($msg);
        
        }
        public function listar_catalogos($tabla){
            $datos = $this->getModel()->listar_catalogos($tabla);
            echo json_encode($datos);
        }
    }
?>