<?php

/**
　* 下划线转驼峰
　*/
function toCamelCase($str)
{
    $array = explode('_', $str);
    $result = ucfirst($array[0]);
    $len=count($array);
    if($len>1)
    {
        for($i=1;$i<$len;$i++)
        {
            $result.= ucfirst($array[$i]);
        }
    }
    return $result;
}

/*
 *	检查一个字符串或数组是否为空
 *	@
 */
function is_empty($str)
{
    return empty($str)?false:true;
}

/*
 *	用数组中的某个值重设数组键值
 *
 */
function reset_array_key($array,$key,$field = '')
{
    $_array = array();
    foreach($array as $value)
    {
        $_array[$value[$key]] = !empty($field)?$value[$field]:$value;
    }
    return $_array;
}

/*
 *
 *	比较函数,$oper为比较运算符
 */
function compare($num1,$num2,$oper=">")
{
    switch ($oper) {
        case '==':
            $result = ($num1==$num2);
            break;
        case '===':
            $result = ($num1===$num2);
            break;
        case '<':
            $result = ($num1<$num2);
            break;
        case '<=':
            $result = ($num1<=$num2);
            break;
        case '!=':
            $result = ($num1!=$num2);
            break;
        case '<>':
            $result = ($num1<>$num2);
            break;
        case '>=':
            $result = ($num1>=$num2);
            break;
        case '>':
            $result = ($num1>$num2);
            break;
        default:
            $result = false;
            break;
    }
    return $result;
}

/*
 *	检查两个指是否相等
 */
function eq($arg1,$arg2)
{
    return ($arg1 == $arg2)?true:false;
}



function array_values_to_string(&$array)
{
    foreach($array as $key=>&$value)
    {
        if (is_array($value))
        {
            array_values_to_string($value);
        }
        else
        {
            $value = (string) $value;
        }
    }
}

function getFilePath($fileUrl,$type='user')
{
    if($fileUrl)
    {
        $fileUrl = explode(',',$fileUrl);
        foreach ($fileUrl as $key => &$value)
        {
            $value = \Common\Library\File::tmp_to_final($value, 'image', $type);
            if(!$value) return false;
        }

        $filePath = implode(',',$fileUrl);
        return $filePath;
    }
    else
    {
        return false;
    }
}


function loadPlugin($plugin,$class,$method,$params)
{
    $pluginClass = "\\Common\\Plugin\\".$plugin."\\".ucfirst($class);
    if (!class_exists($pluginClass) || !method_exists($pluginClass,$method)) return false;
    $obj = new $pluginClass();
    return $obj->$method($params);

}




/*
*   毫秒时间戳
*/
function mtime($_time = '')
{
    if (empty($_time))
    {
        list($t1, $t2) = explode(' ', microtime());
        $time = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
        $time = (string) $time;
    }
    else
    {
        $time = strtotime($_time)."000";
    }
    return $time;
}



function page($count,$psize = '')
{
    $psize = ($psize>0)?$psize:C('psize');
    $psize = $psize?$psize:40;
    $page = new \Think\Page($count,$psize);
    return $page->show();
}

/*
 *	视图模板中输出时间
 */
function vtime($format="Y-m-d",$time)
{
    if (!$time)
    {
        return "-";
    }
    $time=substr($time,0,10);
    return date($format,$time);
}

/*
 *  视图模板中输出时间
 */
function otime($time)
{
    if (!$time)
    {
        return "-";
    }
    $time=substr($time,0,10);
    return date('Y-m-d H:i:s',$time);
}


/*
 *	状态描述
 */
function status_desc($type = 'STATUS',$status)
{
    $status_arr = C($type);
    if (!$status_arr)
    {
        return false;
    }
    return $status_arr[$status];
}

/*
*   独占锁定，处理并发请求
*/
function lock($key)
{
    return apcu_add($key,'locked');
}

function unlock($key)
{
    return apcu_delete($key);
}

function _U($params = array())
{

    $_query = $_GET;
    unset($_query['_URL_']);
    unset($_query['p']);
    $_uri = explode('?',$_SERVER['REQUEST_URI']);
    $url = preg_replace("/\/p\/[0-9]*\//","/",rtrim($_uri[0],"/")."/");

    foreach($_query as $key=>$value)
    {
        if (strpos($url,$key."/") !== false)
        {
            $str = ($value == '')?'':"/".$key.'/'.$value.'/';

            $url = preg_replace("/\/".$key."[^\/]*\/[^\/]*\//",$str,$url);
        }
        else
        {
            $url .= $key.'/'.$value.'/';
        }
    }

    $url = preg_replace("/[^\/]*\/[\s]*\//","",$url);
    $url = rtrim($_SERVER['HTTP_HOST'].$url,'/').'/';

    if (empty($params)) return "http://".$url;
    foreach($params as $key=>$value)
    {
        if (strpos($url,$key."/") !== false)
        {
            $str = ($value === false)?'':$key.'/'.$value.'/';
            $url = preg_replace("/".$key."[^\/]*\/[^\/]*\//",$str,$url);
        }
        else
        {
            if ($value === false) continue;
            $url .= $key.'/'.$value.'/';
        }
    }

    return "http://".str_replace("//","/",$url);
}

/**
 * 格式化url参数
 * @param  array  $params [description]
 * @return [type]         [description]
 */
function urlParams($params = array())
{
    $params = empty($params) ? I("get.") : $params;
    foreach ($params as $key => $value) {
        if (is_array($value))
        {
            if (empty(array_filter($value)))
            {
                unset($params[$key]);
            }
            foreach($value as $k=>$v)
            {
                if ($v != '')
                {
                    $params[$key."[".$k."]"] = $v;
                }
            }
            unset($params[$key]);
        }
        if ($value == '') unset($params[$key]);
    }
    return $params;
}

function httppost($url,$content,$header = array())
{
    $return = array();
    $ch  =  curl_init ();
    curl_setopt ( $ch ,  CURLOPT_URL ,  $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($content) || !empty($header))
    {
        curl_setopt ( $ch ,  CURLOPT_POST ,  1 );
        curl_setopt ( $ch ,  CURLOPT_POSTFIELDS , $content);
    }
    if (!empty($header))
    {
        curl_setopt ($ch, CURLOPT_HTTPHEADER , $header);  //构造IP
    }
    curl_setopt ( $ch ,  CURLOPT_RETURNTRANSFER,  1 );
    $response = curl_exec($ch);
    $return = ['code'=>curl_errno($ch),'msg'=>curl_error($ch),'content'=>$response];
    curl_close($ch);
    return $return;
}

/**
 * 下划线转驼峰
 * @param  string  $str     需要转换的字符串
 * @param  boolean $ucfirst 首字母是否大写
 * @return string           转换后的字符串
 */
function convertUnder($str,$ucfirst = false)
{
    $str = ucwords(str_replace('_', ' ', $str));
    $str = str_replace(' ','',lcfirst($str));
    return $ucfirst ? ucfirst($str) : $str;
}

/*
*   递归创建目录
*   必须是绝对目录
*/
function xmkdir($pathurl)
{
    $path = "";
    $str = explode("/",$pathurl);
    foreach($str as $dir)
    {
        if (empty($dir)) continue;
        $path .= "/".$dir;
        if (!is_dir($path))
        {
            mkdir($path);
        }
    }
}

function datetime($time)
{
    return $time>0 ? date("Y-m-d H:i:s",substr($time,0,10)):'-';
}

function dateday($time)
{
    return $time>0 ? date("Y-m-d",substr($time,0,10)):'-';
}

/*
*   词典读取
*/
function dict($index,$value = NULL)
{
    $dict = C('dict');
    if (!$index || !$dict[$index])
    {
        return false;
    }
    return isset($value) ? $dict[$index][$value] : $dict[$index];
}

/*
* 生成词典链接
*/
function dictlink($index,$controller='')
{
    if (empty($controller)) $controller = CONTROLLER_NAME;
    return U($controller.'/ajaxdict',['index'=>$index]);
}


/**
 * 扩展编码转换，可针对数组转换
 * @param  mix $mix         需要转换的参数
 * @param  string $in_charset  原编码
 * @param  string $out_charset 转换的编码
 * @return [type]              [description]
 */
function _iconv($mix,$in_charset = 'gbk',$out_charset = 'utf-8')
{
    if (is_string($mix))
    {
        $mix = iconv($in_charset, $out_charset, trim($mix));
    }
    else
    {
        foreach ($mix as &$str) {
            $str = iconv($in_charset, $out_charset, trim($str));
        }
    }
    return $mix;
}

function addCache($k,$v,$ttl = 180)
{
    return S($k,$v,$ttl);
    //return apcu_add($k,$v,$ttl);
}

/*
*	随机码生成
*	@param			int 		$length		长度
*/
function randcode($length)
{
    if (ENT_DEBUG) return 5555;
    $start = pow(10,($length-1));
    $end = pow(10,$length)-1;
    return rand($start,$end);
}

function unsetCache($k)
{
    return apcu_delete($k);
}

function isChain($url)
{
    $url = strtolower($url);
    if (substr($url,0,7) == 'http://' || substr($url,0,8) == 'https://')
    {
        return true;
    }
    return false;
}

function formatTime($time){
    return date('Y/m/d H:i',$time);
}
//生成短openid
function makeShortOpenid($id)
{
    return $id.time().rand(1000, 9999);
}

//将整型字符串转为数字
function intValue($int)
{
    return floor(floatval($int));
}

/*  查询物流明细
    logistics 物流名称
    logistics_no 物流单号
*/
function getExpress($logistics,$logistics_no)
{
    if ($logistics && $logistics_no) {
        Vendor('Express.Express','','.class.php');
        $exp = new Express();
        $express = $exp->getorder($logistics,$logistics_no);
    }
    if ($express['status']!='200')
    {
        $express['data'][1]['time'] = '';
        $express['data'][1]['context'] = '暂无物流信息';
    }
    return $express;
}

function joinImg($img)
{
    if(!$img)
    {
        return '';
    }
    else
    {
        $img = explode(',',$img);
        foreach($img as &$val)
        {
            if(substr($val,0,1) == '/')
                $val = 'http://'.I('server.HTTP_HOST').$val;
        }
        $img = implode(',',$img);
    }
    return $img;
}

//极光推送
function jpush($receive='all',$content='',$content_message='')
{
    //调用推送,并处理
    Vendor('Jpush.jpush');//调用 极光 接口
    $pushObj = new jpush();
    $result = $pushObj->push($receive,$content,$m_type='',$m_txt='',$m_time='86400',$content_message);
}

//发送短信
// function sendsms($mobile,$content)
// {
//     if (SMSDEBUG) return true;
//     Vendor('SMS.SMSHelper');
//     $useclass = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)[1]['class'];

//     if (in_array($useclass,array('yeepayAction','tftpayAction','payAction')))
//     {
//         $rs = SMSHelper::sendSMS($mobile, $content);
//         send_sms_count(SEND_TYPE_SMS,$mobile, $content);

//     }
//     else
//     {
//         $rs = SMSHelper::sendSMSC2($mobile, $content);
//         send_sms_count(SEND_TYPE_SMSC2,$mobile, $content);
//     }

//     return $rs;
// }

/*
 *   生成短链接
 *   调用新浪API出错的话将调用百度的，也失败直接返回原URL
 */
function getShortUrl($url)
{
    /*$gate = 'http://api.t.sina.com.cn/short_url/shorten.json';
    $appkey = '3187463259';
    $rs = "{$gate}?source={$appkey}&url_long={$url}";
    $context = stream_context_create(array(
        'http' => array(
        'timeout' => 1 //超时时间，单位为秒
        )
    ));
    $arr = json_decode(file_get_contents($rs,0,$context), true);

    if($arr) $arr = $arr['urls'];
    if (!$arr)
    {
        $gate = 'http://dwz.cn/create.php';
        $opts  = array(
            'http' =>array(
            'method' => "POST" ,
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content'=>"url=".$url,
            'timeout' => 1 //超时时间，单位为秒
           )
        );
        $context  =  stream_context_create ( $opts );
        $rs = file_get_contents ( $gate,  false ,  $context );
        $arr = json_decode($rs,true);
        if ($arr['tinyurl']) $url = $arr['tinyurl'];
    }
    else
    {
        if ($arr[0]['url_short'] and $arr[0]['url_short'] != 'http://t.cn/') $url = $arr[0]['url_short'];
    }*/
    $gate = "https://www.xyixy.com/api/?key=W2LwvuEUpg3G&url=".$url;
    $rs = httppost2($gate);
    if($rs) $url = $rs;
    return $url;
}

function httppost2($url,$content,$header = array())
{
    $return = array();
    $ch  =  curl_init ();
    curl_setopt ( $ch ,  CURLOPT_URL ,  $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($content) || !empty($header))
    {
        curl_setopt ( $ch ,  CURLOPT_POST ,  1 );
        curl_setopt ( $ch ,  CURLOPT_POSTFIELDS , $content);
    }
    if (!empty($header))
    {
        curl_setopt ($ch, CURLOPT_HTTPHEADER , $header);  //构造IP
    }
    curl_setopt ( $ch ,  CURLOPT_RETURNTRANSFER,  1 );
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}



function PU($ma,$params=array())
{
    // $array = array('us_usid'=>172);
    // if($params)
    // {
    //     $params = array_merge($params,$array);
    // }
    // else
    // {
    //     $params = $array;
    // }

    return U($ma,$params);

}

function get2Array2Array($array, $field='id')
{
    if(!$array)
    {
        return [];
    }
    $temp = [];
    foreach ($array as $value)
    {
        if(is_array($value))
        {
            $temp[]= $value[$field];
        }else{
            $temp[]= $value;
        }
    }
    return $temp;
}


//判断是否是微信客户端
function is_weixin()
{
    if ( stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
        return true;
    }
    return false;
}

//获取wap链接
function getWapLink()
{
    $host = $_SERVER['HTTP_HOST'];
    $http = C('APP_SUB_DOMAIN_RULES');
    foreach ($http as $key => $value)
    {
        if($value == 'wap' or $value == 'Wap') $size = $key;
    }
    foreach ($http as $key => $value)
    {
        if(stripos($host, $key.'.') === 0)
        {
            $wap = str_replace($key.'.', $size.'.', $host);
            break;
        }
    }
    if($_SERVER['HTTPS'] && $_SERVER['HTTPS'] == 'on')
    {
        $wap = "https://".$wap;
    }
    else
    {
        $wap = 'http://'.$wap;
    }
    return $wap;
}

//获取wap链接
function getUserShopLink()
{
    $host = $_SERVER['HTTP_HOST'];
    $http = C('APP_SUB_DOMAIN_RULES');
    foreach ($http as $key => $value)
    {
        if($value == 'userShop' or $value == 'UserShop') $size = $key;
    }
    foreach ($http as $key => $value)
    {
        if(stripos($host, $key.'.') === 0)
        {
            $wap = str_replace($key.'.', $size.'.', $host);
            break;
        }
    }
    if($_SERVER['HTTPS'] && $_SERVER['HTTPS'] == 'on')
    {
        $wap = "https://".$wap;
    }
    else
    {
        $wap = 'http://'.$wap;
    }
    return $wap;
}

//获取api链接
function getApiLink()
{
    $host = $_SERVER['HTTP_HOST'];
    $http = C('APP_SUB_DOMAIN_RULES');
    foreach ($http as $key => $value)
    {
        if($value == 'api' or $value == 'Api') $size = $key;
    }
    foreach ($http as $key => $value)
    {
        if(stripos($host, $key.'.') === 0)
        {
            $wap = str_replace($key.'.', $size.'.', $host);
            break;
        }
    }
    if($_SERVER['HTTPS'] && $_SERVER['HTTPS'] == 'on')
    {
        $wap = "https://".$wap;
    }
    else
    {
        $wap = 'http://'.$wap;
    }
    return $wap;
}

function getConf($key)
{
    if (!$key) return '';
    $rs = D('Conf')->where(['key'=>$key])->find();
    return $rs['value'];
}


/**
 * 获取宝聚阁信息
 */
function getBaoJuGeInfo()
{
    $where = ['role'=> \Common\Business\Struct\UserMerchantStruct::GLOAD_MERCHANT_TYPE];
    $app_info = D('UserMerchantApp')->where($where)->find();
    $merchant_info = D('UserMerchant')->find($app_info['umid']);
    $merchant['user_merchant_app'] = $app_info;
    $merchant['user_merchant'] = $merchant_info;
    $merchant['id'] = $merchant_info['id'];
    $merchant['umopenid'] = $merchant_info['umopenid'];
    return $merchant;
}

/**
 * 获取1+1角色信息
 */
function getOnePlusOneInfo($umid = 2037)
{
    $where = ['role'=> \Common\Business\Struct\UserMerchantStruct::PLUS_MERCHANT_TYPE,'umid'=>$umid];
    $app_info = D('UserMerchantApp')->where($where)->find();
    $merchant_info = D('UserMerchant')->find($app_info['umid']);
    $merchant['user_merchant_app'] = $app_info;
    $merchant['user_merchant'] = $merchant_info;
    $merchant['id'] = $merchant_info['id'];
    $merchant['umopenid'] = $merchant_info['umopenid'];
    return $merchant;
}

function isOnePlusOne($umid)
{
    if($umid == 2037) return true;
    return false;
}
/**
 * 获取第一层分佣的金额
 * @param int $umid
 * @param float $price
 */
function commission_money($umid, $price)
{
    $info = D('UserMerchantApp')->getInfo('commission_rate', ['umid'=> $umid]);
    $comission = D('UserCustomerCommission')->getInfo('one_commission_rate', ['umid'=> $umid]);
    if($info['commission_rate'] && $comission['one_commission_rate'])
    {
        $money_temp = $info['commission_rate']*$price*$comission['one_commission_rate'];
        $money = number_format($money_temp, 2, '.', '');
    }else{
        $money = 0;
    }
    return $money;
}

function commission_moneyYG($umid, $price) {
    $info = \Common\Library\Db::table('user_merchant_app') -> getInfo('commission_rate', ['umid' => $umid]);
    $comission = \Common\Library\Db::table('user_customer_commission') -> getInfo('one_commission_rate', ['umid' => $umid]);
    if($info['commission_rate'] && $comission['one_commission_rate']) {
        $money_temp = $info['commission_rate']*$price*$comission['one_commission_rate'];
        $money = number_format($money_temp, 2, '.', '');
    } else {
        $money = 0;
    }
    return $money;
}

/*
 * 加密
 */
function encrypt($data, $key)
{
    $key = md5($key);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    for($i = 0;$i<$len; $i++)
    {
        if($x == $l)
        {
            $x = 0;
        }
        $char .= $key{$x};
        $x++;
    }
    for($i = 0;$i < $len;$i++)
    {
        $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
    }
    return base64_encode($str);
}

/*
 * 解密
 */
function decrypt($data, $key)
{
    $key = md5($key);
    $x = 0;
    $data = base64_decode($data);
    $len = strlen($data);
    $l = strlen($key);
    for($i = 0; $i < $len; $i++)
    {
        if($x == $l)
        {
            $x = 0;
        }
        $char .= substr($key, $x, 1);
        $x++;
    }

    for($i = 0; $i < $len; $i++)
    {
        if(ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
        {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }
        else
        {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return $str;
}

//统计发送信息
function send_sms_count($type,$mobile,$content)
{
    $content_count=mb_strlen($content, 'UTF-8');
    $sms_count=1;
    if($content_count>70)
    {
        $sms_count++;
        $content_count=$content_count-70;
        while($content_count>=67)
        {
            $content_count=$content_count-67;
            $sms_count++;

        }
    }
    $data=array();
    $time=time();
    $data['content']=$content;
    $data['year']=(int)date('Y',$time);
    $data['month']=(int)date('m',$time);
    $data['day']=(int)date('d',$time);
    $data['send_type']=2;
    $data['cut_count']=$sms_count;
    $data['mobile']=$mobile;
    $data['addtime']=$time;
    D('SmsCount')->add($data);
}

function is_win()
{
    return ( strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ) ? true:false;
}

/*
 *  日志记录
 */
function eblog($tag,$content,$prefix='')
{
    if (is_array($content))
    {
        ob_start();
        print_r($content);
        $content = ob_get_contents();
        ob_end_clean();
        $content = "\n".$content."\n";
    }
    $path = C('EBLOGPATH').'/'.date('Ym').'/';
    if (!is_dir($path)) xmkdir($path);
    if ($prefix)
    {
        $log_file = $path.$prefix.'_'.date('Ymd').".log";
    }
    else
    {
        $log_file = $path.date('Ymd').".log";
    }

    if(is_win())
    {
        $log_file = 'D:\proapp.txt';
    }

    $log = "[".date("YmdHis")."] ".$tag.":".$content;
    $f = fopen($log_file,"ab+");
    fwrite($f,$log."\n");
    fclose($f);
}

/*
 *  姓名加*号
 */
function nameEncrypt($name)
{
    $result = $name?mb_substr($name,0,1,'utf-8').'*'.mb_substr($name,-1,1,'utf-8'):'';
    return $result;
}



/*
 *  web页面免登陆
 */
function signin($url)
{
    if(stripos($url, '.html') !== false)
    {
        $url = substr($url, 0, strlen($url)-strlen('.html'));
    }
    $url = $url? trim($url, '').'/appsignin/1':$url;
    return $url;
}

/*
 *  获取机型
 */
function getDeviceType()
{
    $agent = strtolower(I('server.HTTP_USER_AGENT'));
    $type = 'other';
    //分别进行判断
    if (strpos($agent, 'iphone') || strpos($agent, 'ipad'))
    {
        $type = 'ios';
    }
    elseif (strpos($agent, 'android'))
    {
        $type = 'android';
    }
    return $type;
}

/*
 * 获取商品的销售次数
 */
function getSaleNum($sales_num,$price) {
    if($price >= 10000) {
        return (int) $sales_num;
    }
    if($sales_num > 0) {
        $sales_num = round(150+3.6*$sales_num);
    } else {
        $home = new \Common\Business\Customer\Ddyp();
        $max_price = D('Goods') -> where(['marketable' => 1, 'merchant_type' => \Common\Business\Struct\SupplyStruct::MERCHANT_TYPE_YJY, 'umid' => ['in', $home -> umid_list]]) -> max('price');
        $max_price = ceil($max_price/100);
        $sales_num = round($price/$max_price)+50;
        if($price <= 500 and $sales_num == 50) {
            $sales_num = round(0.1*$price);
        }
    }
    return (int) $sales_num;
}

function getSaleNumYG($sales_num,$price) {
    if($price >= 10000) {
        return (int) $sales_num;
    }
    if($sales_num > 0) {
        $sales_num = round(150+3.6*$sales_num);
    } else {
        $max_price = \Common\Library\Db::table('goods') -> getInfo('price', ['marketable' => 1, 'merchant_type' => \Common\Business\Struct\SupplyStruct::MERCHANT_TYPE_YG], 'price desc');
        $max_price = ceil($max_price['price']/100);
        $sales_num = round($price/$max_price)+50;
        if($price <= 500 and $sales_num == 50) {
            $sales_num = round(0.1*$price);
        }
    }
    return (int) $sales_num;
}

/**
 * 获取商品的代理次数
 * @param int $gid
 */
function getGoodsAgentNum($gid,$agent_price) {
    $count = D('UserShopGoods') -> cache('countUserShopGoods'.$gid,7200) -> where(['gid' => $gid]) -> count();
    if($count > 0) {
        $count = round(150+7.6*$count);
    } else {
        $home = new \Common\Business\Customer\Ddyp();
        $max_agentprice = D('Goods') -> where(['merchant_type' => \Common\Business\Struct\SupplyStruct::MERCHANT_TYPE_YJY, 'umid' => ['in', $home -> umid_list]]) -> cache('maxAgentPrice',86400) -> max('agent_price');
        $max_agentprice = ceil($max_agentprice/100);
        $count = round($agent_price/$max_agentprice)+50;
    }
    return (int) $count;
}

function getGoodsAgentNumYG($gid,$agent_price) {
    $count = \Common\Library\Db::table('user_shop_goods') -> _Db() -> cache('countUserShopGoods'.$gid,7200) -> where(['gid' => $gid]) -> count();
    if($count > 0) {
        $count = round(150+7.6*$count);
    } else {
        $max_agentprice = \Common\Library\Db::table('goods') -> _Db() -> where(['merchant_type' => \Common\Business\Struct\SupplyStruct::MERCHANT_TYPE_YG]) -> cache('maxAgentPrice',86400) -> max('agent_price');
        $max_agentprice = ceil($max_agentprice/100);
        $count = round($agent_price/$max_agentprice)+50;
    }
    return (int) $count;
}

/*
 * 购买商品支付方式
 */
function shopPayType($ptid = 0)
{
    $pay = [9,24,32,26,33];
    if($ptid) $pay[] = $ptid;
    return $pay;
}

function shopPayTypeYg($ptid = 0)
{
    $pay = [0,9,24,33];
    if($ptid) $pay[] = $ptid;
    return $pay;
}

function ckMobile($mobile){
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^1[3,4,5,7,8,9]{1}[\d]{9}$#', $mobile) ? true : false;
}

/*
    *  手机号加*号
    */
function mobileEncrypt($num)
{
    $result = $num?substr($num,0,3).'****'.substr($num,7,4):'';
    return $result;
}

/*
 * 姓名加星号
 */
function nameEncryptV2($name){
    $strlen = mb_strlen($name,'utf-8');
    $firststr = mb_substr($name,0,1,'utf-8');
    $laststr = mb_substr($name,-1,1,'utf-8');

    if ($strlen == 1) return $name;
    return $strlen == 2 ? $firststr.str_repeat('*',1) : $firststr.str_repeat('*',$strlen-2).$laststr;
}

/*
 * 姓名加星号 李**
 */
function nameEncryptV3($name){
    $strlen = mb_strlen($name,'utf-8');
    $firststr = mb_substr($name,0,1,'utf-8');

    return $strlen ==1 ? $name:$firststr.str_repeat('*',$strlen-1);
}

/*
 * 数组转成xml
 */
function arrayToXml($arr,$format = false,$deep = 0,$is_first = 1) {
    if($is_first){
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= PHP_EOL;
    }else{
        $xml  = '';
    }
    foreach ($arr as $key => $value) {
        if (!is_numeric($key))$xml .= "<$key>";
        if (is_array($value)) {
            $deep++;
            if ($format) {
                if (!is_numeric($key))$xml .= PHP_EOL;
                $xml .= str_pad('', $deep * 2, ' ');
            }
            $xml .= arrayToXml($value, $format, $deep ,0);
            if (!is_numeric($key))$xml .= "</$key>";
        } else {
            $xml .= $value;
            if (!is_numeric($key))$xml .= "</$key>";
        }
        if ($format) {
            if (!is_numeric($key))$xml .= PHP_EOL;
            $next = next($arr);
            prev($arr);
            if ($next == false || is_array($next)) {
                $xml .= str_pad('', ($deep - 1) * 2, ' ');
            } else {
                $xml .= str_pad('', $deep * 2, ' ');
            }
//            echo is_array($next) ? ' arr ' : $next;
            unset($next);
        }
        next($arr);
    }
    return $xml;
}
/**
 * 获取指定日期段内每一天的日期和天数
 * @param  Date  $startdate 开始日期 格式化时间 Y-m-d H:i:s
 * @param  Date  $enddate   结束日期 格式化时间 Y-m-d H:i:s
 * @return Array
 */
function getDateFromRange($startdate, $enddate){
    $startdate = date('Y-m-d 00:00:00',strtotime($startdate));
    $enddate = date('Y-m-d 23:59:59',strtotime($enddate));
    $stimestamp = strtotime($startdate);
    $etimestamp = strtotime($enddate);
    if($etimestamp<$stimestamp) return [];
    // 计算日期段内有多少天
    $days = (int)ceil(($etimestamp-$stimestamp)/86400);
    // 保存每天日期
    $date = array();
    for($i=0; $i<$days; $i++){
        $date[] = date('Y-m-d', $stimestamp+(86400*$i));
    }
    $data = [
        'dates' => $date,
        'days' => $days,
    ];
    return $data;
}

function sortArrByManyField(){
    $args = func_get_args();
    if(empty($args)){
        return null;
    }
    $arr = array_shift($args);
    if(!is_array($arr)){
        throw new Exception("第一个参数不为数组");
    }
    foreach($args as $key => $field){
        if(is_string($field)){
            $temp = array();
            foreach($arr as $index=> $val){
                $temp[$index] = $val[$field];
            }
            $args[$key] = $temp;
        }
    }
    $args[] = &$arr;//引用值
    call_user_func_array('array_multisort',$args);
    return array_pop($args);
}


