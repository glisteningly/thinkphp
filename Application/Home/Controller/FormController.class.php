<?php
/**
 * Created by IntelliJ IDEA.
 * User: efana
 * Date: 2015/7/26
 * Time: 19:09
 */

namespace Home\Controller;

use Think\Controller;
use Think\Model;

class FormController extends Controller
{
    public function index()
    {
        $Form = M('Form');
        $formCount = $Form->count();
        $this->assign('count', $formCount);
//        各种查询条件
        $map['id'] = array('egt', 0);
//        $map['id'] = array('between',array('1','8'));
//        $map['title'] = array('like','thinkphp%');
//        $map['id'] = array(array('neq', 9), array('gt', 3), 'and');
        $list = $Form->where($map)->order('create_time asc')->Page('1,10')->select();

//        直接SQL查询
//        $Model = new Model(); // 实例化一个model对象 没有对应任何数据表
//        $list = $Model->query("SELECT * FROM think_form ORDER BY create_time asc");

//        只生成SQL语句，不查询
//        $subQuery = $Form->where($map)->order('create_time asc')->buildSql();
//        echo($subQuery);

        $this->assign('list', $list);
        $this->display('index2');
//        $this->ajaxReturn($list,"json");
    }

    public function getuser($page = 1, $row = 10)
    {
        $Form = M('Form');
        $result["total"] = $Form->count();
        $list = $Form->Page($page, $row)->select();
//        $list = $Form->field("from_unixtime(time,'%Y-%m') as time")->select();
//        $list = $Form->field("title,content,from_unixtime(create_time,'%Y-%m-%d &nbsp&nbsp %H:%i:%s') as create_time")->order('create_time asc')->select();

        $result["rows"] = $list;
//        $this->assign('result', $result);
        $this->ajaxReturn($result);
    }

    public function adduser()
    {
        $Form = D('Form');
        if ($Form->create()) {
            $result = $Form->add(); // 写入数据到数据库
            if ($result) {
                // 如果主键是自动增长型 成功后返回值就是最新插入的值
                $insertId = $result;
                $this->ajaxReturn(array('success' => true));
            } else {
                $this->ajaxReturn(array('msg' => 'Some errors occured.'));
            }
        }
    }

    public function updateuser()
    {
        $Form = D('Form');
        $map['id'] = I('get.id');
        if ($Form->create()) {
            $result = $Form->where($map)->save(); // 写入数据到数据库
            if ($result) {
                // 如果主键是自动增长型 成功后返回值就是最新插入的值
                $insertId = $result;
                $this->ajaxReturn(array('success' => true));
            } else {
                $this->ajaxReturn(array('msg' => 'Some errors occured.'));
            }
        }
    }

    public function deleteuser()
    {
        $Form = M("Form");
        $result = $Form->delete(I('id'));
        if ($result) {
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $insertId = $result;
            $this->ajaxReturn(array('success' => true));
        } else {
            $this->ajaxReturn(array('msg' => 'Some errors occured.'));
        }
    }

    public function insert()
    {
        $Form = D('Form');
        if ($Form->create()) {
            $result = $Form->add();
            if ($result) {
                $this->success('数据添加成功！', U('Form/index'));
            } else {
                $this->error('数据添加错误！');
            }
        } else {
            $this->error($Form->getError());
        }
    }

    public function read($id = 0)
    {
        $Form = M('Form');
        // 读取数据
        $data = $Form->find($id);
        if ($data) {
            $this->assign('data', $data);// 模板变量赋值
        } else {
            $this->error('数据错误');
        }
        $this->display();
    }

    public function edit($id = 0)
    {
        $Form = M('Form');
        $this->assign('vo', $Form->find($id));
        $this->display();
    }

    public function update()
    {
        $Form = D('Form');
        if ($Form->create()) {
            $result = $Form->save();
            if ($result) {
                $this->success('操作成功！', U('Form/index'));
            } else {
                $this->error('写入错误！');
            }
        } else {
            $this->error($Form->getError());
        }
    }

    public function updatex($id = 0)
    {
        $Form = M("Form");
        // 要修改的数据对象属性赋值
        $Form->title = 'ThinkPHP';
        $Form->content = 'ThinkPHP3.2.3版本发布';
        $result = $Form->where('id=' . $id)->save(); // 根据条件保存修改的数据
        if ($result) {
            $this->success('操作成功！', U('Form/read/id/' . $id));
        } else {
            $this->error('写入错误！');
        }
    }

    public function delete($id = 0)
    {
        $Form = M("Form");
        $result = $Form->delete($id);
        if ($result) {
            $this->success('操作成功！', U('Form/index'));
        } else {
            $this->error('写入错误！');
        }
    }
}