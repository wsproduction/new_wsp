Ini adalah view ya sodara-sorada!<br>
ini dari variable : <?php echo $test_variable; ?> <br>
ini dari variable array : <?php print_r($test_variable_array); ?> <br>
ini dari model : <br>
<?php
foreach ($test_model as $value) {
    echo $value->meeting_id . ' : ' . $value->name . '/' . $value->category_name . '<br>';
}
?> 
<br>
<?php
foreach ($test_model2 as $value) {
    echo $value['status_id'] . ' : ' . $value['desc'] . '<br>';
}
?> 
<br>
