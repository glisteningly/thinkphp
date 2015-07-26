<?php
/**
 * Created by IntelliJ IDEA.
 * User: efana
 * Date: 2015/7/26
 * Time: 19:09
 */

namespace Home\Controller;

use Think\Controller;

class FormController extends Controller
{
    public function index()
    {
        $Form = M('Form');
        $list = $Form->order('create_time asc')->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function insert()
    {
        $Form = D('Form');
        if ($Form->create()) {
            $result = $Form->add();
            if ($result) {
                $this->success('数据添加成功！', U('Home/Form/index'));
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
                $this->success('操作成功！', U('Home/Form/index'));
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
            $this->success('操作成功！', U('Home/Form/read/id/' . $id));
        } else {
            $this->error('写入错误！');
        }
    }

    public function delete($id = 0)
    {
        $Form = M("Form");
        $result = $Form->delete($id);
        if ($result) {
            $this->success('操作成功！', U('Home/Form/index'));
        } else {
            $this->error('写入错误！');
        }
    }
}