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
         * $need_roles表示需要某role
         * $roles表示用户拥有的角色组
         * eg：用户管理需要role_user_admin这个role，$need_roles就是role_user_admin，当前用户的session中roles就是$roles
         * 参数都可以是array
         */
        public function  authorize_by_role($need_roles,$roles)
        {
            $roles = $this->get_full_roles($roles);
            //如果roles里包含need_roles，验证通过
            if(in_array($need_roles,$roles))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        
        /*
         * 获取完整roles
         * 
         */
        public function get_full_roles($roles)
        {
            //如果current($roles)为false表示数组已经结束
            while(current($roles) !== FALSE)
            {
                //获取当前角色继承自哪些角色
                $roles_from_config = $this->CI->config->item(current($roles));
                //获取不到表示角色无继承
                if($roles_from_config !== NULL)
                {
                    foreach ($roles_from_config as $role)
                    {
                        if (!in_array($role, $roles))
                        {
                            //放入roles尾部
                            array_push($roles, $role);
                        }
                    }
                }
                //指到下一个数据
                next($roles);
            }
            return $roles;
        }
    }