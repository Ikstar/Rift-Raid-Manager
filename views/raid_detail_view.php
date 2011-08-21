<?php $this->load->helper(array('url', 'date')); ?>
<!DOCTYPE html>
<html lang="en">
<html><head>
<link rel="stylesheet" type="text/css" href="<?php echo "/css/main.css"; ?> ">
<link rel="stylesheet" type="text/css" href="/css/humanity/jquery-ui-1.8.15.custom.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.8.15.custom.min.js"></script>
 <script type="text/javascript">
      function log( message ) {
			$( "<div/>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}
        $(document).ready(function(){
           
       		$('input').button();
	});
    
    </script>
</head>
<body>
    <?php $this->load->view('header'); ?>
    <div id="container">
        <div id="left">
<?php echo $menu; ?>
</div>
        <div id="right">
<?php  $DateString = "%F %j%S %Y";                    ?>
        <h2>Raid Details  for <?php echo $raiddetails->name ." on ".mdate($DateString,mysql_to_unix($raiddetails->raiddate));?></h2>
        <table id="raiddetails" style="width:100%;">
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Loot</th>
                <th>&nbsp</th>
            </tr>
            <?php foreach($raidroster->result() as $Character):?>
            <?php
                switch($Character->class)
    {
        case 1: $Class = "Warrior"; $Color = "RED"; break;
        case 2: $Class = "Mage";    $Color = "PURPLE"; break;
        case 3: $Class = "Cleric";  $Color = "GREEN"; break;
        case 4: $Class = "Rogue";   $Color = "YELLOW"; break;    
        default : $Class ="N/A";    $Color = "PINK"; break;    
    }            
                 switch($Character->Role)
    {
        case 1:  $Role = "Tank"; break;
        case 2:  $Role = "DPS"; break;
        case 3:  $Role = "Support"; break;
        case 4:  $Role = "Healer"; break;
        default:  $Role = "N/A"; break;
          
    }
    
    ?>
            <tr style="color:<?php echo $Color?>">
                <td><?php echo $Character->name ?></td>
                
                <td><?php echo $Role ?></td>
                <td><?php if ($Character->Loot) echo "<span class=\"ui-icon ui-icon-circle-check\">&nbsp;</span>" ?></td>
                <td><?php echo form_open('character/ShowCharacter','', array('name' => $Character->name)); ?><input type="submit" value="View"/></form></td>
                          </tr>
            <?php endforeach;?>
        </table>
        </div>
        <div id="spacer"></div>
<div id="footer">
    <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
</div>
</body>
</html>
