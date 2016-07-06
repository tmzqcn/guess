<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guess extends CI_Controller
{
    //
    public function index()
    {

        //获取所有用户
        $this->load->model('guess_model');

        //分页函数
        $this->load->library('pagination');

        //要使用分页的目标url
        $config['base_url'] = base_url('guess/index');

        $this->config->load('pagination.php');


        $data['match'] = $this->guess_model->get_match($this->uri->segment(3, 1),$this->config->item('per_page'));

        $match_num = 0;
        foreach ($data['match'] as $match)
        {
            $home_info = $this->guess_model->get_team_by_id($match->home_id);
            $away_info = $this->guess_model->get_team_by_id($match->away_id);
            //把球队名称插入结果集
            $data['match'][$match_num]->home_name = $home_info->team_name;
            $data['match'][$match_num]->away_name = $away_info->team_name;
            //把赔率插入结果集
            $odds_info = $this->guess_model->get_odds($match->id);
            foreach($odds_info as $odds)
            {
                $s = $odds->score;
                $data['match'][$match_num]->$s = $odds->odds;
            }


            $match_num++;
        }



        //数据总数
        $config['total_rows'] = $this->guess_model->get_match_num();

        $this->pagination->initialize($config);


        $this->load->view('inc/header');


        $this->load->view('guess/index',$data);
        $this->load->view('inc/footer');

    }

    //获取比赛信息
    private function get_match_info($match_id)
    {
        //id不是数字就返回false
        if(!is_numeric(intval($match_id)))
        {
            return FALSE;
        }

        $this->config->load('tm_account.php');
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

    //添加tm比赛
    public function add_tm()
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
            $this->form_validation->set_rules('match_id','比赛ID','trim|required|is_natural|min_length[6]|max_length[30]|callback_match_check');
            $this->form_validation->set_rules('home_odds','主队赢赔率','trim|required|numeric|max_length[8]|greater_than[1]');
            $this->form_validation->set_rules('away_odds','客队赢赔率','trim|required|numeric|max_length[8]|greater_than[1]');
            $this->form_validation->set_rules('draw_odds','平局赔率','trim|required|numeric|max_length[8]|greater_than[1]');
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
            $this->form_validation->set_message('greater_than', '{field}必须大于{param}.');
            //$this->form_validation->set_message('deadline_callable', '截至时间必须早于比赛时间.');

            if ($this->form_validation->run() == FALSE)
            {

                $this->load->view('inc/header');
                $this->load->view('guess/store_tm_match');
                $this->load->view('inc/footer');
            }
            else
            {
                $match_id = html_escape($this->input->post('match_id'));
                $home_odds = html_escape($this->input->post('home_odds'));
                $away_odds = html_escape($this->input->post('away_odds'));
                $draw_odds = html_escape($this->input->post('draw_odds'));
                $store = $this->store_by_matchid($match_id,$home_odds,$away_odds,$draw_odds);
                if($store === TRUE)
                {
                    $data['message'] = '添加比赛成功！';
                    $data['url'] = 'guess/index';
                    $this->load->view('inc/header');
                    $this->load->view('inc/success',$data);
                    $this->load->view('inc/footer');
                }
                else
                {
                    if($store === FALSE)
                        show_error('比赛ID错误，添加失败',500);
                    else
                        show_error($store,500);
                }
            }
        }
        else
        {
            show_error('权限不足，无法访问此页',403);
        }
    }


    //添加其他比赛
    public function add()
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
            $this->form_validation->set_rules('home_name','主队名','trim|required|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('away_name','客队名','trim|required|min_length[2]|max_length[30]');
            $this->form_validation->set_rules('fixture','比赛时间','trim|required');
            $this->form_validation->set_rules('home_odds','主队赢赔率','trim|required|numeric|max_length[8]|greater_than[1]');
            $this->form_validation->set_rules('away_odds','客队赢赔率','trim|required|numeric|max_length[8]|greater_than[1]');
            $this->form_validation->set_rules('draw_odds','平局赔率','trim|required|numeric|max_length[8]|greater_than[1]');

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


            //自定义错误提示
            $this->form_validation->set_message('min_length', '{field}必须至少{param}位.');
            $this->form_validation->set_message('max_length', '{field}不得超过{param}位.');
            $this->form_validation->set_message('greater_than', '{field}必须大于{param}.');
            $this->form_validation->set_message('deadline_callable', '截至时间必须早于比赛时间.');

            if ($this->form_validation->run() == FALSE)
            {

                $this->load->view('inc/header');
                $this->load->view('guess/store_match');
                $this->load->view('inc/footer');
            }
            else
            {
                $home_name = html_escape($this->input->post('home_name'));
                $away_name = html_escape($this->input->post('away_name'));
                $home_odds = html_escape($this->input->post('home_odds'));
                $away_odds = html_escape($this->input->post('away_odds'));
                $draw_odds = html_escape($this->input->post('draw_odds'));
                $deadline = strtotime(html_escape($this->input->post('deadline')));
                $fixture = strtotime(html_escape($this->input->post('fixture')));





                $store = $this->guess_model->store($home_name,$away_name,$fixture,$deadline,$home_odds,$away_odds,$draw_odds);
                if($store === TRUE)
                {
                    $data['message'] = '添加比赛成功！';
                    $data['url'] = 'guess/index';
                    $this->load->view('inc/header');
                    $this->load->view('inc/success',$data);
                    $this->load->view('inc/footer');
                }
                else
                {
                    if($store === FALSE)
                        show_error('比赛ID错误，添加失败',500);
                    else
                        show_error($store,500);
                }


            }
        }
        else
        {
            show_error('权限不足，无法访问此页',403);
        }
    }


    //删除比赛
    public function delete()
    {
        if($this->verify->authorize_by_role('role_guess_admin',$this->session->roles))
        {

        }
        else
        {
            show_error('权限不足，无法访问此页',403);
        }
    }

    /*
     * 添加tm竞猜记录
     */
    private function store_by_matchid($match_id,$home_odds,$away_odds,$draw_odds)
    {
        $match_info = $this->get_match_info($match_id);

        //$match_info['match_data']['live_min']存在表示比赛未开始，$match_info['club']['home']['club_name']存在表示比赛存在
        if($match_info !== FALSE && isset($match_info['match_data']['live_min']) && isset($match_info['club']['home']['club_name']))
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

            //载入模型
            $this->load->model('guess_model');
            if($this->guess_model->store_tm_match($match_id,$home_id,$home_name,$away_id,$away_name,$fixture,$deadline,$home_odds,$away_odds,$draw_odds))
            {
                return TRUE;
            }
            else
            {
                return 'SQL操作失败，请联系管理员';
            }
        }
        else
        {
            return FALSE;
        }
    }




    //回调验证match是否存在
    public function match_check($id)
    {
        if ($this->guess_model->match_is_exist($id))
        {
            $this->form_validation->set_message('match_check', '比赛：{field} 已存在');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}
