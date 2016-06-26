<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guess extends CI_Controller
{
    //
    public function index()
    {

        $this->load->view('inc/header');
        //var_dump($this->config->item('role_user'));
        //var_dump($this->session->roles);

        //var_dump($this->verify->authorize_by_role('role_xx_admin',$this->session->roles));

        $this->load->view('guess/index');
        $this->load->view('inc/footer');
    }

    private function get_match_info($match_id)
    {
        //id不是数字就返回false
        if(!is_numeric(intval($match_id)))
        {
            return FALSE;
        }

        $this->config->load('profile.php');
        //设置post的数据
        $post = array (
            'password' => $this->config->item('tm_password'),
            'remember' => 0,
            'user' => $this->config->item('tm_user')
        );
        //登录地址
        $url = "http://trophymanager.com/ajax/login.ajax.php";
        //设置cookie保存路径
        $cookie = dirname(__FILE__) . '/cookie.txt';
        //登录后要获取信息的地址
        $url2 = "http://trophymanager.com/ajax/match.ajax.php?id=".$match_id;

        //模拟登录
        $login = $this->login_post($url, $cookie, $post);
        //获取登录页的信息
        $content = $this->get_content($url2, $cookie);
        //删除cookie文件
        @unlink($cookie);
        $content = json_decode($content, true);
        return $content;
        //echo $content['club']['home']['club_name'];
    }

    private function login_post($url, $cookie, $post)
    {
        $curl = curl_init();//初始化curl模块
        curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
        curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//是否自动显示返回的信息
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中
        curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息
        curl_exec($curl);//执行cURL
        curl_close($curl);//关闭cURL资源，并且释放系统资源
    }
    //登录成功后获取数据
    private function get_content($url, $cookie) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER,false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        $rs = curl_exec($ch); //执行cURL抓取页面内容
        curl_close($ch);
        return $rs;
    }

    public function store()
    {
        if($this->verify->authorize_by_role('role_guess_admin',$this->session->roles))
        {
            //载入表单辅助函数
            $this->load->helper(array('form'));
            //载入模型
            $this->load->model('guess_model');
            //载入表单验证
            $this->load->library('form_validation');
            //表单验证规则
            $this->form_validation->set_rules('match_id','比赛ID','trim|required|is_natural|min_length[6]|max_length[30]');

            /*
            $this->form_validation->set_rules('deadline','截至时间',
                array(
                    'trim',
                    'required',
                    array(
                        'deadline_callable',
                        function($str)
                        {
                            // Check validity of $str and return TRUE or FALSE
                            if(strtotime($str)>strtotime($this->input->post('fixture')))
                            {
                                return FALSE;
                            }
                            else
                            {
                                return TRUE;
                            }
                        }
                    )
                ));

            */
            //自定义错误提示
            $this->form_validation->set_message('min_length', '{field}必须至少{param}位.');
            $this->form_validation->set_message('max_length', '{field}不得超过{param}位.');
            //$this->form_validation->set_message('deadline_callable', '截至时间必须早于比赛时间.');

            if ($this->form_validation->run() == FALSE)
            {

                $this->load->view('inc/header');
                $this->load->view('guess/store');
                $this->load->view('inc/footer');
            }
            else
            {
                //载入user模型
                $this->load->model('guess_model');
                if($this->guess_model->match_is_exist($this->input->post('match_id')))
                {
                    show_error('添加失败：已存在此比赛',500);
                }
                else
                {
                    $match_info = $this->get_match_info($this->input->post('match_id'));

                    if($match_info !== FALSE && isset($match_info['match_data']['live_min']))
                    {
                        //echo date('Y-m-d H:i',time()+abs($match_info['match_data']['live_min'])*60);

                        //获取比赛开始时间戳
                        $fixture = time()+abs($match_info['match_data']['live_min'])*60;
                        //截至时间提前2h
                        $deadline = $fixture-2*3600;
                        $home_name = $match_info['club']['home']['club_name'];
                        $home_id = $match_info['club']['home']['id'];
                        $away_name = $match_info['club']['away']['club_name'];
                        $away_id = $match_info['club']['away']['id'];


                        if($this->guess_model->store_match($this->input->post('match_id'),$home_id,$home_name,$away_id,$away_name,$fixture,$deadline))
                        {
                            $data['message'] = '添加比赛成功！';
                            $data['url'] = 'guess/index';
                            $this->load->view('inc/header');
                            $this->load->view('inc/success',$data);
                            $this->load->view('inc/footer');
                        }
                        else
                        {
                            show_error('添加失败：数据库添加失败',500);
                        }

                    }
                    else
                    {
                        show_error('比赛ID错误,添加比赛失败',500);
                    }
                }
            }
        }
        else
        {
            show_error('权限不足，无法访问此页',403);
        }
    }



}
