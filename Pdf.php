<?php
namespace reportes_graficos_pdf;
use \reportes_graficos_pdf\FPDF;
/**
 *
 * class for generate the PDF
 * @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
 * @version 2.0
 */
class Pdf extends FPDF
{
    /**
     *
     * @var Graph $graph 
     */
    private $graph;
    
    public function __construct()
    {
        
    }
}

?>
