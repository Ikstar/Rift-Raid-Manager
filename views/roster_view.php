
<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php $webtitle ?></title>
<link rel="stylesheet" type="text/css" href='/css/main.css' media="screen" />
</head>

<body>
    <?php $this->load->view('header'); ?>
    <div id="container">
        <div id="left">
<?php echo $menu; ?>
</div>
        <div id="right">
            <table id="groups"> 
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Attendance</th>
                    <th>DKP</th>
                    <th>Updated</th>
                    <th>&nbsp;</th>
                </tr>
            <?php 
            foreach ($Roster as $Characters)
            {
                 switch($Characters->class)
    {
        case 0: $Class = "Warrior"; $Color = "RED"; break;
        case 1: $Class = "Mage";    $Color = "PURPLE"; break;
        case 2: $Class = "Cleric";  $Color = "GREEN"; break;
        case 3: $Class = "Rogue";   $Color = "YELLOW"; break;    
        default : $Class ="N/A";    $Color = "PINK"; break;    
    }
                echo "<tr style=\"color:$Color;\"><td>";
               
                echo $Characters->name;               
                echo "</td><td>";
                echo $Characters->role;              
                echo "</td><td>";
                echo $Characters->attendance;              
                echo "</td><td>";
                echo $Characters->DKP;
                echo "</td><td>";
                echo $Characters->updated;             
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </table>
        </div>
        
    <?php echo form_open('groups/editGroup'); ?>
        <input type="hidden" name="gid" value="<?php $GroupId ?>"/>
        <button name="submit" value="\submit">Edit Group</button>
    </div>
</div>
    <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
</body>
</html>
