<?php
require 'fpdf/fpdf.php';
/**
 *
 * class for generate the PDF
 * @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
 * @version 2.0
 */
class Pdf extends FPDF
{    
    
    public function __construct($orientation='P', $unit='mm', $format='A4')
    {
        parent::__construct($orientation, $unit, $format);
    } 
    
    public function graphPdf(array $data, array $locationImage, array $graphSize)
    {
        $graph = new MyWrapperGraph('jpgraph_pie', $graphSize);
		$graph->setData($data);
		$graph->setSize($graphSize);
        $graphName = $graph->createPieGrap(false, '', 'grafico_imagen');
        $this->Image("$graphName", $locationImage[0], $locationImage[1], $locationImage[2], $locationImage[3]);
    }
}
?>
