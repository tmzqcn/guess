<?php
    class Guess_model extends CI_Model
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
            $this->enable = true;
            $this->roles = 'role_user';
        }
    }