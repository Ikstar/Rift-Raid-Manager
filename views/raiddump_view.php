

<?php $this->load->helper(array('url', 'date')); ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo "/css/main.css"; ?> ">
        <link rel="stylesheet" type="text/css" href="/css/humanity/jquery-ui-1.8.15.custom.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui-menu.js"></script>
        <script type="text/javascript">
            function log( message ) {
                $( "<div/>" ).text( message ).prependTo( "#log" );
                $( "#log" ).scrollTop( 0 );
            }
            $(document).ready(function(){
                $('#action').button();
                $('#RaidDate').datepicker();
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
                <?php echo form_open('raiddump/addRaid', '', array('idGroups'=>$idGroups, 'AttendeeCount' => $AttendeeCount)); ?>
                <label>Raid Date:</label><input type="text" name="RaidDate" id="RaidDate"/><br/>
                <label>Progression</label><input type="text" name="Progression" size="2"/>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Role</th>
                        <th>Loot</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $CharIds = "";
                    foreach ($Characters as $Character) {

                        list($Name, $Class, $CharId, $Role, $Status) = $Character;
    switch($Status)
    {
        case 1:  $Status = "Active"; break;
        case 2:  $Status = "Waiting"; break;
        case 3:  $Status = "Inactive"; break;
        default :$Status = "Not in Group"; break;   
    }
                        switch ($Class) {
                            case 1: $Class = "Warrior";
                                $Color = "RED";
                                break;
                            case 2: $Class = "Mage";
                                $Color = "PURPLE";
                                break;
                            case 3: $Class = "Cleric";
                                $Color = "GREEN";
                                break;
                            case 4: $Class = "Rogue";
                                $Color = "YELLOW";
                                break;
                            default : $Class = "N/A";
                                $Color = "PINK";
                                break;
                        }
                        $CharIds .= "<input type=\"hidden\" name=\"CharIds[]\" value=$CharId>\n";
                        echo "<tr style=\"color:$Color;>";
                        if ($CharId != NULL)
                            echo "<input type=\"hidden\" name=\"CharId\" value=\"$CharId\"/>";
                        echo "<td>$Name</td>";
                        if ($Class > "")
                            echo "<td>$Class</td>";
                        else {
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
                        $Sel = ($Role == 1) ? "selected=\"selected\"" : "";
                        echo "<option value=\"1\" $Sel>Tank</option>";
                        $Sel = ($Role == 2) ? "selected=\"selected\"" : "";
                        echo "<option value=\"2\" $Sel>DPS</option>";
                        $Sel = ($Role == 3) ? "selected=\"selected\"" : "";
                        echo "<option value=\"3\" $Sel>Support</option>";
                        $Sel = ($Role == 4) ? "selected=\"selected\"" : "";
                        echo "<option value=\"4\" $Sel>Healer</option>";
                        echo "</select></td>";
                        echo "<td><input type=\"checkbox\" name=\"loot_$CharId\"/></td>";
                        echo "<td>$Status</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo $CharIds;

                    $options = array(
                        'value' => 'Add Raid',
                        'name' => 'addRaid',
                        'id' => 'action');
                    echo form_submit($options);
                    ?>
                    <?php echo form_close(); ?>

            </div>
            <div id="spacer"></div>
            <div id="footer">
                <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
            </div>   
    </body>
</html>

