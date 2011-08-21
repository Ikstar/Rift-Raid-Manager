
<?php
$this->load->helper('url');
$this->load->helper('date');
?>

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

                    <div id="ui-state-info"><?php echo $this->session->flashdata('item'); ?></div>

                    <h2>Current Raid Groups</h2>
                    <?php if (is_array($Groups)) : ?>
                        <table id="groups"> 
                            <tr>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Last Updated</th>
                                <th>Established On</th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php
                            $DateString = "%F %j%S %Y";

                            foreach ($Groups as $Group) {
                                echo "<tr><td>";
                                echo $Group->name;
                                echo "</td><td>";
                                echo $Group->size;
                                echo "</td><td>";
                                echo mdate($DateString, mysql_to_unix($Group->updated));
                                echo "</td><td>";
                                echo mdate($DateString, mysql_to_unix($Group->created));
                                echo "</td><td>";
                                $hidden = array('idGroups' => $Group->idgroups);
                                echo form_open('groups/viewGroup', '', $hidden);
                                echo form_submit('View', 'View');
                                echo form_close();
                                echo "</td></tr>";
                            }
                        endif;
                        ?>
                    </table>
                    <br/>
                    <?php if ($this->ion_auth->is_admin()) : ?>
                        <h2>Add New Group</h2>
                        <?php if ($error): ?>
                            <br/>
                            <div class="ui-state-error">
                                <?php echo $error ?>
                            </div>
                            <br/>
                        <?php endif; ?>
                        <?php echo form_open('groups/addGroup'); ?>
                        <label>Group Name:</label><?php echo form_input('name'); ?>
                        <label>Group Size:</label><?php echo form_input('size'); ?>
                        <?php echo form_submit('groupAdd', 'Add Group'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div id="spacer"></div>
            <div id="footer">
                <p><br />Page rendered in {elapsed_time} seconds</p>
                <?php $this->load->view('footer'); ?>
            </div>
        </body>
    </html>
