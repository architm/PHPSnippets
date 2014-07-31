<html>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#customers td, #customers th {
    font-size: 1em;
    border: 1px solid #98bf21;
    padding: 3px 7px 2px 7px;
}

#customers th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #A7C942;
    color: #ffffff;
}

#customers tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}
</style>
<body>
<form name="input" action="" method="post">
<table>
<tr><td>
Your username: </td><td><input type="text" name="user1" /></td></tr>
<tr><td>
Username with which you want to compare: </td><td><input type="text" name="user2" /></td></tr>
<tr><td>
<input type="submit" value="compare" name="compare" /></td></tr>
</form>

<?php
if(isset($_POST['compare'])){
$u1=$_POST['user1'];
$u2=$_POST['user2'];
$r1=array();
$r2=array();
$diff=array();
$inter=array();
$ulink1="http://www.spoj.com/users/".$u1."/";
$ulink2="http://www.spoj.com/users/".$u2."/";
$file_contents = file_get_contents($ulink1);
$file_contents2 = file_get_contents($ulink2);
 //echo $file_contents2;
 //$file=htmlentities($file_contents);
/*preg_match_all ('/(http:\/\/)(.*\/)/', "kvnklvnjlkvnkj http://www.tipsntutorials.com/ fjifj hjhvjjnjv http://www.tipsntutorials.com/", $matchesarray);
echo $matchesarray[0][0];
//echo $matchesarray[1][0];*/
preg_match_all('/(<td align="left" width="14%"><a href=")(.*)(<\/a><\/td>)/',
    $file_contents,
    $out, PREG_PATTERN_ORDER);
preg_match_all('/(<td align="left" width="14%"><a href=")(.*)(<\/a><\/td>)/',
    $file_contents2,
    $out2, PREG_PATTERN_ORDER);
//echo $out[0][0] . ", " . $out[0][1] . "\n";
//echo $out[1][0] . ", " . $out[1][1] . "\n";
//sort($out[2]);
//echo '<pre>';
$i=0;
foreach ($out[2] as $problems)
  {
  //echo "<b>".$problems."</b><br/>";
     $pos = strpos($problems, '>');
  $r1[$i]=substr($problems, $pos+1);
$i++;
  //preg_match('/(<td align="left" width="14%"><a href="/"status/")(.*)(<\/a><\/td>)/',$problems,$res);
  //echo $res.'<br/>';
  }
  $i=0;
foreach ($out2[2] as $problems)
  {
  //echo "<b>".$problems."</b><br/>";
     $pos = strpos($problems, '>');
  $r2[$i]=substr($problems, $pos+1);
$i++;
  //preg_match('/(<td align="left" width="14%"><a href="/"status/")(.*)(<\/a><\/td>)/',$problems,$res);
  //echo $res.'<br/>';
  }
 /* sort($r1);
  sort($r2);
  $c1=count($r1);*/
  $c2=count($r2);
  //echo '<pre>';
    //$diff = array_diff($r1, $r2);
	$inter=array_intersect($r1,$r2);
	$j=0;
	for($i=0;$i<$c2;$i++)
	{
		if(array_search($r2[$i],$r1)===false)
		{
			$diff[$j]=$r2[$i];
			$j++;
		}
	}

	echo "<table id='customers'><tr><th>The problems which you haven't solved are:</th></tr>";
$i=10;
$turn=0;
	foreach ($diff as $pr)
  {
        if($i == 10) {
        if($turn == 0) {
        echo "<tr>";
        $turn = 1;
        }   
        else {
        echo "<tr class='alt'>";
        $turn = 0;
        }
    
        $i = 0;
        } 
		$link="http://www.spoj.com/status/".$pr.",".$u2."/";
       echo "<td><b><a href=$link>".$pr."</a></b></td>";
       $i++;
	  //  http://www.spoj.com/status/DCEPC505,architiiita/
       if($i == 0)
       echo "</tr>";
   }
$i=10;
$turn=0;
echo "</table>";
   echo "<table id='customers'><tr><th>The problems which are solved by both of you are: </th></tr>";
   foreach ($inter as $pr)
  {
       if($i == 10) {
        if($turn == 0) {
        echo "<tr>";
        $turn = 1;
        }   
        else {
        echo "<tr class='alt'>";
        $turn = 0;
        }
        $i = 0;
        } 
       $link="http://www.spoj.com/problems/".$pr."/";
       echo "<td><b><a href=$link>".$pr."</a></b></td>";
	  
   }
echo "</table>";
}
?>
</body>
</html>