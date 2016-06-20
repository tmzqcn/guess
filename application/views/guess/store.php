<link rel="stylesheet" href="<?php echo base_url('asset/css/validationEngine.jquery.css'); ?>" >
<style type="text/css">


</style>


<?php
    echo form_open(base_url('guess/store'), 'class="form-horizontal" id="guess_add_form"');
?>
<div class="form-group">
    <label for="home" class="col-sm-2 control-label">主队</label>
    <div class="col-sm-10">
        <input type="text" class="form-control validate[required,minSize[2],maxSize[50]]" id="home" name="home" placeholder="主队" value="<?php echo html_escape(set_value('home')); ?>">
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label">昵称</label>
    <div class="col-sm-10">
        <input type="text" class="form-control validate[required,minSize[2],maxSize[20]]" id="name" name="name" placeholder="昵称" value="<?php echo html_escape(set_value('name')); ?>">
    </div>
</div>
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
        <input type="password" class="form-control validate[required,minSize[4],maxSize[30]]" id="password" name="password" placeholder="密码" >
    </div>
</div>
<div class="form-group">
    <label for="password2" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-10">
        <input type="password" class="form-control validate[required,minSize[4],maxSize[30],equals[password]] " id="password2" name="password2" placeholder="确认密码" >
    </div>
</div>
<div class="form-group">
    <label for="tm_id" class="col-sm-2 control-label">TM俱乐部 ID</label>
    <div class="col-sm-10">
        <input type="text" class="form-control validate[required,minSize[4],maxSize[20],custom[integer]] " id="tm_id" name="tm_id" placeholder="TM Club ID" >
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">注册</button>
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
    });
</script>

