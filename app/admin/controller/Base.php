<?php

namespace app\admin\controller;


use app\admin\model\AdminAuth;
use app\admin\model\AdminRole;
use think\Controller;

class Base extends Controller{
    /**
     * 管理员资料 name id group
     */
    protected $admin_info;

    /**
     * 权限内容
     */
    protected $permission;

    /**
     * 菜单
     */
    protected $menu;

    /**
     * 常用菜单
     */
    protected $quick_link;

    /**
     * 构造函数
     * Base constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 系统后台登录验证，并判断是否已经登录，
     * 登录后则自动跳转平台后台首页
     * @param
     * @return array 数组类型的返回结果
     */
    protected final function systemLogin() {
        $user = unserialize(session('sys_key'));
        if ((empty($user['admin_name']) || empty($user['admin_id']))){
            if($this->request->controller() != 'Login'){
                $this->redirect('/admin/login');
            }
        }else {
            if($this->request->controller() == 'Login' && $this->request->action() != 'logout'){
                $this->redirect('/admin/index');
            }
        }
        return $user;
    }

    /**
     * 重写fetch 方便管理视图 主题风格
     * @author Johhny <chenjf@idowe.com>
     * @param string $template
     * @param array $vars
     * @param array $cache
     * @param bool $renderContent
     * @return string
     * @throws \think\Exception
     */
    public function display($template = '', $vars = [], $replace = [], $config = []){
        //  domall/admin/view/index_index.html
        $this->view->engine([
            'view_path'     => APP_PATH.''.config('admin_theme').'/view/',
            'view_suffix'   => config('admin_view_suffix'),
            'view_depr'     => config('admin_view_depr'),
        ]);
        return parent::fetch($template,$vars,$replace,$config);
    }

    /**
     * 重写fetch 方便管理视图 主题风格
     * @author Johhny <chenjf@idowe.com>
     * @param string $template
     * @param array $vars
     * @param array $cache
     * @param bool $renderContent
     * @return string
     * @throws \think\Exception
     */
    public function fetch($template = '', $vars = [], $cache = [], $renderContent = false){
        return $this->display($template,$vars,$cache,$renderContent);
    }

    /**
     * 系统后台 会员登录后 将会员验证内容写入对应cookie中
     *
     * @param string $name 用户名
     * @param int $id 用户ID
     * @return bool 布尔类型的返回结果
     */
    protected final function systemSetKey($user, $avatar = '', $avatar_compel = false) {
        session('sys_key',serialize($user));

        if ($avatar_compel || $avatar != '') {
            session('admin_avatar',$avatar);
        }
    }

    /**
     * 取得IP
     *
     *
     * @return string 字符串类型的返回结果
     */
    function getIp(){
        $ip = $_SERVER['REMOTE_ADDR'];
        return preg_match('/^\d[\d.]+\d$/', $ip) ? $ip : '';
    }

    /**
     * 设置一条或者多条数据的状态
     * @param mixed|string $model
     * @return mixed
     */
    public function setStatus($model = CONTROLLER_NAME) {
        $ids    = $_GET['ids'];
        $status = $_GET['status'];

        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }
        $model_primary_key = D($model)->getPk();
        $map[$model_primary_key] = array('in',$ids);

        switch ($status) {
            case 'forbid' :  // 禁用条目
                $data = array('status' => 0);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'禁用成功','error'=>'禁用失败')
                );
                break;
            case 'resume' :  // 启用条目
                $data = array('status' => 1);
                $map  = array_merge(array('status' => 0), $map);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'启用成功','error'=>'启用失败')
                );
                break;
            case 'hide' :  // 隐藏条目
                $data = array('status' => 2);
                $map  = array_merge(array('status' => 1), $map);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'隐藏成功','error'=>'隐藏失败')
                );
                break;
            case 'show' :  // 显示条目
                $data = array('status' => 1);
                $map  = array_merge(array('status' => 2), $map);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'显示成功','error'=>'显示失败')
                );
                break;
            case 'recycle' :  // 移动至回收站
                $data['status'] = -1;
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'成功移至回收站','error'=>'删除失败')
                );
                break;
            case 'restore' :  // 从回收站还原
                $data = array('status' => 1);
                $map  = array_merge(array('status' => -1), $map);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'恢复成功','error'=>'恢复失败')
                );
                break;
            case 'delete'  :  // 删除条目
                $result = D($model)->where($map)->delete();
                if ($result) {
                    echo(json_encode(['code' => 1, 'msg' => '删除成功，不可恢复！']));exit;
                    //return $this->success('删除成功，不可恢复！');
                } else {
                    echo(json_encode(['code' => 0, 'msg' => '删除失败']));exit;
                    //return $this->error('删除失败');
                }
                break;
            default :
                return $this->error('参数错误');
                break;
        }
    }

    /**
     * 对数据表中的单行或多行记录执行修改 GET参数id为数字或逗号分隔的数字
     * @param string $model 模型名称,供M函数使用的参数
     * @param array  $data  修改的数据
     * @param array  $map   查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息
     *                       array(
     *                           'success' => '',
     *                           'error'   => '',
     *                           'url'     => '',   // url为跳转页面
     *                       )
     * @return mixed
     */
    final protected function editRow($model, $data, $map, $msg) {
        $id = array_unique((array)I('id',0));
        $id = is_array($id) ? implode(',',$id) : $id;
        //如存在id字段，则加入该条件
        $fields = D($model)->getFields();
        if (in_array('id', $fields) && !empty($id)) {
            $map = array_merge(
                array('id' => array('in', $id )),
                (array)$map
            );
        }
        $msg = array_merge(
            array(
                'success' => '操作成功！',
                'error'   => '操作失败！',
                'url'     => ' ',
            ),
            (array)$msg
        );
        $result = D($model)->where($map)->save($data);
        if ($result != false) {
            echo(json_encode(['code' => 1, 'msg' => $msg['success']]));exit;
            //return $this->success($msg['success'], $msg['url']);
        } else {
            echo(json_encode(['code' => 0, 'msg' => $msg['error']]));exit;
            //return $this->error($msg['error'], $msg['url']);
        }
    }
}