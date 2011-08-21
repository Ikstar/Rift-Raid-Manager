<?php $this->load->helper(array('url', 'date')); ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo "/css/main.css"; ?> ">
        <link rel="stylesheet" type="text/css" href="/css/humanity/jquery-ui-1.8.15.custom.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="/js/jquery-ui-menu.js"></script>
        <script type="text/javascript">         
            $(document).ready(function(){
                $('input').button();
            });
           </script>

    </head>
    <body>

        <?php $this->load->view('header'); ?>
        <div id ="container">
            <div id="left">
                <?php echo $menu ?>
            </div>
            <div id="right">
                <table id="CharInfoLayout">
                    <tr><td style="vertical-align: top;">
                            <div id="CharInfo" class=" ui-widget-content">
                                <!-- Character Info-->

                                <h2 style="margin-top:0;">Character Info</h2>
                                <?php $CharInfo = $info->row(); ?>  
                                <?php
                                switch ($CharInfo->class) {
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
                                ?>
                                <label>Character Name:</label>
                                <?php echo $CharInfo->name; ?>
                                </br>
                                <label>Class:</label>
                                <?php echo $Class; ?>
                                </br>
                                <label>Current DKP:</label>
                                <?php echo $CharInfo->dkp; ?>
                                </br>
                                <label>Total Attendance Points:</label>
                                <?php echo $totalAttendance; ?>
                            </div>

                        </td>
                        <td>
                            <div id="GroupInfo" class="ui-widget-content">
                                <h2 style="margin-top:0;">Character's Groups</h2>
                                <table style="width:100%;"> 
                                    <tr>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Last Updated</th>
                                        <th>Character's Status</th>
                                        <th>Character's Role</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    <?php
                                    $DateString = "%F %j%S %Y";
                                    foreach ($groups->result() as $Group) {
                                        switch ($Group->status) {
                                            case 1: $Status = "Active";
                                                break;
                                            case 2: $Status = "Waiting";
                                                break;
                                            case 3: $Status = "Inactive";
                                                break;
                                            default :$Status = "N/A";
                                                break;
                                        }
                                        switch ($Group->role) {
                                            case 1: $Role = "Tank";
                                                break;
                                            case 2: $Role = "DPS";
                                                break;
                                            case 3: $Role = "Support";
                                                break;
                                            case 4: $Role = "Healer";
                                                break;
                                            default: $Role = "N/A";
                                                break;
                                        }
                                        echo "<tr><td>";

                                        echo $Group->name;

                                        echo "</td><td>";
                                        echo $Group->size;
                                        echo "</td><td>";
                                        echo mdate($DateString, mysql_to_unix($Group->updated));
                                        echo "</td><td>";
                                        echo $Status;
                                        echo "</td><td>";
                                        echo $Role;
                                        echo "</td><td>";
                                        $hidden = array('idGroups' => $Group->idgroups);
                                        echo form_open('groups/viewGroup', '', $hidden);
                                        echo form_submit('View', 'View');
                                        echo form_close();
                                        echo "</td></tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </td></tr><tr><td colspan="2">
                            <div class="ui-widget">
                                <h2>Recent Raids</h2>
                                <table>
                                    <tr>
                                        <th>Raid Group</th>
                                        <th>Raid Date</th>
                                        <th>Loot</th>
                                    </tr>
                                    <?php
                                    if ($raids) {
                                        foreach ($raids->result() as $raid) {
                                            echo "<tr><td>";
                                            echo $raid->name;
                                            echo "</td><td>";
                                            echo mdate($DateString, mysql_to_unix($raid->raiddate));
                                            echo "</td><td>";
                                            if ($raid->loot)
                                                echo "<span class=\"ui-icon ui-icon-circle-check\">&nbsp;</span>";
                                            echo "</td></tr>";
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </td>
                </table>
            </div>
            <div id="spacer"></div>
            <div id="footer">
                <?php $this->load->view('footer'); ?>
            </div>

    </body>
</html>
