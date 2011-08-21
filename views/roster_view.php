<?php $this->load->helper(array('url','date')); ?>

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
            <h2>Current Roster for &quot;<?php echo $GroupName;?>&quot;</h2>
            <table id="groups"> 
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Attendance</th>
                    <th>Status</th>
                    <th>DKP</th>
                    <th>Updated</th>
                    <th>Joined</th>
                </tr>
            <?php 
            $DateString = "%F %j%S %Y";
             $RoleCheck = "";
             $StatusCheck = "";
            foreach ($Roster as $Characters)
            {


                 switch($Characters->class)
    {
        case 1: $Class = "Warrior"; $Color = "RED"; break;
        case 2: $Class = "Mage";    $Color = "PURPLE"; break;
        case 3: $Class = "Cleric";  $Color = "GREEN"; break;
        case 4: $Class = "Rogue";   $Color = "YELLOW"; break;    
        default : $Class ="N/A";    $Color = "PINK"; break;    
    }
    switch($Characters->status)
    {
        case 1:  $Status = "Active"; break;
        case 2:  $Status = "Waiting"; break;
        case 3:  $Status = "Inactive"; break;
        default :$Status = "N/A"; break;   
    }
     switch($Characters->role)
    {
        case 1:  $Role = "Tank"; break;
        case 2:  $Role = "DPS"; break;
        case 3:  $Role = "Support"; break;
        case 4:  $Role = "Healer"; break;
        default:  $Role = "N/A"; break;
          
    }
           if ($RoleCheck != $Characters->role || $StatusCheck != $Characters->status)
               {
if($StatusCheck != $Characters->status && $StatusCheck != "")
{
//echo "</table><table id=\"groups\">";
echo " <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Attendance</th>
                    <th>Status</th>
                    <th>DKP</th>
                    <th>Updated</th>
                    <th>Joined</th>
                </tr>";
}
echo "<tr><td colspan=\"7\" align=\"center\"><h3>$Role&nbsp;&mdash;&nbsp;$Status</h3></td></tr>";
               }
             $RoleCheck = $Characters->role;
             $StatusCheck = $Characters->status;
    $CSSClass = ($Characters->status == 3) ?  "ui-state-disabled" : "";
                echo "<tr style=\"color:$Color;\" class=\"$CSSClass\"><td>";
               
                echo $Characters->name;               
                echo "</td><td>";
                echo $Role;           
                echo "</td><td>";
                echo $Characters->attendance;              
                echo "</td><td>";
                echo $Status;
                echo "</td><td>";
                echo $Characters->DKP;
                echo "</td><td>";
                echo mdate($DateString,mysql_to_unix($Characters->updated));             
                echo "</td><td>";
                 echo mdate($DateString,mysql_to_unix($Characters->joined));             
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </table>
        </div>
        
    <?php echo form_open('groups/editGroup'); ?>
        <input type="hidden" name="idGroups" value="<?php echo $idGroups ?>"/>
        <button name="submit" value="\submit">Edit Group</button>
    </div>
</div>
<div id="spacer"></div>
<div id="footer">
    <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
</div>
</body>
</html>
