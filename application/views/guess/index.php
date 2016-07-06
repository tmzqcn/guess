<style type="text/css">
    span{
        margin-left: 10px;
    }

</style>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th class="col-sm-1 text-center">#</th>
        <th class="col-sm-2 text-center">比赛时间</th>
        <th class="col-sm-4 text-center">主队</th>
        <th class="col-sm-1 text-center"></th>
        <th class="col-sm-4 text-center">客队</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $n = count($match);
    foreach($match as $m)
    {
        echo '<tr>';
        if(isset($m->tm_match_id))
            echo '<td class="col-sm-1 text-center">TM比赛</td>';
        else
            echo'<td class="col-sm-1 text-center">其他比赛</td>';
        if(date("i",$this->security->xss_clean($m->fixture)) == 59)
        {
            echo '<td class="col-sm-2 text-center">'.date("Y-m-d H:i",$this->security->xss_clean($m->fixture+60)).'</td>';
        }
        else
        {
            echo '<td class="col-sm-2 text-center">'.date("Y-m-d H:i",$this->security->xss_clean($m->fixture)).'</td>';
        }

        echo '<td class="col-sm-4 text-center">'.$this->security->xss_clean($m->home_name).'</td>';
        echo '<td class="col-sm-1 text-center">VS</td>';
        echo '<td class="col-sm-4 text-center">'.$this->security->xss_clean($m->away_name).'</td>';

        echo '</tr>';


        $n--;
    }
    ?>
    </tbody>
</table>

<?php
foreach($match as $m)
{

    if(isset($m->tm_match_id))
    {
        echo '<div class="panel panel-success">';
    }
    else
    {
        echo '<div class="panel panel-primary">';
    }

    echo '<div class="panel-heading"><span>比赛时间:';


    if(date("i",$this->security->xss_clean($m->fixture)) == 59)
    {
        echo date("Y-m-d H:i",$this->security->xss_clean($m->fixture+60)).'</span>';
    }
    else
    {
        echo date("Y-m-d H:i",$this->security->xss_clean($m->fixture)).'</span>';
    }

    if(isset($m->tm_match_id))
        echo '<span>TM比赛</span>';
    else
        echo '<span>其他比赛</span>';

    echo'</div>
    <div class="panel-body">
        Panel content
    </div>
</div>';

}







?>
<?php



echo $this->pagination->create_links();
