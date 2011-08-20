
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
                    <th>Size</th>
                    <th>Last Updated</th>
                    <th>Established On</th>
                    <th>&nbsp;</th>
                </tr>
            <?php 
            foreach ($Groups as $Group)
            {
                echo "<tr><td>";
               
                echo $Group->name;
                
                echo "</td><td>";
                echo $Group->size;
                echo "</td><td>";
                echo $Group->updated;
                echo "</td><td>";
                echo $Group->created;
                echo "</td><td>";                
                 $hidden = array('idGroups' => $Group->idgroups);
                echo form_open('groups/viewGroup','',$hidden);
                echo form_submit('View','View');  
                echo form_close();
                echo "</td></tr>";
            }
            ?>
            </table>
        </div>
        
    </div>
    <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
</body>
</html>
