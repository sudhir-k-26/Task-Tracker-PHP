<h1>Edit Task</h1>
<p>List:<strong> <?php echo $list_name[0]['list_name']; ?></strong></p>

<!--Display Errors-->
<?php 
$validation =  \Config\Services::validation();
$uri = current_url(true);
helper('form');
if($_POST)
{
    $errors = $validation->getErrors();

    foreach($errors as $error){ ?>
     <p class="alert alert-dismissable alert-danger"><?= esc($error); ?></p>   
    <?php }
}

?>

<?php echo form_open('tasks/edit/'.$uri->getSegment(4)); ?>

<!--Field: Task Name-->
<p>
<?php echo form_label('Task Name:'); ?>
<?php
$data = array(
              'name'        => 'task_name',
              'value'       => esc($this_task['task_name'])
            );
?>
<?php echo form_input($data); ?>
</p>

<!--Field: Task Body-->
<p>
<?php echo form_label('Task Body:'); ?>
<?php
$data = array(
              'name'        => 'task_body',
              'value'       => esc($this_task['task_body'])
            );
?>
<?php echo form_textarea($data); ?>
</p>

<!--Field: Date-->
<p>
<?php echo form_label('Date:'); ?>
<input type="date" name="due_date" value="<?php echo $this_task['due_date']; ?>"/>
</p>

<!--Submit Buttons-->
<?php $data = array("value" => "Update Task",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>