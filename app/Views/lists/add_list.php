<?php 

 helper('form');
$validation =  \Config\Services::validation();
?>
<h1>Add a List</h1>
<p>Please fill out the form below to create a new task list</p>
<!--Display Errors-->
<?php 
    if($_POST)
    {
      
    $errors = $validation->getErrors();

    foreach($errors as $error){ ?>
     <p class="alert alert-dismissable alert-danger"><?= esc($error); ?></p>   
    <?php } }?> 
 
 <?php echo form_open('lists/add'); ?>
<!--Field: First Name-->
<p>
<?php echo form_label('List Name:'); ?>
<?php
$data = array(
              'name'        => 'list_name',
              'value'       => esc(set_value('list_name'))
            );
?>
<?php echo form_input($data); ?>
</p>
<!--Field: Last Name-->
<p>
<?php echo form_label('List Body:'); ?>
<?php
$data = array(
              'name'        => 'list_body',
              'value'       => esc(set_value('list_body'))
            );
?>
<?php echo form_textarea($data); ?>
</p>

<!--Submit Buttons-->
<?php $data = array("value" => "Add List",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>