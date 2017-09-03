<?php

/* 
 * 公共验证方法(header头使用，过期跳转登录)
 */
function isLogin(){
    $resp = array(
        'status' => false,
        'info' => array()
    );
    $CI = & get_instance();
    $CI->load->library('session');
    $sess = $CI->session->userdata('trips_userInfo');
    if(empty($sess)){
        $resp['status'] = true;
        $resp['info']['msg'] = '未登录或登录已过期';
    }else{
        $resp['info']['msg'] = $sess['username'];
    }
    return $resp;
}

