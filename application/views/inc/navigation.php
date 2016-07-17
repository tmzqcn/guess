<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">竞猜</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="#">
                    <?php
                    //载入模型
                    $this->CI =& get_instance();
                    $this->CI->load->model('guess_model');
                    if(isset($this->session->user_id))
                    {
                        echo 'TM币：<span id="tm_point">'.$this->CI->guess_model->get_point($this->session->user_id)->point.'</span>';
                    }


                    ?>
                    </a></li>
                <li><a href="#">Link</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <?php
                    if($this->verify->authorize_by_role('role_guess_admin',$this->session->roles))
                    {

                ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">竞猜管理 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('guess/add_tm'); ?>">添加TM比赛</a></li>
                                <li><a href="<?php echo base_url('guess/add'); ?>">添加其他比赛</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                <?php
                    }
                ?>

                <?php
                    if(isset($this->session->name))
                        echo '<li><a href='.base_url('user/logout').'>注销</a></li>';
                    else
                        echo '<li><a href='.base_url('user/login').'>登录</a></li>';
                ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>