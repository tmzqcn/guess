<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Verify
    {
        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
            // Assign the CodeIgniter super-object
            $this->CI =& get_instance();
        }
        /*
         * 验证用户是否被授权
         * $need_role表示需要某role
         * $roles表示用户拥有的角色组
         * eg：用户管理需要role_user_admin这个role，$need_role就是role_user_admin，当前用户的session中roles就是$roles
         * 参数都是array
         */
        public function  authorize($need_role,$roles)
        {
            $roles_tmp = $roles;
            foreach($roles as $role)
            {
                if($this->CI->config->item($role))
                {
                    
                }
            }

        }
    }