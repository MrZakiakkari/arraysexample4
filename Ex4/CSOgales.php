<?php
$names = array();
$name = array("Mayo","Kerry","Dublin","Cork","Galway","Donegal","Westmeath","Waterford","Clare");
$averages = array();
$monthMax = array("Jan"=> 0,"Feb"=>0,"Mar"=>0,"Apr"=>0,"May"=>0,"Jun"=>0,"Jul"=>0,"Aug"=>0,"Sep"=>0,"Oct"=>0,"Nov"=>0,"Oct"=>0,"Nov"=>0,"Dec"=>0);
$monthMaxName = array("Jan"=>"","Feb"=>"","Mar"=>"","Apr"=>"","May"=>"","Jun"=>"","Jul"=>"","Aug"=>"","Sep"=>"","Oct"=>"","Nov"=>"","Dec"=>"");
$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

fillArray($names,$name);
printArray1($names,$months);
nameAverages($names,$averages);
printArray2($names,$averages,$months);
findmonthMax($names,$monthMax,$monthMaxName);
printArray3($names,$averages,$monthMaxName,$months);
popularity($averages);
echo"<head>
<style>
table, th, td {
  border: 1px solid black; 
  border-collapse: collapse;
}
</style>
</head>
<body>"; // for table formatting
        
function fillArray(&$names,$name){
	for($i=0; $i<9;$i++){
		$eachName=$name[$i];
		$names[$eachName]=array("Jan"=>rand(30, 100),"Feb"=>rand(30, 100),"Mar"=>rand(30, 100),"Apr"=>rand(30, 100),
								"May"=>rand(30, 100),"Jun"=>rand(30, 100),"Jul"=>rand(30, 100),"Aug"=>rand(30, 100),
								"Sep"=>rand(30, 100),"Oct"=>rand(30, 100),"Nov"=>rand(30, 100),"Dec"=>rand(30, 100));
	}
}
function printArray1($names,$months)
{	echo "<h3>Array Just After Fill</h3>";
	echo "<table><tr><th></th>";
	foreach($months as $month){
		echo "<th>".$month."</th>";
	}
	echo "</tr><tr>";
	foreach($names as $name=>$counts)
	{	echo "<td>".$name."</td>";
		foreach($counts as $month=>$value)
		{	echo "<td>".$value."</td>";
		}
		echo "</tr>";
	}
	echo "</table><br/>";
}
function nameAverages($names,&$averages){ // for averages in each row
	$average = 0;
	$totalnames = 0;
	foreach($names as $name=>$counts){
		foreach($counts as $month=>$value){
			$totalnames = $totalnames + $value;
		}
		$average = $totalnames/count($counts);
		$averages[$name] = $average;
		$totalnames = 0;
	}
}
function printArray2($names,$averages,$months)
{	echo "<h3>Array with Averages<h3/>";
	echo "<table><tr><th></th>";
	foreach($months as $month){
		echo "<th>".$month."</th>";
	}
	echo "<th>Average</th></tr><tr>";
	foreach($names as $name=>$counts)
	{	echo "<td>".$name."</td>";
		foreach($counts as $month=>$value)
		{	echo "<td>".$value."</td>"; 
		}
		echo "<td>".round($averages[$name],2)."</td>";
		echo "</tr>";
	}
	echo "</table><br/>";
}
function findmonthMax($names,&$monthMax,&$monthMaxName){ // to find a each month maximum value
	foreach($names as $name=>$counts){
		foreach($counts as $month=>$value){
			if ($value > $monthMax[$month]){
				$monthMax[$month] = $value;
				$monthMaxName[$month] = $name;
			}
		}
	}
}
function printArray3($names,$averages,$monthMaxName,$months)
{	echo "<h3>Array with Maximums</h3>";
	echo "<table><tr><th></th>";
	foreach($months as $month){
		echo "<th>".$month."</th>";
	}
	echo "<th>Average</th></tr><tr>";
	foreach($names as $name=>$counts)
	{	echo "<td>".$name."<img src=images/".$name.".jpg /></td>"; //how to uplaud images
		foreach($counts as $month=>$value)
		{
			if($value < $averages[$name])
			echo ("<td><font color=\"red\">" .$value."</font></td>"); //codes for colouring red for lower and green for higher
		else 
			 echo ("<td><font color=\"green\">" .$value."</font></td>"); 
		}
		echo "<td>".round($averages[$name],2)."</td>";
		echo "</tr>";
	}
	echo "</table><br/>";
	echo("<br/>Max Names: ");
	foreach($monthMaxName as $month=>$value)
	{	echo $month . " = " . $value.".\t";
	}
}
function popularity($averages) // codes for listing stations that has higher values then putting them in decreasing order
{	echo "<h3>Ranking Names by Popularity</h3>";
	echo "<h4>average array order as is</h4>";
	foreach($averages as $key=>$value)
	{	echo ($key . " " . round($value,2).". ");
	}
	echo "<h4>average array order sorted</h4>";
	arsort($averages);
	foreach($averages as $key=>$value)
	{	echo ($key . " ". round($value,2).". ");
	}
	echo "<h4>rank order</h4>";
	$rank =1;
	foreach($averages as $key=>	$value)
	{	echo $rank . " = " . $key.". ";
		$rank++;
	}
}
?>