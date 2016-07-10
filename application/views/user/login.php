<link rel="stylesheet" href="<?php echo base_url('asset/css/validationEngine.jquery.css'); ?>" >
<style type="text/css">

    form
    {
    }
</style>


<?php
echo form_open(base_url('user/login'), 'class="form-horizontal" id="user_login_form"');
?>
<div class="form-group">
    <label for="email" class="col-sm-2 control-label">邮箱</label>
    <div class="col-sm-10">
        <input type="text" class="form-control validate[required,minSize[4],maxSize[20],custom[email]]" id="email" name="email" placeholder="邮箱" value="<?php echo html_escape(set_value('email')); ?>">
    </div>
</div>
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
        <input type="password" class="form-control validate[required,minSize[4],maxSize[30]]" id="password" name="password" placeholder="密码" >
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">登录</button>
        <button id="register" class="btn btn-default">注册</button>
    </div>
</div>
<div class="form-group">
    <?php
        echo validation_errors();
        if(isset($error_message))
            echo $error_message;
    ?>
</div>
</form>

</div>



<script src="<?php echo base_url('asset/js/jquery.validationEngine.js'); ?>"></script>
<script src="<?php echo base_url('asset/js/jquery.validationEngine-zh_CN.js'); ?>"></script>
<script>
    $(document).ready(function(){
        $("#user_login_form").validationEngine();
        $('#register').click(function(){

            window.location.assign('http://'+location.hostname+'/guess/user/register');
        })
    });
</script>

