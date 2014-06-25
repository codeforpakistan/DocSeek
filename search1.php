<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src='js/jquery.js'></script>
    <script src='js/bootstrap.min.js'></script>
    <style>
    body{
        background-color: #fff;
    }
    </style>
</head>
<body>
	<?php
    $con = mysql_connect("localhost","root","");
    if (!$con)
    {
    die('Could not connect: ' . mysql_error());
    }
    
    
    echo "</br>";
    echo "</br>";
    echo "</br>";
    echo "</br>";
    mysql_select_db('kpithrd',$con);
    $var = $_REQUEST['namefield'];
    $Sub=$_REQUEST['Submit'];
    mysql_query("alter table personnel add ratings int");


    $str=explode(" ",$var);
    $temp=$str[0];
    for($i=1;$i<sizeof($str);$i++)
    {
    
    $temp.=(' '.$str[$i]);
    
    }


    if(isset($Sub))
    {
        
    $result = mysql_query("SELECT Distinct FullName, PlaceofCurrentPosting FROM personnel WHERE (Cadre LIKE '$temp%')");
    echo "<table>";
    while($row = mysql_fetch_array($result))
    {
        // echo '<div class="container">';
        // echo '<div class="col-md-3">';
        // echo '</div>';
        // echo '<div class="col-md-6">';
        // echo '<ul class="list-group">';
        // echo '<li class="list-group-item">'. $row['FullName'] . '</li>';
        // echo "</br>";
        // echo '</ul>';
        // echo '</div>';
        // echo '<div class="col-md-3">';
        // echo '</div>';
        // echo '</div>';





    	echo "<tr><td><a href=list.php>$row[FullName]</a></td><td>$row[PlaceofCurrentPosting]</td></tr>";
 
    }

    echo '</table>';
	}
    mysql_close($con);
    ?>
</body>
</html>