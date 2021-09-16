<?php 

 helper('form');
$validation =  \Config\Services::validation();
?>
<h1>Register</h1>
<p>Please fill out the form below to create an account</p>
<!--Display Errors-->


    <?php 
    if($_POST)
    {
      
    $errors = $validation->getErrors();

    foreach($errors as $error){ ?>
     <p class="alert alert-dismissable alert-danger"><?= esc($error); ?></p>   
    <?php } }?> 

 <?php echo form_open('users/register'); ?>
<!--Field: First Name-->
<p>
<?php echo form_label('First Name:'); ?>
<?php
$data = array(
              'name'        => 'first_name',
              'value'       => esc(set_value('first_name'))
            );
?>
<?php echo form_input($data); ?>
</p>
<!--Field: Last Name-->
<p>
<?php echo form_label('Last Name:'); ?>
<?php
$data = array(
              'name'        => 'last_name',
              'value'       => esc(set_value('last_name'))
            );
?>
<?php echo form_input($data); ?>
</p>

<!--Field: Email Address-->
<p>
<?php echo form_label('Email Address:'); ?>
<?php
$data = array(
              'name'        => 'email',
              'value'       => esc(set_value('email'))
            );
?>
<?php echo form_input($data); ?>
</p>

<!--Field: Username-->
<p>
<?php echo form_label('Username:'); ?>
<?php
$data = array(
              'name'        => 'username',
              'value'       => esc(set_value('username'))
            );
?>
<?php echo form_input($data); ?>
</p>

<!--Field: Password-->
<p>
<?php echo form_label('Password:'); ?>
<?php
$data = array(
              'name'        => 'password',
              'value'       => esc(set_value('password'))
            );
?>
<?php echo form_password($data); ?>
</p>

<!--Field: Password2-->
<p>
<?php echo form_label('Confirm Password:'); ?>
<?php
$data = array(
              'name'        => 'password2',
              'value'       => esc(set_value('password2'))
            );
?>
<?php echo form_password($data); ?>
</p>

<!--Submit Buttons-->
<?php $data = array("value" => "Register",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>