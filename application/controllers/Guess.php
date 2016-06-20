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

    public function store()
    {
        if($this->verify->authorize_by_role('role_guess_admin',$this->session->roles))
        {
            //载入表单辅助函数
            $this->load->helper(array('form'));
            //载入user模型
            $this->load->model('guess_model');
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
                $this->load->view('guess/store');
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
                    show_error('未知原因,添加失败',500);
                }
            }
        }
        else
        {
            show_error('权限不足，无法访问此页',403);
        }
    }

}
