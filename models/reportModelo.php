<?php
class reportModelo extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_data()
	{
		$db = $this->getDB()->conectar();
		$datos = mysqli_query($db, "SELECT * FROM vista_horario"); // CREATE VIEW `vista_horario` AS SELECT h.id, h.title, h.start, h.end, h.duration, h.ticket, c.name AS client_name, l.site AS site_name, h.description, a.activity AS activity_name, u.name AS user_name FROM `tbl_horario` h LEFT JOIN `tbl_cliente` c ON h.id_client = c.id LEFT JOIN `tbl_lugar` l ON h.id_site = l.id LEFT JOIN `tbl_actividad` a ON h.id_activity = a.id LEFT JOIN `tbl_usuario` u ON h.id_usuario = u.id;

		return $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
	}
}

