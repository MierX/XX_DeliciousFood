<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller
{
    public function index()
    {

    }

    public function out()
    {
        session(null);
        echo true;
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
//        if ($table && $field && $where && $value) $result = D()->query($sql) ? true : false;
        echo $result;
    }
}