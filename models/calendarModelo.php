<?php 
class CalendarModelo extends Model
	{
		public function __construct()
		{
			parent:: __construct();
		}
		public function listarH($userID){
            $db = $this->getDB()->conectar();
            $datos = mysqli_query($db, "select * from tbl_horario WHERE id_usuario ='".$userID."'");
            return $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        
        }
        public function agregar($title, $start, $end, $duration, $ticket, $client, $site, $typeact, $description, $userid){
            $sql = "INSERT INTO tbl_horario (id, title, start, end, duration, ticket, id_client, id_site, id_activity, description, id_usuario) VALUES (NULL, '".$title."', '".$start."', '".$end."', '".$duration."', '".$ticket."', '".$client."', '".$site."', '".$typeact."', '".$description."', '".$userid."')";
			$db = $this->getDB()->conectar();
			$result = $db->query($sql);
				if ($result) {
					$res = 'ok';
				}else{
					$res = 'error';
				}
			return $res;         
		}
        public function modificar($id, $title, $start, $end, $duration, $ticket, $client, $site, $typeact, $description){ 
            $sql = "UPDATE `tbl_horario` SET title='".$title."', start='".$start."', end='".$end."', ticket='".$ticket."', id_client= '".$client."', id_site= '".$site."', description='".$description."', id_activity='".$typeact."' duration='".$duration."' WHERE id='".$id."'";
            $db = $this->getDB()->conectar();
			$result = $db->query($sql);
				if ($result) {
					$res = 'ok';
				} else {
					$res = 'error';
				}
			return $res;
		}
        public function borrar($id){
            $sql = "DELETE FROM tbl_horario WHERE id='".$id."'";
            $db = $this->getDB()->conectar();
			$result = $db->query($sql);
				if ($result) {
					$res = 'ok';
				} else {
					$res = 'error';
				}
			return $res;

		}
		public function dragOver($start, $end, $id, $duration){
        $sql = "UPDATE tbl_horario SET start='".$start."', end='".$end."' duration='".$duration."' WHERE id='".$id."'";
		$db = $this->getDB()->conectar();
		$result= $db->query($sql);
			if ($result) {
				$res = 'ok';
			} else {
				$res = 'error';
			}
			return $res;
    	}
		public function listar_catalogos($tabla){
				if ($tabla == 'cliente') {
					$db = $this->getDB()->conectar();
					$datos = mysqli_query($db, "select * from tbl_cliente");					
				} elseif ($tabla == 'sitio') {
					$db = $this->getDB()->conectar();
					$datos = mysqli_query($db, "select * from tbl_lugar");			
				}elseif ($tabla == 'actividad') {
					$db = $this->getDB()->conectar();
					$datos = mysqli_query($db, "select * from tbl_actividad");				
				}
				return $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
            
        }


	}
 ?>