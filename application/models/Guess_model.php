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
        public function store_match($match_id,$home_id,$home_name,$away_id,$away_name,$fixture,$deadline,$home_odds,$away_odds,$draw_odds)
        {
            $this->db->trans_start();
            //更新球队信息
            $this->add_team_info($home_id,$home_name);
            $this->add_team_info($away_id,$away_name);

            if($this->get_by_tmid($away_id)->id&&$this->get_by_tmid($home_id)->id)
            {
                $match_data = array(
                    'tm_match_id' => $match_id,
                    'home_id' => $home_id,
                    'away_id'  => $away_id,
                    'fixture' => $fixture,
                    'deadline' => $deadline,
                    'update_at' => time()
                );
                if($this->db->insert('guess_match_info', $match_data))
                {
                    //获取刚插入的id,获取不到返回错误
                    $id = $this->get_match_by_tmid($match_id);
                    if($id)
                    {
                        $id = $id->id;
                    }
                    else
                    {
                        return FALSE;
                    }
                    $data_home = array(
                        'match_id' => $id,
                        'score' => '1',
                        'odds' => $home_odds
                    );
                    $data_draw = array(
                        'match_id' => $id,
                        'score' => '0',
                        'odds' => $draw_odds
                    );
                    $data_away = array(
                        'match_id' => $id,
                        'score' => '-1',
                        'odds' => $away_odds
                    );

                    if($this->db->insert('guess_match_odds', $data_home) && $this->db->insert('guess_match_odds', $data_draw) && $this->db->insert('guess_match_odds', $data_away))
                    {
                        $this->db->trans_complete();
                        return TRUE;
                    }
                    else
                    {
                        return FALSE;
                    }
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
        //通过tm match id 获取比赛
        public function get_match_by_tmid($tm_match_id)
        {
            $query = $this->db->where('tm_match_id', $tm_match_id)
                ->get('guess_match_info');
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
         * 比赛时间大于当前时间
         */
        public function get_match($page_num=1,$num_per_page=20)
        {

            $query = $this->db->where('fixture >', time())
                ->limit($num_per_page,($page_num-1)*$num_per_page)
                ->order_by('fixture', 'ASC')
                ->get('guess_match_info')
            ;


            /*
             *
             $this->db->select('match.home_id,match.away_id,match.fixture,match.deadline,match.update_at,team.team_name,team.id')
                ->from('guess_match_info as match')
                ->join('guess_team_info as team','match.home_id=team.id or match.away_id=team.id')
                ->limit($num_per_page,($page_num-1)*$num_per_page)
                ->order_by('match.id', 'DESC')
                ;
            $query = $this->db->get();
            */
            return $query->result();
        }
        //返回所有match数目
        public function get_match_num()
        {
            $query = $this->db->get('guess_match_info');
            return count($query->result());
        }

        //通过tmid获取球队信息
        public function get_team($tm_id)
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

        //通过比赛id获取各个赔率
        public function get_odds($match_id)
        {
            $query = $this->db->where('match_id',$match_id)
                ->get('guess_match_odds');
            return $query->result();
        }

    }