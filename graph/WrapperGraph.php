<?php
require_once 'jpgraph/src/jpgraph.php';
/**
 * @class Wrapper Graph for generate the JpGraph
 *
 * @author carlos belisario <carlos.belisario.gonzalez@gmail.com>
 * @version 1.0
 */
class WrapperGraph 
{    
    /**
     *
     * @var Graph 
     */
    private $jpgrap;
    
    /**
     *
     * @var array
     */
    private $size;
    
    /**
     *
     * @param String $typeGraph 
     * @param array $size array associative whit the key width and heigth     * 
     */
    public function __construct($typeGraph, array $size)
    {        
        require_once "jpgraph/src/$typeGraph.php";
        $this->size = $size;
        $this->jpgrap = new Graph($size['width'], $size['height']);        
    }
           
    /**
     *
     * @param array $data  data of the graph    
     * @param bool $show if true shows the graph, otherwise save the graphic in a image archive
     * @param $graphName name of the graph for save
     * @return void 
     * @generate the LineGraph
     */
    public function createLineGraph(array $data, $show = true, $graphName = 'LineGraph')
    {        
        $this->jpgrap->SetScale('intlin');
        if(isset($data['title'])) {
            $this->jpgrap->title->set($data['title']);
        }
        $linePlot = new LinePlot($data);
        $this->jpgrap->Add($linePlot);
        if($show) {
            $this->jpgrap->Stroke();
        } else {
            $this->jpgrap->Stroke($graphName . 'png');
            return $nameGraph . ".png";
        }
    }        
    
    /**
     *
     * @param array $datas array whit the data for the graph
     * @param type $show show the graph in the web browser or save this in a file
     * @param type $nameGraph name of the file of save
     * @return type string $nameGraph
     */
    public function createPieGrap(array $datas, $show = true, $nameGraph = 'PieGraph')
    {   
        require_once 'jpgraph/src/jpgraph_pie3d.php';
        foreach ($datas as $key => $value){
            $data[] = $value[0];
            $nombres[] = $key; 
            $color[] = $value[1];
        }                         
        
        $graph = new PieGraph($this->size['width'], $this->size['height']);        
        if(!empty($titulo)){
            $graph->title->Set($titulo);
        }   
        //Create the plot 3D
        $p1 = new PiePlot3D($data);
        //set the colors
        $p1->SetSliceColors($color);        
        $p1->SetLegends($nombres);        
        $graph->Add($p1);        
        if($show) {
            $graph->Stroke();         
        } else {
            $graph->Stroke("$nameGraph.png");         
            return $nameGraph . ".png";
        }        
    }
    
    public function createBarGraph(array $datas, array $yaxisScale)
    {        
        foreach($datas as $key => $value) {
            $data[] = $value;
            if(!is_null($key)) {
                $xasisName[] = $key;
            }
        }
        
        $this->jpgrap->SetScale('textlin');
        $this->jpgrap->yaxis->SetTickPositions($yaxisScale);
        $this->jpgrap->SetBox(false);        
        $this->jpgrap->ygrid->setFill(false);
        $this->jpgrap->xaxis->setTickLabels($xasisName);
        
        
        //$this->jpgrap->xaxis->scale->ticks->SetSize(20,3);
        $this->jpgrap->yaxis->HideLine(false);
        $this->jpgrap->yaxis->HideTicks(false, false);
        
        $barPlot = new BarPlot($data);
        $this->jpgrap->Add($barPlot);
        
        $barPlot->SetColor("white");
        $barPlot->SetFillGradient("#1188ff","white",GRAD_LEFT_REFLECTION);
        $barPlot->SetWidth(45);
        $this->jpgrap->title->Set("Bar Gradient(Left reflection)");

        // Display the graph
        $this->jpgrap->Stroke();
    }
    
}       
$graph = new WrapperGraph('jpgraph_bar', array('width' => 350, 'height' => 250));
$data = array('diciembre enero'=>62,'b'=>105,'c' => 85,'d' =>50);
$graph->createBarGraph($data, array(0,30,60,90,120,150));
?>
