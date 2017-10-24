<?php include ('header.php'); ?> 
        <h1><?php print $todo->name; ?></h1>
        <div>
            <span class="label">Phone:</span>
            <?php print $todo->phone; ?>
        </div>
        <div>
            <span class="label">Email:</span>
            <?php print $todo->email; ?>
        </div>
        <div>
            <span class="label">Address:</span>
            <?php print $todo->address; ?>
        </div>
<?php include ('footer.php'); ?> 
