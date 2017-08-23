<?php
/**
 * Lee un archivo excel y lo pasa a un array
 */

namespace ExcelManipulationTools\Controller;

use PHPExcel_IOFactory;

class IndexController
{

    private $fileName;
    private $objExcel;
    private $sheetData;

    /**
     * Lee un archivo excel, obtiene la hoja activa, y llama al metodo getTablas
     * @param $fileName
     * @return array
     */
    public function main($fileName)
    {

        $this->fileName = $fileName;

        $this->objExcel = PHPExcel_IOFactory::load($this->fileName);

        $this->sheetData = $this->objExcel->getActiveSheet()->toArray(null, true, true, true);

        return $this->getTablas();

    }


    /**
     * Retorna en formato de tablas html
     * @return string
     */
    private function getTablas()
    {

        $cadena = "";

        foreach ($this->sheetData as $fila) {

            /*
            var_dump($fila);
            die;
            */

            $cadena = $cadena."<tr>";
            $renglon = "";
            foreach ($fila as $key => $value) {
                $renglon = $renglon."<td>".$value."</td>";
            }
            $cadena = $cadena.$renglon."</tr>";

        }

        /**
         * @todo ejemplo, conviene utilizar un motor de template (twig) y hojas de estilo (css) en implementacion real
         */
        return ("<table border='1'>".$cadena."</table>");

    }

}