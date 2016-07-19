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
        echo date("Y-m-d H:i", $this->security->xss_clean($m->fixture + 59)) . '</span>';
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

    echo form_open(base_url('guess/bet'), 'class="form-horizontal"');



    echo'
    <div class="col-sm-9 text-center">
        <label class="radio-inline">
          <input type="radio" name="radio_'.$m->id.'" id="win_'.$m->id.'" value="win"> 主胜（赔率1：'.round($m->win_odds ,2).'）
        </label>
        <label class="radio-inline">
          <input type="radio" name="radio_'.$m->id.'" id="draw_'.$m->id.'" value="draw"> 平局（赔率1：'.round($m->draw_odds ,2).'）
        </label>
        <label class="radio-inline">
          <input type="radio" name="radio_'.$m->id.'" id="fail_'.$m->id.'" value="fail"> 客胜（赔率1：'.round($m->fail_odds ,2).'）
        </label>
    </div>
    <div class="col-sm-2">
        <label class="sr-only" for="bet_input_'.$m->id.'">Amount (in dollars)</label>
        <div class="input-group">
          <div class="input-group-addon">$</div>
          <input type="text" class="form-control " name="bet_input_'.$m->id.'" id="bet_input_'.$m->id.'" placeholder="TM币">
          <input type="hidden" value="'.$m->id.'">

        </div>

    </div>
    <div class="col-sm-1">
        <button id="bet_'.$m->id.'" class=" btn btn-primary">竞猜</button>
    </div>


    </form>';

    //3部分宽度
    $win_width = $m->win;
    $draw_width = $m->draw;
    $fail_width = $m->fail;

    //如果都为0则平均分
    if($m->win==0&&$m->draw==0&&$m->fail==0)
    {
        $win_width=33.3;
        $draw_width=33.3;
        $fail_width=33.3;
    }


    //不足5，按5的宽度计算
    if($win_width<5)
        $win_width = 5;
    if($draw_width<5)
        $draw_width = 5;
    if($fail_width<5)
        $fail_width = 5;


    //所有部分平均计算宽度
    $sum = $win_width+$draw_width+$fail_width;

    $win_width = round(100*$win_width/$sum ,4);
    $draw_width = round(100*$draw_width/$sum ,4);
    $fail_width = round(100*$fail_width/$sum ,4);



    echo '
    </div>
    <div class="progress">
        <div class="progress-bar " style="width: '.$win_width.'%" >
             '.$m->win.'% 赢
        </div>
        <div class="progress-bar progress-bar-warning  " style="width: '.$draw_width.'%" >
             '.$m->draw.'% 平
        </div>
        <div class="progress-bar progress-bar-danger " style="width:  '.$fail_width.'%" >
             '.$m->fail.'% 负
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

        //鼠标进入panel展开，鼠标离开隐藏
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
            //错误信息初始化
            var err = '';
            var money = $(this).parent().prev();
            var radio = money.prev();
            var uid = $(':hidden',money).val();
            var n = parseInt($(':text',money).val());

            //判断是否选择结构
            if(!$(':checked',radio).val())
            {
                err += '请选择竞猜胜负结果.';
            }

            //判断是否输入数值
            if(!n)
            {
                err += '请输入竞猜积分数(正整数).';
            }

            //判断输入数值是否大于总数
            if(n>$('#tm_point').html())
            {
                err += 'TM币不足.'
            }

            if(err == '')
            {
                //按钮变为loading，不可点击
                var $btn = $(this).button('loading');
                $.ajax({
                    url: "<?php echo base_url('guess/bet') ?>",
                    method: "POST",
                    data:{
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : $( "input[name$='<?php echo $this->security->get_csrf_token_name(); ?>']" ).val(),
                        'score':$(':checked',radio).val(),
                        'point':n,
                        'match_id':uid

                    },
                    dataType: "json",
                    complete: function(msg){
                        //ajax结束后输入数值清空，按钮恢复
                        $(':text',money).val('');
                        $btn.button('reset');
                    },
                    success:function(data)
                    {
                        //更新csrf token
                        $( "input[name$='<?php echo $this->security->get_csrf_token_name(); ?>']" ).val(data.csrf_test_name);
                        if(data.state == 200)
                            $('#tm_point').html($('#tm_point').html()-n);
                        alert(data.msg);
                    }
                })
            }
            else
            {
                alert(err);
            }

            //点击按钮不跳转
            e.preventDefault();
        })

    })
</script>
