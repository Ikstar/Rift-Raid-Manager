
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
                    <h2>Recent Raids</h2>
                    <table>
                        <tr>
                            <th>Group</th>
                            <th>Raid Date</th>
                            <th>&nbsp;</th>
                        </tr>
                     
                    <?php 
                    $DateString = "%F %j%S %Y";
                    foreach($raids->result() as $raid):        ?>
                        <tr>
                            <td><?php echo $raid->name; ?></td>
                            <td><?php echo mdate($DateString,mysql_to_unix($raid->raiddate)); ?></td>
                            <td>
                            <?php echo form_open('raid/raidDetails','', array('RaidId' => $raid->raidid)); 
                                $options = array(
    'value'=>'View Raid Details',
    'name'=> 'action',
    'id'=>'action');
echo form_submit($options); 
?>
                                </form></td>
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

