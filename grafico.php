<?php 
require_once 'graph/MyWrapperGraph.php';
$graphSize = array('width' => 500, 'height' => 400);
$data = array('aprobados'=>array(1,'red'),'reprobados'=>array(1,'blue'), 'otra cosa' => array(1, 'green'), 'otra cosa mas larga' => array(5, 'brown'));
$graph = new MyWrapperGraph('jpgraph_pie');
$graph->setData($data);
$graph->createPieGrap();
