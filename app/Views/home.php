<!--Display Messages-->
<?php if(\Config\Services::session()->getFlashdata('msg')): ?>
<p class="alert alert-dismissable alert-success"> <?= \Config\Services::session()->getFlashdata('msg'); ?></p>
<?php endif; ?>
<?php if(\Config\Services::session()->getFlashdata('logged_out')) : ?>
<p class="alert alert-dismissable alert-successs"><?= \Config\Services::session()->getFlashdata('logged_out'); ?></p>
<?php endif; ?>
<?php if(\Config\Services::session()->getFlashdata('need_login')) : ?>
<p class="alert alert-dismissable alert-danger"><?= \Config\Services::session()->getFlashdata('need_login'); ?></p>
<?php endif; ?>
<h1>Welcome to Task Tracker</h1>
<p>Task Tracker is a simple and helpful application to help you manage your day to day tasks. You can add as many task lists as you want and as many tasks as you want. Task Tracker is absolutely free! Have fun.</p>
<br />
<h3>My Latest Lists</h3>
<table class="table table-striped" width="50%" cellspacing="5" cellpadding="5">
    <tr>
        <th>List Name</th>
        <th>Created On</th>
        <th>View</th>
    </tr>
    <?php if(isset($lists)) : ?>
    <?php foreach($lists as $list) : ?>
    <tr>
        <td><?php echo $list['list_name']; ?></td>
        <td><?php echo $list['create_date']; ?></td>
        <td><a href="<?php echo base_url(); ?>/lists/show/<?php echo $list['id']; ?>">View List</a></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>
<h3>Latest Tasks</h3>
<table class="table table-striped" width="50%" cellspacing="5" cellpadding="5">
    <tr>
        <th>Task Name</th>
        <th>List Name</th>
        <th>Created On</th>
        <th>View</th>
    </tr>
    <?php if(isset($tasks)) : ?>
<?php foreach($tasks as $task) : ?>
     <tr>
        <td> <?php echo $task['task_name']; ?></td>
         <td><?php echo $task['list_name']; ?></td>
        <td><?php echo $task['create_date']; ?></td>
        <td><a href="<?php echo base_url(); ?>/tasks/show/<?php echo $task['id']; ?>">View Task</a></td>

    </tr>
<?php endforeach; ?>
     <?php endif;?>
</table>
