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
    
}
//$ydata = array(11,3,8,12,5,1,9,13,5,7);        
$wrapperGrap = new WrapperGraph('jpgraph_pie', array('width' => 350, 'height' => 250));
//$wrapperGrap->createLineGraph($ydata);
$data = array('aprobados'=>array(1,'red'),'reprobados'=>array(1,'blue'), 'otra vaina' => array(10, 'green'));
$wrapperGrap->createPieGrap($data);
        
?>
