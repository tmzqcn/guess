<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>比赛时间</th>
        <th>主队</th>

        <th>客队</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $n = count($match);
    foreach($match as $m)
    {
        echo '<tr>';
        echo '<td>'.$n.'</td>';
        if(date("i",$this->security->xss_clean($m->fixture)) == 59)
        {
            echo '<td>'.date("Y-m-d H:i",$this->security->xss_clean($m->fixture+60)).'</td>';
        }
        else
        {
            echo '<td>'.date("Y-m-d H:i",$this->security->xss_clean($m->fixture)).'</td>';
        }

        echo '<td>'.$this->security->xss_clean($m->home_name).'</td>';

        echo '<td>'.$this->security->xss_clean($m->away_name).'</td>';

        echo '</tr>';
        $n--;
    }
    ?>
    </tbody>
</table>
<?php



echo $this->pagination->create_links();
