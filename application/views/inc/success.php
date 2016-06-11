<?php
    if(isset($message))
    {
        echo'<h1>';
        echo $message;
        echo'</h1>';
    }
?>

<h3>
    页面将在<span id="second">10</span>秒后自动跳转，你也可以点击<a href="
    <?php
        if(isset($url))
            echo base_url($url);
        else
            echo base_url();
    ?>
    "> 这里 </a>立即跳转
</h3>

<script>
    $(document).ready(function(){
        time_count();
    });

     //倒数10秒自动跳转
    function time_count()
    {
        sec = $('#second').text()-1;
        if(sec == 0)
        {
            window.location ="<?php
                    if(isset($url))
                        echo base_url($url);
                    else
                        echo base_url();
                 ?>";
        }
        $('#second').text(sec);
        setTimeout("time_count()",1000);
    }
</script>