<?php

$data = [
    ['id' => 1, 'manager_id' => null, 'name' => 'CEO'],
    ['id' => 2, 'manager_id' => 1, 'name' => 'CTO'],
    ['id' => 3, 'manager_id' => 1, 'name' => 'CFO'],
    ['id' => 4, 'manager_id' => 2, 'name' => 'Lead Engineer'],
    ['id' => 5, 'manager_id' => 2, 'name' => 'UI/UX Designer'],
    ['id' => 6, 'manager_id' => 3, 'name' => 'Accountant']

];
?>

<ul>
    <?php if($data['manager_id' == null]) {?>
        <li><?php echo $data['name'] ?></li>
    <?php } if($data['manager_id' == 1]) {?>
        <li>
            <ul>
                <li>CTO</li>
            </ul>
        </li>
    <?php } if($data['manager_id' == 1]) ?> 
</ul>