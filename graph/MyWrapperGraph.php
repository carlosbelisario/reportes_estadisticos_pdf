<?php
require_once 'jpgraph/src/jpgraph.php';
/**
 * class MyWrapperGraph
 *
 * @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
 * @version 2.0
 */
class MyWrapperGraph 
{
    /**
     *
     * @var jpgraph/Graph
     */
    private $jpgraph;
    
    /**
     *
     * @var array 
     */
    private $data;
    
    /**
     *
     * @var array 
     */
    private $size;
    
    /**
     *
     * @var array
     */
    private $style;


    public function __construct(){}    
    
    /**
     *
     * @return array|
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     *
     * @param array $style
     * @return \MyWrapperGraph 
     */
    public function setStyle(array $style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     *
     * @return Graph 
     */
    public function getJpgraph()
    {
        return $this->jpgraph;
    }
    
    /**
     *
     * @param Graph $jpgrap 
     */
    public function setJpgraph(Graph $jpgrap = null) 
    {
        if(is_null($jpgrap)) {            
            $this->jpgraph = new Graph($this->size['width'], $this->size['height']);
        }else {
            $this->jpgraph = $jpgrap;
        }
        return $this;
    }
    /**
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     *
     * @param array $data 
     */
    public function setData(array $data)
    {
        foreach($data as $k => $v) {
            if(!is_numeric($k)) {
                $keys[] = $k;
            }
            $value[] = $v;
        }
        if(!empty($keys)) {
            $this->data =  array(
                'labels' => $keys,
                'values' => $value
            );
        } else {
            $this->data = array('values' => $value);
        }
        return $this;
    }
    
    /**
     *
     * @return array
     */
    public function getSize()
    {
        return $this->size;       
    }
    

    /**
     *
     * @param array $size 
     * @throws Exception 
     */
    public function setSize(array $size)
    {
        if(!array_key_exists('width', $size) || !array_key_exists('height', $size)) {
            throw new Exception("the array does not contain the necessary keys");
        } else {
            $this->size = $size;
        }
        return $this;
    }
    
    

     /**
     *
     * @param bool $show
     * @param String $title
     * @return String
     * @throws Exception if the $data is empty
     */
    public function createPieGrap($show = true, $title = '', $nameGraph = '')
    {
        require_once "jpgraph/src/jpgraph_pie.php";        
        require_once 'jpgraph/src/jpgraph_pie3d.php';
        
        if(empty($this->data)) {
            throw new Exception("the atribute data is empty");
        } 
        $size = $this->getSize();        
        $datas = $this->getData();
        $graph = new PieGraph($size['width'], $size['height']);
        if(!empty($titulo)) {
            $graph->title->Set($titulo);
        }
        foreach($datas['values'] as $val) {            
            $colors[] = $val[1];
            $data[] = $val[0];
        }        
        $pie3dPlot = new PiePlot3D($data);        
        $pie3dPlot->SetSliceColors($colors);        
        $pie3dPlot->SetLegends($datas['labels']);        
        $pie3dPlot->SetLabelMargin(15);
        $graph->Add($pie3dPlot);        
        
        if($show) {
            $graph->Stroke();         
        } else {
            $graph->Stroke("$nameGraph.png");         
            return $nameGraph . ".png";
        }        
        
    }
    
    /**
     *
     * @param bool $show if is true show the graph else save the graph
     * @param string $title title of the graph 
     * @param string $nameGraph name for save the file
     * @return string or graph-image
     * @throws Exception if the data is empty
     */
    public function createLineGraph($show = true, $title = '', $nameGraph = '')
    {
        require_once "jpgraph/src/jpgraph_line.php";        
        if(empty($this->data)) {
            throw new Exception("The data is empty");
        }
        $graph = $this->getJpgraph();
        $graph->SetScale('intlin');
        if(!empty($titulo)) {
            $graph->title->Set($title);
        }
        $data = $this->getData();
        $linePlot = new LinePlot($data['values']);
        $graph->Add($linePlot);
        if($show) {
            $graph->Stroke();
        } else {
            $graph->Stroke($graphName . 'png');
            return $nameGraph . ".png";
        }
    }
    
    /**
     *
     * @param array $yaxisScale
     * @param bool $show
     * @param string $title
     * @param string $nameGraph
     * @return string or image-graph
     * @throws Exception 
     */
    public function createBarGraph(array $yaxisScale = array(0,30,60,90,120,150), $show = true, $title = '', $nameGraph = '')   
    {
        require_once 'jpgraph/src/jpgraph_bar.php';
        if(empty($this->data)) {
            throw new Exception("The data is empty");
        }
        $data = $this->getData();
        $graph = $this->getJpgraph();
        $graph->SetScale('textlin');        
        $graph->yaxis->SetTickPositions($yaxisScale);
        $graph->SetBox(false);        
        $graph->ygrid->setFill(false);
//        echo $data['labels'];
        $graph->xaxis->setTickLabels($data['labels']);
        if(!empty($titulo)) {
            $graph->title->Set($title);
        }        
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false, false);
        
        $barPlot = new BarPlot($data['values']);
        $graph->Add($barPlot);
        
        $barPlot->SetColor("white");
        $style = $this->getStyle();
        $barPlot->SetFillGradient($style['color'],$style['gradient'],GRAD_LEFT_REFLECTION);
        $barPlot->SetWidth(45);
        if($show) {
            $graph->Stroke();
        } else {
            $graph->Stroke($graphName . 'png');
            return $nameGraph . ".png";
        }    
    }
}
?>
