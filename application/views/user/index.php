<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>邮箱地址</th>
        <th>昵称</th>
        <th>TM ID</th>
        <th>是否启用</th>
        <th>创建时间</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $n = count($user->result());
    foreach($user->result() as $u)
    {
        echo '<tr>';
        echo '<td>'.$n.'</td>';
        echo '<td>'.$u->email.'</td>';
        echo '<td>'.$u->name.'</td>';
        echo '<td>'.$u->tm_id.'</td>';
        if($u->enable == 1)
        {
            echo '<td>启用</td>';
        }
        else
        {
            echo '<td>停用</td>';
        }
        echo '<td>'.date("Y-m-d H:i:s",$u->create_at).'</td>';
        echo '</tr>';
        $n--;
    }
    ?>
    </tbody>
</table>
<?php



echo $this->pagination->create_links();
