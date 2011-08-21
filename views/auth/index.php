<!DOCTYPE html>
<html lang="en">
<html><head>
<link rel="stylesheet" type="text/css" href="<?php echo "/css/main.css"; ?> ">
<link rel="stylesheet" type="text/css" href="/css/humanity/jquery-ui-1.8.15.custom.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.8.15.custom.min.js"></script>
 <script type="text/javascript">
      
        $(document).ready(function(){
           
       		$('a.linkbut').button();
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
<div class='mainInfo'>

	<h2>Users</h2>
	<p>Below is a list of the users.</p>
	
	<div id="infoMessage"><?php echo $message;?></div>
	
	<table cellpadding=0 cellspacing=10>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Group</th>
			<th>Status</th>
		</tr>
		<?php foreach ($users as $user):?>
			<tr>
				<td><?php echo $user['username']?></td>
				<td><?php echo $user['email'];?></td>
				<td><?php echo $user['group_description'];?></td>
				<td><?php echo ($user['active']) ? anchor("auth/deactivate/".$user['id'],'Deactivate',array('class'=>'linkbut') ) : anchor("auth/activate/". $user['id'], 'Activate',array('class'=>'linkbut'));?></td>
			</tr>
		<?php endforeach;?>
	</table>
	
	<p><a class="linkbut" href="<?php echo site_url('auth/create_user');?>">Create a new user</a></p>
	
	<p><a class="linkbut" href="<?php echo site_url('auth/logout'); ?>">Logout</a></p>
	
</div>
    </div>
    <div id="spacer"></div>
    <div id="footer">
    <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
    </div>
</body>
</html>