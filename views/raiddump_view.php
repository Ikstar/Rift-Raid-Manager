<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>$webtitle</title>
<link rel="stylesheet" type="text/css" href='/css/main.css' media="screen" />
</head>

<body>
    <?php echo form_open('raiddump/addRaid'); ?>
    <label>Raid Date:</label><input type="text" name="RaidDate" id="RaidDate"/><br/>
    <label>Progression</label><input type="text" name="Progression" size="2"/>
    <table>
        <tr>
            <th>Name</th>
            <th>Class</th>
            <th>Role</th>
            <th>Loot</th>
        </tr>
     <?php
        foreach ($Characters as $Character){
            
         list($Name,$Class,$CharId) = $Character;
         
         echo "<tr>";   
         if ($CharId != NULL)
         echo "<input type=\"hidden\" name=\"CharId\" value=\"$CharId\"/>";
         echo "<td>$Name</td>";
         if ($Class > "")
         echo "<td>$Class</td>";
         else
         {
         echo "<td><select name=\"class_$CharId\">";
         echo "<option value=\"0\">&mdash;Select One&mdash;</option>";
         echo "<option value=\"1\">Warrior</option>";
         echo "<option value=\"2\">Mage</option>";
         echo "<option value=\"3\">Cleric</option>";
         echo "<option value=\"4\">Rogue</option>";
         echo "</select></td>";
         }
         echo "<td><select name=\"role_$CharId\">";
         echo "<option value=\"0\">&mdash;Select One&mdash;</option>";
         echo "<option value=\"1\">Tank</option>";
         echo "<option value=\"2\">DPS</option>";
         echo "<option value=\"3\">Support</option>";
         echo "<option value=\"4\">Healer</option>";
         echo "</select></td>";
         echo "<td><input type=\"checkbox\" name=\"loot_$CharId\"/></td>";         
         echo "</tr>";
         
          } ?>
    </table>
        <?php echo form_submit('addRaid','Add Raid');  ?>
        <?php echo form_close(); ?>
    </table>
    
</body>
</html>

