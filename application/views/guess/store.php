<link rel="stylesheet" href="<?php echo base_url('asset/css/validationEngine.jquery.css'); ?>" >

<style type="text/css">


</style>


<?php

    echo form_open(base_url('guess/add'), 'class="form-horizontal" id="guess_add_form"');
?>

<div class="form-group">
    <label for="match_id" class="col-sm-2 control-label">比赛ID</label>
    <div class="col-sm-10">
        <input type="text" class="form-control validate[required,minSize[2],maxSize[30]]" id="match_id" name="match_id" placeholder="比赛ID" value="<?php echo html_escape(set_value('match_id')); ?>" >
    </div>
</div>

<div class="form-group">
    <label for="home_odds" class="col-sm-2 control-label">主队赢赔率</label>
    <div class="col-sm-10">
        <input type="text" class="form-control validate[required,maxSize[10]]" id="home_odds" name="home_odds" placeholder="主队赔率" value="<?php echo html_escape(set_value('home_odds')); ?>" >
    </div>
</div>

<div class="form-group">
    <label for="draw_odds" class="col-sm-2 control-label">平局赔率</label>
    <div class="col-sm-10">
        <input type="text" class="form-control validate[required,maxSize[10]]" id="draw_odds" name="draw_odds" placeholder="平局赔率" value="<?php echo html_escape(set_value('draw_odds')); ?>" >
    </div>
</div>

<div class="form-group">
    <label for="away_odds" class="col-sm-2 control-label">客队赢赔率</label>
    <div class="col-sm-10">
        <input type="text" class="form-control validate[required,maxSize[10]]" id="away_odds" name="away_odds" placeholder="客队赔率" value="<?php echo html_escape(set_value('away_odds')); ?>" >
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">添加比赛</button>
    </div>
</div>
<div class="form-group">
    <?php echo validation_errors(); ?>
</div>
</form>

</div>


<script src="<?php echo base_url('asset/js/jquery.validationEngine.js'); ?>"></script>
<script src="<?php echo base_url('asset/js/jquery.validationEngine-zh_CN.js'); ?>"></script>
<script>
    $(document).ready(function(){
        $("#guess_add_form").validationEngine();
        /*
        $('#fixture').datetimepicker({
            locale: 'zh-cn',
            format: "YYYY-MM-DD HH:mm"
        });
        $('#deadline').datetimepicker({
            locale: 'zh-cn',
            format: "YYYY-MM-DD HH:mm"
        });
        $("#deadline").on("dp.change",function (e) {
            $('#fixture').data("DateTimePicker").minDate(e.date);
        });
        $("#fixture").on("dp.change",function (e) {
            $('#deadline').data("DateTimePicker").maxDate(e.date);
        });
        */
    });
</script>

