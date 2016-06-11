<?php
    class User extends CI_Model {

        public $id;
        public $user_group_id;
        public $user;
        public $name;
        public $enable;
        public $create_at;
        public $update_at;

        public function __construct()
        {
            parent::__construct();
            $this->create_at = time();
            $this->update_at = time();
            $this->enable = TRUE;
        }

        public function update($user)
        {
            
        }

    }