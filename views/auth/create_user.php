<!DOCTYPE html>
<html lang="en">
    <html><head>
            <link rel="stylesheet" type="text/css" href="<?php echo "/css/main.css"; ?> ">
            <link rel="stylesheet" type="text/css" href="/css/humanity/jquery-ui-1.8.15.custom.css">
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
            <script type="text/javascript" src="/js/jquery-ui-1.8.15.custom.min.js"></script>
            <script type="text/javascript">
      
		
                $(document).ready(function(){
           
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
                    <div class='mainInfo'>

                        <h2>Create User</h2>
                        <p>Please enter the users information below.</p>

                        <div id="infoMessage"><?php echo $message; ?></div>

                        <?php echo form_open("auth/create_user"); ?>
                        <p>Username:<br />
                            <?php echo form_input($username); ?>
                        </p>
                        <p>Email:<br />
                            <?php echo form_input($email); ?>
                        </p>

                        <p>Password:<br />
                            <?php echo form_input($password); ?>
                        </p>

                        <p>Confirm Password:<br />
                            <?php echo form_input($password_confirm); ?>
                        </p>


                        <p><?php echo form_submit('submit', 'Create User'); ?></p>


                        <?php echo form_close(); ?>

                    </div>
                </div>
                <div id="spacer"></div>
                <div id="footer">
                    <p><br />Page rendered in {elapsed_time} seconds</p>
                    <?php $this->load->view('footer'); ?>
                </div>
        </body>
    </html>