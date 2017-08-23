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
     * @param $fileName
     * @return array
     */
    public function main($fileName)
    {

        $this->fileName = $fileName;

        $this->objExcel = PHPExcel_IOFactory::load($this->fileName);

        $this->sheetData = $this->objExcel->getActiveSheet()->toArray(null, true, true, true);

        return json_encode($this->sheetData);
    }

    /*
    public function __toString()
    {
        return serialize($this);

    }
    */

}