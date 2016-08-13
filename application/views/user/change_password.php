<link rel="stylesheet" href="<?php echo base_url('asset/css/validationEngine.jquery.css'); ?>" >
<style type="text/css">


</style>


<?php
echo form_open(base_url('user/change_password'), 'class="form-horizontal" id="change_password_form"');
?>
<div class="form-group">
    <label for="oldpassword" class="col-sm-2 control-label">旧密码</label>
    <div class="col-sm-10">
        <input type="password" class="form-control validate[required,minSize[4],maxSize[30]]" id="oldpassword" name="oldpassword" placeholder="旧密码">
    </div>
</div>

<div class="form-group">
    <label for="password" class="col-sm-2 control-label">新密码</label>
    <div class="col-sm-10">
        <input type="password" class="form-control validate[required,minSize[4],maxSize[30]]" id="password" name="password" placeholder="新密码" >
    </div>
</div>
<div class="form-group">
    <label for="password2" class="col-sm-2 control-label">确认新密码</label>
    <div class="col-sm-10">
        <input type="password" class="form-control validate[required,minSize[4],maxSize[30],equals[password]] " id="password2" name="password2" placeholder="确认新密码" >
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">修改密码</button>
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
        $("#change_password_form").validationEngine();
    });
</script>

