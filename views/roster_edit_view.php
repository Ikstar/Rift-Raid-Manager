
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
                <div id="groups"> 
                    <div class="RowGroup">
                        <div class="name">Name</div>
                        <div class="role">Role</div>
                        <div class="status">Status</div>
                        <div class="attendance">Attendance</div>
                        <div class="DKP">DKP</div>
                        <div class="updated">Updated</div>
                        <div class="actions">Actions</div>
                    </div>
                    <?php
                    foreach ($Roster as $Characters) :
                        switch ($Characters->class) {
                            case 0: $Class = "Warrior";
                                $Color = "RED";
                                break;
                            case 1: $Class = "Mage";
                                $Color = "PURPLE";
                                break;
                            case 2: $Class = "Cleric";
                                $Color = "GREEN";
                                break;
                            case 3: $Class = "Rogue";
                                $Color = "YELLOW";
                                break;
                            default : $Class = "N/A";
                                $Color = "PINK";
                                break;
                        }
                        ?>
                    <div>
                        <?php echo form_open('groups/editRoster', array('style'=> "color:$Color", 'class'=>"RowGroup"), array('CharId' => $Characters->idchars));?>
                    <div class="name"> <?php echo $Characters->name;?> </div>
                            <div class="role">    
                        <?php echo "<select name=\"role\">";
                        echo "<option value=\"0\" >&mdash;Select One&mdash;</option>";
                        $T = ($Characters->role == "Tank") ? "selected=\"selected\"" : "";
                        echo "<option value=\"1\" $T>Tank</option>";
                        $T = ($Characters->role == "DPS") ? "selected=\"selected\"" : "";
                        echo "<option value=\"2\" $T>DPS</option>";
                        $T = ($Characters->role == "Support") ? "selected=\"selected\"" : "";
                        echo "<option value=\"3\" $T>Support</option>";
                        $T = ($Characters->role == "Healer") ? "selected=\"selected\"" : "";
                        echo "<option value=\"4\" $T>Healer</option>";
                        echo "</select>";
                        ?>
                            </div><div class="status">
                                <?php
                        echo "<select name=\"status\">";
                        $T = ($Characters->status == "1") ? "selected=\"selected\"" : "";                       
                        echo "<option value=\"1\" $T>Active</option>";
                        $T = ($Characters->status == "1") ? "selected=\"selected\"" : "";                       
                        echo "<option value=\"2\" $T>Waiting</option>";
                        $T = ($Characters->status == "1") ? "selected=\"selected\"" : "";                       
                        echo "<option value=\"3\" $T>Inactive</option>";
                        echo "</select>";
                        ?>
                            </div>
                            <div class="attendance"><?php echo $Characters->attendance; ?></div>
                            <div class="DKP"><?php echo $Characters->DKP;?></div>
                        
                        
                        <div class="updated"><?php echo $Characters->updated;?></div>
                        <div class="actions"><?php 
                        
                        echo form_submit('action', 'Remove');
                        echo form_submit('action', 'Save');
                        echo form_submit('action', 'Edit');
                        ?>
                        </div>
                        <?php echo form_close(); ?>
                        </div>
                        <?php endforeach; ?>
                </div>
                <?php echo form_open('groups/editRoster'); ?>
                <h2>Add New Character</h2>
                <label>Name:</label>
                <input name="CharName" type="text"/>
                <br/>
                <label>Role:</label>
                <select name="role">
                    <option value="0" >&mdash;Select One&mdash;</option>
                    <option value="1">Tank   </option>        
                    <option value="2">DPS    </option>
                    <option value="3">Support</option>
                    <option value="4">Healer </option>
                </select>
                <br/>
                <label>Status:</label>
                <select name="status">
                    <option value="0">&mdash;Select One&mdash;</option>
                    <option value="1">Active</option>
                    <option value="2">Waiting</option>
                    <option value="3">Inactive</option>
                </select>
                   <?php echo form_submit('add', 'add');?>
<?php echo form_close(); ?>
            </div>


        </div>
        </div>
        <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
    </body>
</html>
