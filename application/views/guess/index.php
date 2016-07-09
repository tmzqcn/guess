<style type="text/css">
    span
    {
        margin-left: 10px;
    }
    .progress
    {
        padding-left: 10px;
        padding-right: 10px;
    }

</style>

<?php
foreach($match as $m)
{

    if (isset($m->tm_match_id))
    {
        echo '<div class="panel panel-success">';
    }
    else
    {
        echo '<div class="panel panel-info">';
    }

    echo '<div class="panel-heading"><span>比赛时间:';


    if (date("i", $this->security->xss_clean($m->fixture)) == 59)
    {
        echo date("Y-m-d H:i", $this->security->xss_clean($m->fixture + 60)) . '</span>';
    }
    else
    {
        echo date("Y-m-d H:i", $this->security->xss_clean($m->fixture)) . '</span>';
    }

    if (isset($m->tm_match_id))
        echo '<span>TM比赛</span>';
    else
        echo '<span>其他比赛</span>';

    echo '</div>
    <div class="panel-body">';
    echo '<div class="col-sm-4 text-center">' . $this->security->xss_clean($m->home_name) . '</div>';
    echo '<div class="col-sm-1 text-center">VS</div>';
    echo '<div class="col-sm-4 text-center">' . $this->security->xss_clean($m->away_name) . '</div>';
    echo '<div class="col-sm-3 text-center">截止时间:' . date("m-d H:i", $this->security->xss_clean($m->deadline)) . '</div>';


    echo '
    </div>
    <div class="progress">
        <div class="progress-bar " style="width: 5%" style="min-width: 2em;">
            5% Complete (success)
        </div>
        <div class="progress-bar progress-bar-warning  " style="width: 80%" style="min-width: 2em;">
            80% Complete (warning)
        </div>
        <div class="progress-bar progress-bar-danger " style="width: 15%" style="min-width: 2em;">
            15% Complete (danger)
        </div>
    </div>';



    echo form_open(base_url('guess/bet'), 'class="form-horizontal" id="guess_bet"');
    echo'
    <div>
    <input type="radio" name="score" value="主队胜"/>主队胜
    <input type="radio" name="score" value="平局"/>平局
    <input type="radio" name="score" value="客队胜"/>客队胜
    </div>
    </form>
    ';
    echo'</div>';

}
echo $this->pagination->create_links();
?>
<script>
    $(document).ready(function()
    {

        $(".progress").hide();
        $("form").hide();
        $(".panel").mouseenter(function(){

            $(".progress", this).fadeIn("slow");
            $("form", this).fadeIn("slow");
        });
        $(".panel").mouseleave(function(){
            $(".progress", this).fadeOut("slow");
            $("form", this).fadeOut("slow");
        });
    })
</script>
