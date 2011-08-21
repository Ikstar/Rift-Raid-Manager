<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php $webtitle ?></title>
        <link rel="stylesheet" type="text/css" href='/css/main.css' media="screen" />
        <link rel="stylesheet" type="text/css" href="/css/humanity/jquery-ui-1.8.15.custom.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.8.15.custom.min.js"></script>
 <script type="text/javascript">
      function log( message ) {
			$( "<div/>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}
        $(document).ready(function(){
           
       		$( "#CharName" ).autocomplete({
			source: "/index.php/character/AutoComplete",
			minLength: 2,
			select: function( event, ui ) {
				log( ui.item ?
					"Selected: " + ui.item.value + " aka " + ui.item.id :
					"Nothing selected, input was " + this.value );
			}
		});
                $('input:submit').button();
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
                <div id="groups"> 
                    <div class="RowGroup RowHeader" style="font-weight:bold; border-bottom: 3px double #0E4E5A;">
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
                        <div>
                            <?php echo form_open('groups/editRoster', array('style' => "color:$Color", 'class' => "RowGroup"), array('CharId' => $Characters->idchars, 'idGroups' =>$idGroups, 'idRoster'=> $Characters->idRoster)); ?>
                            <div class="name"> <?php echo $Characters->name; ?> </div>
                            <div class="role">    
                                <?php
                                echo "<select name=\"role\">";
                                echo "<option value=\"0\" >&mdash;Select One&mdash;</option>";
                                $T = ($Characters->role == 1) ? "selected=\"selected\"" : "";
                                echo "<option value=\"1\" $T>Tank</option>";
                                $T = ($Characters->role == 2) ? "selected=\"selected\"" : "";
                                echo "<option value=\"2\" $T>DPS</option>";
                                $T = ($Characters->role == 3) ? "selected=\"selected\"" : "";
                                echo "<option value=\"3\" $T>Support</option>";
                                $T = ($Characters->role == 4) ? "selected=\"selected\"" : "";
                                echo "<option value=\"4\" $T>Healer</option>";
                                echo "</select>";
                                ?>
                            </div><div class="status">
                                <?php
                                echo "<select name=\"status\">";
                                $T = ($Characters->status == "1") ? "selected=\"selected\"" : "";
                                echo "<option value=\"1\" $T>Active</option>";
                                $T = ($Characters->status == "2") ? "selected=\"selected\"" : "";
                                echo "<option value=\"2\" $T>Waiting</option>";
                                $T = ($Characters->status == "3") ? "selected=\"selected\"" : "";
                                echo "<option value=\"3\" $T>Inactive</option>";
                                echo "</select>";
                                ?>
                            </div>
                            <div class="attendance"><?php echo $Characters->attendance; ?></div>
                            <div class="DKP"><?php echo $Characters->DKP; ?></div>


                            <div class="updated"><?php echo $Characters->updated; ?></div>
                            <div class="actions"><?php
                            echo form_submit('action', 'Save');
                            echo form_submit('action', 'Remove');
                           // echo form_submit('action', 'Edit');
                                ?>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br/>
                <div id="addNewToRoster">
                    <?php echo form_open('groups/editRoster','',array("idGroups"=>$idGroups)); ?>
                    <h2>Add New Character</h2>
                    <label>Name:</label>
                    <input name="CharName" id="CharName" type="text"/>
                    
                    <label>Role:</label>
                    <select name="role">
                        <option value="0" >&mdash;Select One&mdash;</option>
                        <option value="1">Tank   </option>        
                        <option value="2">DPS    </option>
                        <option value="3">Support</option>
                        <option value="4">Healer </option>
                    </select>
                    
                    <label>Status:</label>
                    <select name="status">
                        <option value="0">&mdash;Select One&mdash;</option>
                        <option value="1">Active</option>
                        <option value="2">Waiting</option>
                        <option value="3">Inactive</option>
                    </select>
                    <?php echo form_submit('action', 'Add'); ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
             <br/>
        </div>
        <div id="spacer"></div>
    <div id="footer">
        
        <p><br />Page rendered in {elapsed_time} seconds</p>
   
    <?php $this->load->view('footer'); ?>
    </div>
</body>
</html>
