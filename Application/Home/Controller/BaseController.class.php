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
        unset($_SESSION);
        $this->index();
        exit;
    }

    public function check()
    {

    }
}