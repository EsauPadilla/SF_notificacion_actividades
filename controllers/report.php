<?php

require_once('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class report extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (isset($_SESSION['userId']) && $_SESSION['rolId'] == 1) { // Redirige al usuario a la página del calendario si no hay una sesión activa y no tiene los permisos de rol de admin
        } else {
            header("Location: ".URL."calendar/calendar_v");
            exit;// Finaliza la ejecución del script después de la redirección
        }
    }
    public function generar_reporte()
    {
        // Obtener los datos de la bd.
        $data = $this->getModel()->get_data();


        // Crear una hoja de cálculo y AJUSTAR CABESERA Y TAMAÑO DE COLUMNAS
        $hojaCalculo = new Spreadsheet();
        $hojaCalculo->getActiveSheet()->getColumnDimension('A')->setWidth(20); // Ancho de la columna A
        $hojaCalculo->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $hojaCalculo->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $hojaCalculo->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $hojaCalculo->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $hojaCalculo->getActiveSheet()->getColumnDimension('H')->setWidth(40);
        $hojaCalculo->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $hojaCalculo->getActiveSheet()->getColumnDimension('J')->setWidth(15);

        $hojaCalculo->getActiveSheet()->setCellValue('A1', 'Titulo actividad');
        $hojaCalculo->getActiveSheet()->setCellValue('B1', 'Fecha y hora de inicio');
        $hojaCalculo->getActiveSheet()->setCellValue('C1', 'Fecha y hora de fin');
        $hojaCalculo->getActiveSheet()->setCellValue('D1', 'Duracion (min)');
        $hojaCalculo->getActiveSheet()->setCellValue('E1', 'Tiket');
        $hojaCalculo->getActiveSheet()->setCellValue('F1', 'Cliente');
        $hojaCalculo->getActiveSheet()->setCellValue('G1', 'Lugar');
        $hojaCalculo->getActiveSheet()->setCellValue('H1', 'Descripcion');
        $hojaCalculo->getActiveSheet()->setCellValue('I1', 'Actividad');
        $hojaCalculo->getActiveSheet()->setCellValue('J1', 'Usuario');

        // Cambiar el color de fondo de la cabecera
        $styleArray = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '003366',
                ],
            ],
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
            ],
        ];
        $hojaCalculo->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);


        $row = 2; // La primera fila se usa para las cabeceras, así que empezamos en la segunda fila
        foreach ($data as $dato) { //se llena la hoja de calculo con los datos obtenidos
            $hojaCalculo->getActiveSheet()->setCellValue('A' . $row, $dato['title']);
            $hojaCalculo->getActiveSheet()->setCellValue('B' . $row, $dato['start']);
            $hojaCalculo->getActiveSheet()->setCellValue('C' . $row, $dato['end']);
            $hojaCalculo->getActiveSheet()->setCellValue('D' . $row, $dato['duration']);
            $hojaCalculo->getActiveSheet()->setCellValue('E' . $row, $dato['ticket']);
            $hojaCalculo->getActiveSheet()->setCellValue('F' . $row, $dato['client_name']);
            $hojaCalculo->getActiveSheet()->setCellValue('G' . $row, $dato['site_name']);
            $hojaCalculo->getActiveSheet()->setCellValue('H' . $row, $dato['description']);
            $hojaCalculo->getActiveSheet()->setCellValue('I' . $row, $dato['activity_name']);
            $hojaCalculo->getActiveSheet()->setCellValue('J' . $row, $dato['user_name']);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($hojaCalculo);
        $filename = 'reporte.xlsx';
        $writer->save($filename);

        // Descargar el archivo
        header('Content-Type: application/vnd.ms-excel'); // Establece el tipo de contenido del encabezado como un archivo de Excel.
        header('Content-Disposition: attachment; filename="'.basename($filename).'"'); // Indica al navegador que se debe descargar el archivo y establece el nombre del archivo.
        header('Content-Transfer-Encoding: binary'); // Especifica que la codificación de transferencia del archivo es binaria.
        header('Expires: 0'); // Indica que el archivo expira inmediatamente y no se almacenará en la memoria caché del navegador.
        header('Cache-Control: must-revalidate'); // Indica al navegador que debe validar el archivo en cada solicitud.
        header('Pragma: public'); // Indica al navegador que el archivo se puede almacenar en caché.
        header('Content-Length: ' . filesize($filename)); // Establece la longitud del contenido del archivo.
        ob_clean(); // Limpia el búfer de salida para asegurarse de que no haya ningún contenido anterior enviado al navegador.
        flush(); // Envía cualquier contenido almacenado en el búfer de salida al navegador.
        readfile($filename); //Lee el contenido del archivo y lo envía al navegador.
        exit;
    }
}
