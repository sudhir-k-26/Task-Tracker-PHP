<h1>Edit List</h1>
<!--Display Errors-->
<?php 
helper('form');
$validation =  \Config\Services::validation();

if($_POST)
    {
      
    $errors = $validation->getErrors();

    foreach($errors as $error){ ?>
     <p class="alert alert-dismissable alert-danger"><?= esc($error); ?></p>   
    <?php } }?> 
 <?php echo form_open('lists/edit/'.$this_list['id'].''); ?>
<!--Field: First Name-->
<p>
<?php echo form_label('List Name:'); ?>
<?php
$data = array(
              'name'        => 'list_name',
              'value'       => $this_list['list_name']
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
              'value'       => $this_list['list_body']
            );
?>
<?php echo form_textarea($data); ?>
</p>

<!--Submit Buttons-->
<?php $data = array("value" => "Update List",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>