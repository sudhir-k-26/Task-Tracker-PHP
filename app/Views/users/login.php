<?php 
helper('form'); 

if(\Config\Services::session()->get('is_login')) : ?>
    <p>You are logged in as <?php echo \Config\Services::session()->get('username'); ?></p>
    <!--Start Form-->
    <?php $attributes = array('id' => 'logout_form',
                          'class' => 'form-horizontal'); ?>
    <?php echo form_open('users/logout',$attributes); ?>
         <!--Submit Buttons-->
    <?php $data = array("value" => "Logout",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
    <?php echo form_submit($data); ?>
    <?php echo form_close(); ?>
<?php else :?>
<h3>Login Form</h3>
<?php 
if(\Config\Services::session()->getFlashdata('login_failed')){ ?>
    <p class="alert alert-dismissable alert-danger"> <?= \Config\Services::session()->getFlashdata('login_failed'); ?></p>
        <?php } 

$attributes=array('id'=>'login_form','class'=>'form-horizontal'); 
echo form_open('users/login',$attributes);
?>
<p>
    <?php
      echo form_label('Username:');
      $data = array(
          'name'=>'username',
          'placeholder'=>'Enter Username',
          'style'=>'width:90%',
          'value'=>set_value('username')
    );
    echo form_input($data);
    ?>
</p>
<p>
    <?php
      echo form_label('Password:');
      $data = array(
          'name'=>'password',
          'placeholder'=>'Enter Password',
          'style'=>'width:90%',
          'value'=>set_value('password')
    );
    echo form_password($data);
    ?>
</p>
<p>
    <?php
     
      $data = array(
          'name'=>'submit',
          'class'=>'btn btn-primary',
          'value'=>'login'
    );
    echo form_submit($data);
    ?>
</p>
<?php echo form_close(); ?>
<?php endif ;?>