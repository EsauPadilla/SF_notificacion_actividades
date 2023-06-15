<?php
class perfilModelo extends Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function actualizarPerfil($nombre, $telefono, $direccion, $descripcion, $url_Imagen)
	{
		$sql = "UPDATE tbl_usuario SET name = '$nombre', phone = '$telefono', adress = '$direccion', description = '$descripcion', img = '$url_Imagen' WHERE id = " . $_SESSION['userId'];
		$db = $this->getDB()->conectar();
		$result = $db->query($sql);
		if ($result) {
			$res = 'ok';
		} else {
			$res = 'error';
		}
		return $res;
	}
}
