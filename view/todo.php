<?php include('header.php'); ?>
<div style="float:right">
    <a href="index.php?op=new" class="btn btn-warning"> Add New List </a>
    <a class="btn btn-info" href="index.php">Todo lists </a>
</div>

<fieldset>
    <br>
    <h2>My ToDo Lists </h2>
    <hr>
    <div id="cal_event">
    </div>
    <div id='calendar' class="fc fc-unthemed fc-ltr"></div>
</fieldset>
<script>
    var list_todo = <?php echo json_encode($listTodo); ?>;
</script>
<?php include('footer.php'); ?>
