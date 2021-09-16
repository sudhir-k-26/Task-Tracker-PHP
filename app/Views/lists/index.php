<?php if(\Config\Services::session()->getFlashdata('list_created')) : ?>
    <?php echo '<p class="text-success">' .\Config\Services::session()->getFlashdata('list_created') . '</p>'; ?>
<?php endif; ?>
<?php if(\Config\Services::session()->getFlashdata('list_updated')) : ?>
    <?php echo '<p class="text-success">' .\Config\Services::session()->getFlashdata('list_updated') . '</p>'; ?>
<?php endif; ?>
<?php if(\Config\Services::session()->getFlashdata('list_deleted')) : ?>
    <?php echo '<p class="text-success">' .\Config\Services::session()->getFlashdata('list_deleted') . '</p>'; ?>
<?php endif; ?>
<p>These are your current task lists</p>
<ul class="list_items">
<?php foreach ($lists as $list) : ?>
    <li>
        <div class="list_name"><a href="<?php echo base_url(); ?>/lists/show/<?php echo $list['id']; ?>"><?php echo $list['list_name']; ?></a></div>
        <div class="list_body"><?php echo $list['list_body']; ?></div>
    </li>
<?php endforeach; ?>
</ul>
<br />
<p>To create a new list - <a href="<?php echo base_url(); ?>/lists/add">Click here</a>