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
            //如果roles里包含need_roles，验证通过
            /*
            if(in_array($need_roles,$roles))
            {
                return TRUE;
            }*/
            $r = $roles;
            $this->get_full_roles($roles,$r);


        }
        
        /*
         * 获取完整roles
         * 
         */
        public function get_full_roles($roles,$r)
        {

            /*
            foreach ($roles as $role)
            {

                $roles_from_config = $this->CI->config->item($role);
                if($roles_from_config !== NULL)
                {
                    foreach ($roles_from_config as $role_tmp)
                    {

                        if (!in_array($role_tmp, $r))
                        {
                            //放入all_roles尾部
                            array_push($r, $role_tmp);
                            $tmp[] = $role_tmp;

                            $this->get_full_roles($tmp,$r);
                        }
                        var_dump($r);
                        var_dump(NULL);
                    }
                }

            }
            */
        }

    }