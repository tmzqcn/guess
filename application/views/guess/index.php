<style type="text/css">
    span
    {
        margin-left: 10px;
    }
    .progress
    {
        margin-left: 10px;
        margin-right: 10px;
    }
    form
    {

    }
    .radio-inline
    {

    }
</style>

<div class="form-group">
    <?php echo validation_errors(); ?>
</div>

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
    echo '<div class="col-sm-4 text-center h3">' . $this->security->xss_clean($m->home_name) . '</div>';
    echo '<div class="col-sm-1 text-center h3">VS</div>';
    echo '<div class="col-sm-4 text-center h3">' . $this->security->xss_clean($m->away_name) . '</div>';
    echo '<div class="col-sm-3 text-center h3"><small>截止时间:' . date("m-d H:i", $this->security->xss_clean($m->deadline)) . '</small></div>';

    echo form_open(base_url('guess/bet'), 'class="form-horizontal" id="guess_bet"');

    echo'
    <div class="col-sm-9 text-center">
        <label class="radio-inline">
          <input type="radio" name="radio_'.$m->id.'" id="win_'.$m->id.'" value="win"> 主胜
        </label>
        <label class="radio-inline">
          <input type="radio" name="radio_'.$m->id.'" id="draw_'.$m->id.'" value="draw"> 平局
        </label>
        <label class="radio-inline">
          <input type="radio" name="radio_'.$m->id.'" id="fail_'.$m->id.'" value="fail"> 客胜
        </label>
    </div>
    <div class="col-sm-2">
        <label class="sr-only" for="bet_input_'.$m->id.'">Amount (in dollars)</label>
        <div class="input-group">
          <div class="input-group-addon">$</div>
          <input type="text" class="form-control "name="bet_input_'.$m->id.'" id="bet_input_'.$m->id.'" placeholder="TM币">

        </div>

    </div>
    <div class="col-sm-1">
        <button id="bet_'.$m->id.'" class=" btn btn-primary">竞猜</button>
    </div>


    </form>';


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




    echo'</div>';

}
echo $this->pagination->create_links();
?>
<script>
    $(document).ready(function()
    {

        $(".progress").hide();
        $("form").hide();
        $(".panel").mouseenter(function()
        {
            $(".progress", this).fadeIn("slow");
            $("form", this).fadeIn("slow");
        });
        $(".panel").mouseleave(function()
        {
            $(".progress", this).fadeOut("slow");
            $("form", this).fadeOut("slow");
        });

        $('button').on('click', function (e)
        {
            var $btn = $(this).button('loading');
            $.ajax({
                url: "<?php echo base_url('guess/bet') ?>",
                method: "POST",
                data:{
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : $( "input[name$='<?php echo $this->security->get_csrf_token_name(); ?>']" ).val()
                },
                dataType: "json",
                complete: function(msg){

                    $btn.button('reset');
                },
                success:function(data)
                {
                    $( "input[name$='<?php echo $this->security->get_csrf_token_name(); ?>']" ).val(data.csrf_test_name);

                }
            })

            e.preventDefault();
        })

    })
</script>
