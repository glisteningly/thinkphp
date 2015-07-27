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
        $list = $Form->where($map)->order('create_time asc')->select();

//        直接SQL查询
//        $Model = new Model(); // 实例化一个model对象 没有对应任何数据表
//        $list = $Model->query("SELECT * FROM think_form ORDER BY create_time asc");

//        只生成SQL语句，不查询
//        $subQuery = $Form->where($map)->order('create_time asc')->buildSql();
//        echo($subQuery);

        $this->assign('list', $list);
        $this->display();
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