<?php
    class User_model extends CI_Model
    {
        public $tm_id;
        public $email;
        public $roles;
        public $name;
        public $enable;
        public $create_at;
        public $update_at;
        public $password;

        public function __construct()
        {
            parent::__construct();
            //创建现在的时间戳
            $this->create_at = time();
            $this->update_at = time();
            $this->enable = TRUE;
            $this->roles = 'role_user';
        }


        public function update($user_obj)
        {
            $user_obj->update_at = time();
            $this->db->update('guess_user', $user_obj);

        }

        //创建用户
        //成功返回True,失败记录log,返回False
        public function store($user_obj)
        {
            //$this->db->trans_start();
            if($this->db->insert('guess_user', $user_obj))
                return TRUE;
            else
            {
                log_message('error',$this->db->error());
                return FALSE;
            }

            //$this->db->trans_complete();
        }

        //判断邮箱和密码是否匹配
        public function match($email,$password)
        {
            $query = $this->db->where('email', $email)
                ->get('guess_user');
            $row = $query->row();
            if(isset($row))
            {
                if($row->password === $password)
                    return TRUE;
            }
            return FALSE;
        }

        //通过email地址获取用户信息对象
        //return obj
        public function get_user_info($email)
        {
            $query = $this->db->where('email', $email)
                ->get('guess_user');
            $row = $query->row();
            if(isset($row))
            {
                return $row;
            }
            else
            {
                return NULL;
            }
        }

        //判断用户账号是否可用
        public function is_enable($email)
        {
            $query = $this->db->where('email', $email)
                ->get('guess_user');
            $row = $query->row();
            if(isset($row))
            {
                if($row->enable == 1)
                    return TRUE;
            }
            return FALSE;
        }

        //判断邮箱是否已经注册
        public function email_check($email)
        {
            //获取此邮箱用户个数
            $email_num = $this->db->get_where('guess_user',array('email'=>$email))->num_rows();
            //如果有存在就返回FALSE
            if($email_num)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        //判断昵称是否注册
        public function name_check($name)
        {
            //获取此昵称用户个数
            $name_num = $this->db->get_where('guess_user',array('name'=>$name))->num_rows();
            if($name_num)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

    }