<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>$webtitle</title>
<link rel="stylesheet" type="text/css" href='/css/main.css' media="screen" />
</head>

<body>
    <?php $this->load->view('header'); ?>
    <div id="container">
        <div id="left">
<?php echo $menu; ?>
</div>
        <div id="right">
<table>
    <tr>
        <th>Name</th>
        <th>Class</th>
        <th>DKP</th>
    </tr>
<?php 
 foreach ($Characters as $Character) 
{
    switch($Character->class)
    {
        case 1: $Class = "Warrior"; $Color = "RED"; break;
        case 2: $Class = "Mage";    $Color = "PURPLE"; break;
        case 3: $Class = "Cleric";  $Color = "GREEN"; break;
        case 4: $Class = "Rogue";   $Color = "YELLOW"; break;    
        default : $Class ="N/A";    $Color = "PINK"; break;    
    }
     
     
    echo "<tr style=\"color: $Color;\"><td>";
    echo $Character->name;
    echo "</td><td>";
    echo $Class;
    echo "</td><td>";
    echo $Character->DKP;
    echo "</td></tr>";
}   
    
    ?>
</table>
            
        </div>

<p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
</body>
</html>