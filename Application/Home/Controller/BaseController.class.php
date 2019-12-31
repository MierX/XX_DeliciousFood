<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;

class BaseController extends Controller
{
    public function index()
    {

    }

    public function out()
    {
        session('user',null);
        echo true;
    }

    public function noLogin()
    {
        if(!$_SESSION['user']['isLogin'])
        {
            $this->redirect('Index/login',[],0);
            exit;
        }
    }

    public function edit()
    {
        $this->noLogin();

        if($_POST)
        {
            if($_POST['table'] == 'Menu')
            {
                if($_POST['title'] && $_POST['img'] && $_POST['content'])
                {
                    if($_POST['id'])
                    {
                        $result = D('Menu')->where(['id' => $_POST['id']])->save(['title' => $_POST['title'], 'img' => $_POST['img'], 'content' => $_POST['content']]);
                    }
                    else
                    {
                        $addData['uid'] = $_SESSION['user']['id'];
                        $addData['title'] = $_POST['title'];
                        $addData['phone'] = $_SESSION['user']['username'];
                        $addData['author'] = $_SESSION['user']['nickname'];
                        $addData['img'] = $_POST['img'];
                        $addData['content'] = $_POST['content'];
                        $addData['addtime'] = time();
                        $result = D('Menu')->add($addData);
                    }
                    if($result)
                    {
                        $mid = $_POST['id'] ? $_POST['id'] : $result;
                        if(count($_POST['foods']) > 0 && count($_POST['dose']) > 0 && count($_POST['foods']) == count($_POST['dose']))
                        {
                            D('MenuFoods')->where(['mid' => $mid])->delete();
                            $addMFData['mid'] = $mid;
                            foreach ($_POST['foods'] as $key => $value)
                            {
                                $addMFData['fid'] = $value;
                                $addMFData['dose'] = $_POST['foods'][$key];
                                D('MenuFoods')->add($addMFData);
                            }
                        }
                    }
                }
            }
            exit;
        }

        $data = D($_GET['table'])->field('*')->where($_GET['where'])->find();

        $this->assign('title', $_GET['title']);
        $this->assign('data', $data);
    }

    public function collection()
    {
        $result = D('Collection')->field('*')->where(['uid' => $_POST['uid'], 'mid' => $_POST['mid']])->find();
        $_POST['addtime'] = time();
        $result = $result['id'] ? D('Collection')->where(['uid' => $_POST['uid'], 'mid' => $_POST['mid']])->delete() : D('Collection')->add($_POST);
        echo $result;
    }

    public function comment()
    {
        $_POST['addtime'] = time();
        $_POST['author'] = $_SESSION['user']['nickname'];
        $result = D('Comment')->add($_POST);
        echo $result;
    }

    public function list()
    {
        if($_GET['my'] == 2)
        {
            $midList = implode(',', array_column(D('Collection')->field('mid')->where(['uid' => $_SESSION['user']['id']])->select(),'mid'));
            $_GET['where'] = $midList ? "id in (".$midList.") AND status = 1" : "id = 0 AND status = 1";
        }
        elseif($_GET['my'] == 3)
        {
            $midList = implode(',',array_unique(array_column(D('Comment')->field('mid')->where(['uid' => $_SESSION['user']['id']])->select(),'mid')));
            $_GET['where'] = $midList ? "id in (".$midList.") AND status = 1" : "id = 0 AND status = 1";
        }

        $page = $_GET['page'] > 0 ? $_GET['page'] : 1;
        $psize = ($page-1)*20;
        $data = D()->query("select * from ".$_GET['table']." where ".$_GET['where']." ORDER BY ".$_GET['order']." limit ".$psize.",20");
        $lastPage = D()->query("select count(*) as count from ".$_GET['table']." where ".$_GET['where']." ORDER BY ".$_GET['order']." limit 1");
        $lastPage = ceil($lastPage[0]['count'] / 20);

        $this->assign('title',$_GET['title']);
        $this->assign('where',$_GET['where']);
        $this->assign('my',$_GET['my']);
        $this->assign('pageId',$_GET['id']);
        $this->assign('data',$data);
        $this->assign('page',$page);
        $this->assign('lastPage',$lastPage);
    }

    public function content()
    {
        if($_GET['my'] == 1 && $_SESSION['user']['id'] == $_GET['author'])
        {
            $menu = new MenuController();
            $menu->edit();
            exit;
        }

        D($_GET['table'])->where($_GET['where'])->setInc('hot');
        $data = D($_GET['table'])->field('*')->where($_GET['where'])->find();
        $isCollection = D('collection')->field('id')->where(['uid' => $_SESSION['user']['id'], 'mid' => $_GET['where']['id']])->find() ? 1 : 0;
        $comment = D('Comment')->field('*')->where(['mid' => $_GET['where']['id']])->order('addtime desc')->select();
        foreach ($comment as $key => &$value)
        {
            if($value['status'] != 1) $value['content'] = "<span style='color: red'>该评论已被管理员删除！！</span>";
        }

        $this->assign('title',$data['title']);
        $this->assign('isCollection',$isCollection);
        $this->assign('comment',$comment);
        $this->assign('data',$data);
    }

    public function special()
    {
        $special = D('Special')->field('*')->where(['status' => 1])->order('toptime desc,addtime asc')->select();
        foreach ($special as $key => &$value)
        {
            $value['menu'] = D('Menu')->field('*')->where(['status' => 1, 'sid' => $value['id']])->order('addtime desc')->select();
            $value['menu'] = $this->checkStatus($value['menu']);
            if(count($value['menu']) < 8)
            {
                unset($special[$key]);
            }
            else
            {
                $value['menu'] = array_slice($value['menu'],0,8);
            }
        }
        $this->assign('special',$special);
    }

    public function check()
    {
        $result = false;

        $table =  $_POST['table'];
        $field =  $_POST['field'];
        $condition =  $_POST['condition'];
        $value =  $_POST['value'];
        $where = $field." ".$condition." '".$value."'";
        $sql = "select id from ".$table." where binary ".$where." limit 1";

        if ($table && $field && $where && $value) $result = D()->execute($sql) ? true : false;
        echo $result;
    }

    public function upload()
    {

        if ($_FILES)
        {
            $config = C('UPLOAD_IMG');
            $path_name = I('path_name', '');
            if($path_name) $config['savePath'] = str_replace('images', $path_name, $config['savePath']);
            $save_path = $config['rootPath'] . $config['savePath'];
            if (!is_dir($save_path))
            {
                if (IS_WIN)
                {
                    mkdir($save_path, '0777', true);
                }
                else
                {
                    xmkdir($save_path);
                }
            }

            $upload = new Upload($config);
            $info = $upload->upload();
            if (!$info)
            {
                echo false;
                exit;
            }
            $file_arr = array();
            foreach ($info as $value)
            {
                $url = $value['savepath'] . $value['savename'];
                $url = str_replace('\\', '/', $url);
                $file_arr[] = $url;
            }
            $response['data'] = $file_arr;
            echo json_encode($response);
            exit;
        }
        echo false;
        exit;
    }

    public function change()
    {
        $result = false;
        if($_GET) $result = D($_GET['table'])->where($_GET['where'])->save($_GET['save']);
        if($result)
        {
            $this->checkUserChange();
            $result = true;
        }
        echo $result;
    }

    public function status()
    {
        $result = true;
        if($_SESSION['user'])
        {
            $status = D('User')->field('status')->where(['id' => $_SESSION['user']['id']])->find();
            if($status['status'] != 1)
            {
                session('user',null);
                $result = false;
            }
        }
        echo $result;
    }

    public function checkStatus($data)
    {
        foreach ($data as $k => $v)
        {
            $status = D('User')->field('status')->where(['id' => $v['uid']])->find();
            if($status['status'] != 1) unset($data[$k]);
        }
        return $data;
    }

    public function checkUserChange()
    {
        $userList = D('User')->field('*')->select();
        foreach ($userList as $key => $value) {
            D('Menu')->where(['uid' => $value['id']])->save(['author' => $value['nickname']]);
            D('Comment')->where(['uid' => $value['id']])->save(['author' => $value['nickname']]);
        }
    }
}