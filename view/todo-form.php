<?php include('header.php'); ?>
<div class="row" style="float: right;">
    <a href="index.php?op=new" class="btn btn-warning"> Add New List </a>
    <a class="btn btn-info" href="index.php">Todo lists </a>
</div>
<fieldset>
    <div class="row">
        <br>
        <br>
        <h2>Add new todo</h2>
        <hr>

    </div>
    <div class="row">
        <?php
        if ($errors) {
            print '<ul class="errors">';
            foreach ($errors as $field => $error) {
                print '<li>' . htmlentities($error) . '</li>';
            }
            print '</ul>';
        }
        ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="title">Title:</label>
                <textarea id="title" name="title" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="start">Start time:</label>
                <div class='input-group date' id='startdate'>
                    <input type='text' class="form-control" name="start" required/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            <div class="form-group">
                <label for="end">End time:</label>
                <div class='input-group date' id='enddate'>
                    <input type='text' class="form-control" name="end" required/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            <div class="form-group">
                <label for="status">Select status:</label>
                <select class="form-control" name="status">
                    <option value="new">New</option>
                    <option value="doing">Doing</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <input type="hidden" name="form-submitted" value="1" />
            <input class="btn btn-success" type="submit" name="submit_val" value="Save">
        </form>
    </div>
</fieldset>
<?php include('footer.php'); ?>
