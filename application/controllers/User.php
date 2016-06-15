<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    //
    public function index()
    {
        $this->load->view('inc/header');
        $this->load->view('user/index');
        $this->load->view('inc/footer');
    }
    
    //注册
    public function register()
    {
        //载入表单辅助函数
        $this->load->helper(array('form'));
        //载入user模型
        $this->load->model('user_model');
        //载入表单验证
        $this->load->library('form_validation');
        //表单验证规则
        $this->form_validation->set_rules('email','邮箱','trim|required|min_length[4]|max_length[20]|valid_email|callback_email_check');
        $this->form_validation->set_rules('name','昵称','trim|required|min_length[2]|max_length[20]|callback_name_check');
        $this->form_validation->set_rules('password','密码','trim|required|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('password2','确认密码','trim|required|matches[password]');
        $this->form_validation->set_rules('tm_id','TM ID','trim|required|is_natural_no_zero');
        //自定义错误提示
        $this->form_validation->set_message('min_length', '{field}必须至少{param}位.');
        $this->form_validation->set_message('max_length', '{field}不得超过{param}位.');
        $this->form_validation->set_message('matches', '{field}与{param}不一致.');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('inc/header');
            $this->load->view('user/register');
            $this->load->view('inc/footer');
        }
        else
        {
            //加密
            $password = crypt(html_escape($this->input->post('password')),$this->config->item('salt'));
            //转义
            $email = html_escape($this->input->post('email'));
            $name = html_escape($this->input->post('name'));
            $tm_id = html_escape($this->input->post('tm_id'));
            //赋值
            $user_obj = new User_model();
            $user_obj->email = $email;
            $user_obj->name = $name;
            $user_obj->tm_id = $tm_id;
            $user_obj->password = $password;

            //插入数据库
            if($this->user_model->store($user_obj))
            {
                $data['message'] = '注册成功！';
                $data['url'] = 'user/login';
                $this->load->view('inc/header');
                $this->load->view('inc/success',$data);
                $this->load->view('inc/footer');
            }
            else
            {
                show_error('未知原因,注册失败',500);
            }
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    //用户登录
    public function login()
    {
        //载入表单辅助函数
        $this->load->helper(array('form'));
        //载入表单验证
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','邮箱','trim|required|min_length[4]|max_length[20]|valid_email');
        $this->form_validation->set_rules('password','密码','trim|required|min_length[4]|max_length[30]');

        //自定义错误提示
        $this->form_validation->set_message('min_length', '{field}必须至少{param}位.');
        $this->form_validation->set_message('max_length', '{field}不得超过{param}位.');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('inc/header');
            $this->load->view('user/login');
            $this->load->view('inc/footer');
        }
        else
        {

            //载入user模型
            $this->load->model('user_model');

            $password = crypt(html_escape($this->input->post('password')),$this->config->item('salt'));
            $email = html_escape($this->input->post('email'));

            //判断账号是否停用
            if(!$this->user_model->is_enable($email))
            {
                $data['error_message'] = '账号停用！';
                $this->load->view('inc/header');
                $this->load->view('user/login',$data);
                $this->load->view('inc/footer');
            }
            else
            {
                //判断email和密码是否匹配
                if($this->user_model->match($email,$password))
                {
                    //获取用户信息
                    //如果获取的用户存在
                    if($user_obj = $this->user_model->get_user_info($email))
                    {
                        $email = $this->security->xss_clean($user_obj->email);
                        $name = $this->security->xss_clean($user_obj->name);
                        //roles字符串转换成数组
                        $roles = explode("|",$user_obj->roles);
                        $user_data = array(
                            'email'  => $email,
                            'name' => $name,
                            'roles' => $roles
                        );
                        $this->session->set_userdata($user_data);
                        redirect();
                    }
                    else//如果不存在返回错误
                    {
                        show_error('未知原因,获取用户数据失败',500);
                    }
                }
                else
                {
                    $data['error_message'] = '用户名或者密码错误！';
                    $this->load->view('inc/header');
                    $this->load->view('user/login',$data);
                    $this->load->view('inc/footer');
                }
            }
        }
    }

    //用户注销
    public function logout()
    {
        session_destroy();
        redirect('user/login');
    }

    //回调验证user是否存在
    public function email_check($email)
    {

        if ($this->user_model->email_check($email))
        {
            $this->form_validation->set_message('email_check', '邮箱：{field} 已注册');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //回调验证name是否存在
    public function name_check($name)
    {
        if ($this->user_model->name_check($name))
        {
            $this->form_validation->set_message('name_check', '昵称：{field} 已存在');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}
