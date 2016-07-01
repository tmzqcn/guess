<?php
    class Guess_model extends CI_Model
    {
        public $home_id;
        public $away_id;

        public $update_at;


        public function __construct()
        {
            parent::__construct();
            //创建现在的时间戳

            $this->update_at = time();

        }

        //添加
        public function store_match($match_id,$home_id,$home_name,$away_id,$away_name,$fixture,$deadline)
        {
            $this->db->trans_start();

            $this->add_team_info($home_id,$home_name);
            $this->add_team_info($away_id,$away_name);

            if($this->get_by_tmid($away_id)->id&&$this->get_by_tmid($home_id)->id)
            {
                $match_data = array(
                    'tm_match_id' => $match_id,
                    'home_id' => $this->get_by_tmid($home_id)->id,
                    'away_id'  => $this->get_by_tmid($away_id)->id,
                    'fixture' => $fixture,
                    'deadline' => $deadline,
                    'update_at' => time()
                );
                if($this->db->insert('guess_match_info', $match_data))
                {
                    $this->db->trans_complete();
                    return TRUE;
                }


            }
            else
            {
                return FALSE;
            }



        }

        public function add_team_info($tm_id,$name)
        {
            $data = array(
                'team_name' => $name,
                'tm_id'  => $tm_id
            );
            $this->db->replace('guess_team_info', $data);
        }

        public function get_by_tmid($tm_id)
        {
            $query = $this->db->where('tm_id', $tm_id)
                ->get('guess_team_info');
            $row = $query->row();
            if(isset($row))
            {
                return $row;
            }
            return FALSE;
        }

        public function match_is_exist($tm_match_id)
        {
            $name_num = $this->db->get_where('guess_match_info',array('tm_match_id'=>$tm_match_id))->num_rows();
            if($name_num)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        /*
         * 获取match
         * page_num是当前页码
         * num_per_page是每页显示数目
         */
        public function get_match($page_num=1,$num_per_page=20)
        {
            $query = $this->db->limit($num_per_page,($page_num-1)*$num_per_page)
                ->order_by('id', 'DESC')
                ->get('guess_match_info')
            ;
            return $query;
        }
        //返回所有match数目
        public function get_match_num()
        {
            $query = $this->db->get('guess_match_info');
            return count($query->result());
        }


    }