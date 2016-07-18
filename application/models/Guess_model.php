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

        //添加tm竞猜比赛
        public function store_tm_match($match_id,$home_id,$home_name,$away_id,$away_name,$fixture,$deadline,$home_odds,$away_odds,$draw_odds)
        {
            $this->db->trans_start();
            //更新球队信息
            $this->add_team_info($home_name,$home_id);
            $this->add_team_info($away_name,$away_id);

            if($this->get_team_by_tmid($away_id)->id&&$this->get_team_by_tmid($home_id)->id)
            {
                $match_data = array(
                    'tm_match_id' => $match_id,
                    'home_id' => $this->get_team_by_tmid($home_id)->id,//球队id，非tm_id
                    'away_id'  => $this->get_team_by_tmid($away_id)->id,
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

        /*
        * 添加其他比赛
        *
        */
        public function store($home_name,$away_name,$fixture,$deadline,$home_odds,$away_odds,$draw_odds)
        {
            $this->db->trans_start();
            $this->add_team_info($home_name);
            $this->add_team_info($away_name);
            $home_id = $this->get_team_by_name($home_name)->id;
            $away_id = $this->get_team_by_name($away_name)->id;
            $match_data = array(
                'tm_match_id' => NULL,
                'home_id' => $home_id,
                'away_id'  => $away_id,
                'fixture' => $fixture,
                'deadline' => $deadline,
                'update_at' => time()
            );
            if($this->db->insert('guess_match_info', $match_data))
            {

                $match = $this->get_match_by_fixture($home_name,$away_name,$fixture);
                if($match)
                {
                    $id = $match->id;
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
            else
            {
                return FALSE;
            }

        }

        /*
         * 添加球队信息
         * 如果存在就更新球队名
         * 如果有tmid添加tmid，没有就设置tm_id为null
         */
        public function add_team_info($name,$tm_id=NULL)
        {
            if($tm_id === NULL)
            {
                if(!$this->get_team_by_name($name))
                {

                    $data = array(
                        'team_name' => $name,
                        'tm_id'  => NULL
                    );
                    $this->db->insert('guess_team_info', $data);
                }
            }
            else
            {
                if($this->get_team_by_tmid($tm_id))
                {
                    $data = array(
                        'team_name' => $name
                    );
                    $this->db->where('tm_id',$tm_id);
                    $this->db->update('guess_team_info', $data);
                }
                else
                {
                    $data = array(
                        'team_name' => $name,
                        'tm_id'  => $tm_id
                    );
                    $this->db->insert('guess_team_info', $data);
                }
            }
        }


        public function get_team_by_tmid($tm_id)
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

        public function get_team_by_id($id)
        {
            $query = $this->db->where('id', $id)
                ->get('guess_team_info');
            $row = $query->row();
            if(isset($row))
            {
                return $row;
            }
            return FALSE;
        }

        public function get_team_by_name($team_name)
        {
            $query = $this->db->where('team_name', $team_name)
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

        //通过主客队名和比赛时间获取比赛
        public function get_match_by_fixture($home_name,$away_name,$fixture)
        {
            $this->db->select()
                ->from('guess_match_info')
                ->where('fixture',$fixture);
            $query = $this->db->get();
            foreach($query->result() as $re)
            {
                if(($re->home_id == $this->get_team_by_name($home_name)->id) && ($re->away_id == $this->get_team_by_name($away_name)->id))
                    return $re;
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


        //通过比赛id获取各个赔率
        public function get_odds($match_id)
        {
            $query = $this->db->where('match_id',$match_id)
                ->get('guess_match_odds');
            return $query->result();
        }


        /*
         * 获取用户积分
         *
         */
        public function get_point($user_id)
        {
            $query = $this->db->where('user_id', $user_id)
                ->get('guess_user_point');
            $row = $query->row();
            if(isset($row))
            {
                return $row;
            }
            return FALSE;
        }

        /*
         * 用户添加竞猜记录
         *
         */
        public function add_guess_info($match_id,$result,$point,$user_id)
        {
            if($result == 'win')
                $result = '1';
            if($result == 'draw')
                $result = '0';
            if($result == 'fail')
                $result = '-1';

            $data = array(
                'user_id' => $user_id,
                'match_id' => $match_id,
                'score' => $result,
                'point' => $point,
                'guess_result' => 0
            );
            $this->db->insert('guess_guess_info', $data);
        }


        /*
         * 从user_id用户扣除point
         *
         */
        public function reduce_point($user_id,$point)
        {
            $p = $this->get_point($user_id)->point - $point;

            $data = array(
                'point' => $p
            );
            $this->db->where('user_id',$user_id);
            $this->db->update('guess_user_point', $data);
        }

        /*
         * 用户竞猜投注
         *
         */
        public function guess_bet($match_id,$result,$point,$user_id)
        {
            $this->db->trans_start();
            $this->add_guess_info($match_id,$result,$point,$user_id);
            $this->reduce_point($user_id,$point);

            $this->db->trans_complete();
        }

        /*
         *
         *
         */
        public function get_bet_ratio($match_id)
        {
            $this->db->select_sum('point');
            $this->db->from('guess_guess_info');
            $this->db->where('match_id',$match_id);
            $this->db->where('score','1');
            $win = $this->db->get()->row()->point;

            $this->db->select_sum('point');
            $this->db->from('guess_guess_info');
            $this->db->where('match_id',$match_id);
            $this->db->where('score','0');
            $draw = $this->db->get()->row()->point;

            $this->db->select_sum('point');
            $this->db->from('guess_guess_info');
            $this->db->where('match_id',$match_id);
            $this->db->where('score','-1');
            $fail = $this->db->get()->row()->point;

            $arr = array();
            $s = $win+$draw+$fail;
            if($s == 0)
            {
                $arr['win'] = 0;
                $arr['draw'] = 0;
                $arr['fail'] = 0;
            }
            else
            {
                $arr['win'] = round(100*$win/$s ,1);
                $arr['draw'] = round(100*$draw/$s ,1);
                $arr['fail'] = round(100*$fail/$s ,1);
            }


            return $arr;

        }

    }