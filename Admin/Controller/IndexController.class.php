<?php
namespace Admin\Controller; 


class IndexController extends BaseController {

    public function index($sys=null){
    	if($sys==null){
		$this->assign ( "title", C ( 'config.WEB_SITE_TITLE' ).' - 后台管理系统' );
    	
    	// 输出当前Node列表
    	$where=array();
    	$where['status']=1;
    	if(empty($_SESSION[C('ADMIN_AUTH_KEY')])) {
    	$where['super']=0;
    	}
    	$list = M ( "node" )->where($where)->order('sort asc')->select (); 
      	$access=M("access")->where(array('role_id'=>session('roleid')))->getField("node_id",true);  
    	$list = node_merge ( $list,$access,2);
    	$this->assign ( "list", $list ); 
    	$this->assign('supper',session ( C ( 'ADMIN_AUTH_KEY' )));
    	$this->display();
    	}else{
    		$this->sysinfo();
    	}
    } 
    
    public function sysinfo(){
    	$where['id']=(session('adminid'));
    	$where['status']=1;
    	$db=M('user')->where($where)->find(); 
    	$this->assign ( "db", $db ); 
    	$this->display('Index/sysinfo');
    }


}
?>