<?php
require_once 'MyWrapperGraph.php';
$graph = new MyWrapperGraph();
$graph->setSize(array('width' => 700, 'height' => 600));
$graph->setJpgraph();
//test line
//array whit the value of the line
$data = array(1,2,3,2,5,1);
$graph->setData($data);
//$graph->createLineGraph();
//
//test pie
//array assoc whit the label=>array(value, color pie)
$data1 = array('menor a 10 años'=>array(10,'green'),'desde 11 hasta 15 años'=>array(33,'red'), 'de 16 a 20 años'=>array(43,'green'), 'despues de 20 años'=>array(14,'green'));
$graph->setData($data1);
$graph->createPieGrap(true,'','edadesanorexia');
//
//test bar
//array assoc whit the label => value to show in the graph
$data2 = array( 'cuatro' => 4, 'cinco' =>56, 'seis' =>7, 'siete' =>8, 'ocho' =>1);
$graph->setData($data2);
$graph->setStyle(array('color' => '#1188ff', 'gradient' => 'white'));
//$graph->createBarGraph();
