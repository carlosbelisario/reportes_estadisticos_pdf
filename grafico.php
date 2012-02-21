<?php 
require_once 'graph/WrapperGraph.php';
$graphSize = array('width' => 500, 'height' => 400);
$data = array('aprobados'=>array(1,'red'),'reprobados'=>array(1,'blue'), 'otra cosa' => array(1, 'green'), 'otra cosa mas larga' => array(5, 'brown'));
$graph = new WrapperGraph('jpgraph_pie', $graphSize);
$graph->createPieGrap($data);
