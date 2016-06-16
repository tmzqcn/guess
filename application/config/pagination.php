<?php
//每页数据个数
$config['per_page'] = 20;
$config['first_link'] = false;
$config['last_link'] = false;
$config['prev_link'] = '&lt;';
$config['next_link'] = '&gt;';

$config['use_page_numbers'] = TRUE;

//把结果包在ul标签里
$config['full_tag_open'] = '<nav><ul class="pagination">';
$config['full_tag_close'] = '</ul></nav>';
//自定义数字
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
//当前页
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a><li>';
//前一页
$config['prev_tag_open'] = '<li class="prev">';
$config['prev_tag_close'] = '</li>';
//后一页
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '<li>';

