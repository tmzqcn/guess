<style type="text/css">
    span
    {
        margin-left: 10px;
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
    echo '<div class="col-sm-3 text-center h3">' . $this->security->xss_clean($m->home_name) . '</div>';
    echo '<div class="col-sm-1 text-center h3">VS</div>';
    echo '<div class="col-sm-3 text-center h3">' . $this->security->xss_clean($m->away_name) . '</div>';
    echo '<div class="col-sm-2 text-center h3"><small>截止时间:' . date("m-d H:i", $this->security->xss_clean($m->deadline)) . '</small></div>';
    echo form_open(base_url('guess/bet'), 'class="form-horizontal"');
    echo '<div class="col-sm-1 text-center h3"><a class="result" data-title="'.$m->id.'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></div>';
    echo '<input type="hidden" class="mid" value="'.$m->id.'">';
    echo '<div class="col-sm-1 text-center h3"><a class="delete"  href="'.base_url('guess/delete/'.$m->id).'"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a></div>';
    echo '</form>';
    echo'</div>';
    echo'</div>';

}
echo $this->pagination->create_links();
?>
<script>
    $(document).ready(function()
    {
        $('a.delete').confirm(
        {
            title: false,
            content: '是否删除此比赛？',
            confirmButton: '删除',
            cancelButton: '取消',
            backgroundDismiss: true,
        });
        $('a.result').confirm({
            title: function ()
            {

            },
            content: '<input type="text" placeholder="主队进球数" name="home_score" id="home_score" value="0"/>' +
            '：' +
            '<input type="text" placeholder="客队进球数" name="away_score" id="away_score" value="0"/>',
            confirmButton: '上报比分',
            cancelButton: '取消',
            backgroundDismiss: true,
            confirm: function()
            {
                var mid = this.title;
                $.ajax({
                    url: "<?php echo base_url('guess/submit') ?>",
                    method: "POST",
                    data:
                    {
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : $( "input[name$='<?php echo $this->security->get_csrf_token_name(); ?>']" ).val(),
                        'home_score':$('#home_score').val(),
                        'away_score':$('#away_score').val(),
                        'match_id':mid
                    },
                    dataType: "json",
                    /*
                    complete: function(msg)
                    {
                        //ajax结束后输入数值清空，按钮恢复
                        $(':text',money).val('');
                        $btn.button('reset');
                    },
                    */
                    success:function(data)
                    {
                         //更新csrf token
                         $( "input[name$='<?php echo $this->security->get_csrf_token_name(); ?>']" ).val(data.csrf_test_name);
                        if(data.state == 200)
                            ;
                        alert(data.msg);
                    }

                })
            },

        });
    })
</script>
