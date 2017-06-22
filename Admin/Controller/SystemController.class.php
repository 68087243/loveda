<?php

namespace Admin\Controller;

use Admin\Model\BannerModel;
use Common\Model\CodeModel;
use Think\Db;

class SystemController extends BaseController {

	/**
	 * 供应商管理
	 */
	public function supply() {
		$list = M ( "supply" )->order ( 'sortpath asc' )->select ();
		$this->assign ( "list", $list );
		$this->display ();
	}
	
	// 添加供应商
	public function addSupply($pid = 0) {
		if (IS_POST) {
			$db = D ( "supply" );
			$data = empty ( $data ) ? $_POST : $data;
			$data = $db->create ( $data );
			// depth,sortpath
			$info = M ( 'supply' )->getById ( $pid );
			$data ['depth'] = $info ['depth'] + 1;
			$sortpath = $info ['sortpath'];
			if ($data) {
				if ($db->add ( $data )) {
					// 更新sortpath
					$last_id = $db->getLastInsID ();
					if (empty ( $sortpath )) {
						$sortpath = '0,';
					}
					$db = M ( 'supply' )->where ( 'id=' . $last_id );
					$db->save ( array (
							'sortpath' => $sortpath . $last_id . ','
					) );
					$this->success ( "添加供应商成功！" );
				} else {
					$this->error ( '添加供应商失败！' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
			$sort = M ( "supply" )->max ( "id" );
			$this->assign ( "sort", $sort + 1 );
			$this->assign ( "pid", $pid );
				
			// 输出当前Supply列表
			$list = M ( "supply" )->order ( 'sortpath asc' )->select ();
			$this->assign ( "list", $list );
				
			// 取父级绑定的模型
			$model_id = M ( 'supply' )->getFieldById ( $pid, 'model_id' );
			$this->display ('addSupply');
		}
	}
	
	// 编辑供应商
	public function editSupply($id = 0) {
		if (IS_POST) {
			$db = D ( "supply" );
			$data = empty ( $data ) ? $_POST : $data;
			$data = $db->create ( $data );
				
			// 上级供应商不能是自己
			if ($data ['pid'] == $id) {
				$this->error ( '上级不能是自己！' );
			}
				
			// depth,sortpath
			$info = M ( 'supply' )->getById ( $data ['pid'] );
			// 有下级供应商不能改变自己的上级
			if ($data ['pid'] !== $info ['pid']) {
				if ($data ['pid'] != '0') {
					$find = $db->where ( 'pid=' . $id )->count ();
					if ($find > 0) {
						$this->error ( '有下级供应商时不能是改变自己的上级！' );
					}
				}
			}
			$data ['depth'] = $info ['depth'] + 1;
			$sortpath = $info ['sortpath'];
			if ($data) {
				if ($db->save ( $data ) !== false) {
					// 更新sortpath
					$last_id = $db->getLastInsID ();
					if (empty ( $sortpath )) {
						$sortpath = '0,';
					}
					$db = M ( 'supply' )->where ( 'id=' . $last_id );
					$db->save ( array (
							'sortpath' => $sortpath . $last_id . ','
					) );
					$this->success ( "编辑供应商成功！" );
				} else {
					$this->error ( '编辑供应商失败' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
				
			$db = M ( "supply" )->find ( $id );
			$this->assign ( "db", $db );
				
			// 输出当前Supply列表
			$list = M ( "supply" )->order ( 'sortpath asc' )->select ();
			$this->assign ( "list", $list );
				
			$this->display ('editSupply');
		}
	}
	
	// 删除供应商
	public function deleteSupply($id) {
		$db = M ( "supply" )->delete ( $id );
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}
	
	// 修改登录密码
	public function pwd() {
		if (IS_POST) { 
			$data = empty ( $data ) ? $_POST : $data;
			if(isN($data['userpwd1'])||isN($data['userpwd2'])){ 
				$this->error ('对不起，新密码不能为空！' );
			}
			if(!($data['userpwd1']==$data['userpwd2'])){ 
				$this->error ('对不起，两次新密码输入不一致！' );
			}
			
			$where=array();
			$where['id']=session('adminid');
			$where['userpwd']=md5($data['userpwd']);
			$db=M('user')->where($where)->find(); 
			if ($db) {
				$db=M('user')->where($where)->setField('userpwd',md5($data['userpwd1']));
				if ($db !== false) {
					$this->success ( "修改密码成功！" );
				} else {
					$this->error ( '修改密码失败' );
				}
			} else {
				$this->error ('对不起，原密码不正确！' );
			}
		} else { 
			$this->display ();
		}
	}
	
	/**
	 * 数据库备份与还原
	 */
	public function database($type = 'export', $action = '') {
		$tables = I ( 'post.tables' );
		$time = I ( 'get.time' );
		switch ($action) {
			case '' :
				// 备份还原
				switch ($type) {
					/* 数据还原 */
					case 'import' :
						// 列出备份文件列表
						$f = create_file (C ( 'config.DATA_BACKUP_PATH' ). '/index.html' );
						$path = realpath ( C ( 'config.DATA_BACKUP_PATH' ) );
						$flag = \FilesystemIterator::KEY_AS_FILENAME;
						$glob = new \FilesystemIterator ( $path, $flag );
						
						$list = array ();
						foreach ( $glob as $name => $file ) {
							if (preg_match ( '/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name )) {
								$name = sscanf ( $name, '%4s%2s%2s-%2s%2s%2s-%d' );
								
								$date = "{$name[0]}-{$name[1]}-{$name[2]}";
								$time = "{$name[3]}:{$name[4]}:{$name[5]}";
								$part = $name [6];
								
								if (isset ( $list ["{$date} {$time}"] )) {
									$info = $list ["{$date} {$time}"];
									$info ['part'] = max ( $info ['part'], $part );
									$info ['size'] = $info ['size'] + $file->getSize ();
								} else {
									$info ['part'] = $part;
									$info ['size'] = $file->getSize ();
								}
								
								$extension = strtoupper ( $file->getExtension () );
								$info ['compress'] = ($extension === 'SQL') ? '-' : $extension;
								$info ['time'] = strtotime ( "{$date} {$time}" );
								
								$list ["{$date} {$time}"] = $info;
							}
						}
						$title = '数据还原';
						break;
					
					/* 数据备份 */
					case 'export' :
						$Db = Db::getInstance ();
						$list = $Db->query ( 'SHOW TABLE STATUS' );
						$list = array_map ( 'array_change_key_case', $list );
						$title = '数据备份';
						break;
					
					default :
						$this->error ( '参数错误！' );
				}
				
				// 渲染模板
				$this->assign ( 'meta_title', $title );
				$this->assign ( 'list', $list );
				$this->display ( $type );
				
				break;
			case 'repair' :
				$this->repair ( $tables );
				break;
			case 'optimize' :
				$this->optimize ( $tables );
				break;
			case 'import' :
				$part = I ( 'part' );
				$start = I ( 'start' );
				$this->import ( $time, $part, $start );
				break;
			case 'export' :
				$id = I ( 'id' );
				$start = I ( 'start' );
				$this->export ( $tables, $id, $start );
				break;
			case 'del' :
				$this->del ( $time );
				break;
		}
	}
	
	/**
	 * 优化表
	 * 
	 * @param String $tables
	 *        	表名
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function optimize($tables = null) {
		if ($tables) {
			$Db = Db::getInstance ();
			if (is_array ( $tables )) {
				$tables = implode ( '`,`', $tables );
				$list = $Db->query ( "OPTIMIZE TABLE `{$tables}`" );
				
				if ($list) {
					$this->success ( "数据表优化完成！" );
				} else {
					$this->error ( "数据表优化出错请重试！" );
				}
			} else {
				$list = $Db->query ( "OPTIMIZE TABLE `{$tables}`" );
				if ($list) {
					$this->success ( "数据表'{$tables}'优化完成！" );
				} else {
					$this->error ( "数据表'{$tables}'优化出错请重试！" );
				}
			}
		} else {
			$this->error ( "请指定要优化的表！" );
		}
	}
	
	/**
	 * 修复表
	 * 
	 * @param String $tables
	 *        	表名
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function repair($tables = null) {
		if ($tables) {
			$Db = Db::getInstance ();
			if (is_array ( $tables )) {
				$tables = implode ( '`,`', $tables );
				$list = $Db->query ( "REPAIR TABLE `{$tables}`" );
				
				if ($list) {
					$this->success ( "数据表修复完成！" );
				} else {
					$this->error ( "数据表修复出错请重试！" );
				}
			} else {
				$list = $Db->query ( "REPAIR TABLE `{$tables}`" );
				if ($list) {
					$this->success ( "数据表'{$tables}'修复完成！" );
				} else {
					$this->error ( "数据表'{$tables}'修复出错请重试！" );
				}
			}
		} else {
			$this->error ( "请指定要修复的表！" );
		}
	}
	
	/**
	 * 删除备份文件
	 * 
	 * @param Integer $time
	 *        	备份时间
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function del($time = 0) {
		if ($time) {
			$name = date ( 'Ymd-His', $time ) . '-*.sql*';
			$path = realpath ( C ( 'config.DATA_BACKUP_PATH' ) ) . DIRECTORY_SEPARATOR . $name;
			array_map ( "unlink", glob ( $path ) );
			if (count ( glob ( $path ) )) {
				$this->success ( '备份文件删除成功！' );
				// $this->success('备份文件删除失败，请检查权限！');
			} else {
				$this->success ( '备份文件删除成功！' );
			}
		} else {
			$this->error ( '参数错误！' );
		}
	}
	
	/**
	 * 备份数据库
	 * 
	 * @param String $tables
	 *        	表名
	 * @param Integer $id
	 *        	表ID
	 * @param Integer $start
	 *        	起始行数
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function export($tables = null, $id = null, $start = null) {
		if (IS_POST && ! empty ( $tables ) && is_array ( $tables )) { // 初始化
		                                                     // 读取备份配置
			$config = array (
					'path' => realpath ( C ( 'config.DATA_BACKUP_PATH' ) ) . DIRECTORY_SEPARATOR,
					'part' => C ( 'config.DATA_BACKUP_PART_SIZE' ),
					'compress' => C ( 'config.DATA_BACKUP_COMPRESS' ),
					'level' => C ( 'config.DATA_BACKUP_COMPRESS_LEVEL' ) 
			);
			
			// 检查是否有正在执行的任务
			$lock = "{$config['path']}backup.lock";
			if (is_file ( $lock )) {
				$this->error ( '检测到有一个备份任务正在执行，请稍后再试！' );
			} else {
				// 创建锁文件
				file_put_contents ( $lock, NOW_TIME );
			}
			// 检查备份目录是否可写
			$f = create_file ( C ( 'config.DATA_BACKUP_PATH' ) . '/index.html' );
			if ($f) {
				is_writeable ( $config ['path'] ) || $this->error ( '备份目录不存在或不可写，请检查后重试！' );
			}
			session ( 'backup_config', $config );
			
			// 生成备份文件信息
			$file = array (
					'name' => date ( 'Ymd-His', NOW_TIME ),
					'part' => 1 
			);
			session ( 'backup_file', $file );
			
			// 缓存要备份的表
			session ( 'backup_tables', $tables );
			
			// 创建备份文件
			$Database = new Database ( $file, $config );
			if (false !== $Database->create ()) {
				$tab = array (
						'action' => 'export',
						'id' => 0,
						'start' => 0 
				);
				$this->success ( '初始化成功！', '', array (
						'tables' => $tables,
						'tab' => $tab 
				) );
			} else {
				$this->error ( '初始化失败，备份文件创建失败！' );
			}
		} elseif (IS_GET && is_numeric ( $id ) && is_numeric ( $start )) { // 备份数据
			$tables = session ( 'backup_tables' );
			// 备份指定表
			$Database = new Database ( session ( 'backup_file' ), session ( 'backup_config' ) );
			$start = $Database->backup ( $tables [$id], $start );
			if (false === $start) { // 出错
				$this->error ( '备份出错！' );
			} elseif (0 === $start) { // 下一表
				if (isset ( $tables [++ $id] )) {
					$tab = array (
							'action' => 'export',
							'id' => $id,
							'start' => 0 
					);
					$this->success ( '备份完成！', '', array (
							'tab' => $tab 
					) );
				} else { // 备份完成，清空缓存
					unlink ( session ( 'backup_config.path' ) . 'backup.lock' );
					session ( 'backup_tables', null );
					session ( 'backup_file', null );
					session ( 'backup_config', null );
					$this->success ( '备份完成！' );
				}
			} else {
				$tab = array (
						'action' => 'export',
						'id' => $id,
						'start' => $start [0] 
				);
				$rate = floor ( 100 * ($start [0] / $start [1]) );
				$this->success ( "正在备份...({$rate}%)", '', array (
						'tab' => $tab 
				) );
			}
		} else { // 出错
			$this->error ( '参数错误！' );
		}
	}
	
	/**
	 * 还原数据库
	 * 
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function import($time = 0, $part = '', $start = '') {
		if (is_numeric ( $time ) && empty ( $part ) && empty ( $start )) { // 初始化
		                                                        // 获取备份文件信息
			$name = date ( 'Ymd-His', $time ) . '-*.sql*';
			$path = realpath ( C ( 'config.DATA_BACKUP_PATH' ) ) . DIRECTORY_SEPARATOR . $name;
			$files = glob ( $path );
			$list = array ();
			foreach ( $files as $name ) {
				$basename = basename ( $name );
				$match = sscanf ( $basename, '%4s%2s%2s-%2s%2s%2s-%d' );
				$gz = preg_match ( '/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename );
				$list [$match [6]] = array (
						$match [6],
						$name,
						$gz 
				);
			}
			ksort ( $list );
			
			// 检测文件正确性
			$last = end ( $list );
			if (count ( $list ) === $last [0]) {
				session ( 'backup_list', $list ); // 缓存备份列表
				
				$this->success ( '初始化完成！', '', array (
						'action' => 'import',
						'part' => 1,
						'start' => 0 
				) );
			} else {
				$this->error ( '备份文件可能已经损坏，请检查！' );
			}
		} elseif (is_numeric ( $part ) && is_numeric ( $start )) {
			
			$list = session ( 'backup_list' );
			$db = new Database ( $list [$part], array (
					'path' => realpath ( C ( 'config.DATA_BACKUP_PATH' ) ) . DIRECTORY_SEPARATOR,
					'compress' => $list [$part] [2] 
			) );
			
			$start = $db->import ( $start );
			if (false === $start) {
				$this->error ( '还原数据出错！' );
			} elseif (0 === $start) { // 下一卷
				if (isset ( $list [++ $part] )) {
					$data = array (
							'action' => 'import',
							'part' => $part,
							'start' => 0 
					);
					$this->success ( "正在还原...#{$part}", '', $data );
				} else {
					session ( 'backup_list', null );
					$this->success ( '还原完成！' );
				}
			} else {
				$data = array (
						'action' => 'import',
						'part' => $part,
						'start' => $start [0] 
				);
				if ($start [1]) {
					$rate = floor ( 100 * ($start [0] / $start [1]) );
					$this->success ( "正在还原...#{$part} ({$rate}%)", '', $data );
				} else {
					$data ['gz'] = 1;
					$this->success ( "正在还原...#{$part}", '', $data );
				}
			}
		} else {
			$this->error ( '参数错误！' );
		}
	}
	
	/**
	 * 系统设置
	 */
	public function setting() {
		if (IS_POST) {
			$data = empty ( $data ) ? $_POST : $data;
			$config = $data ['config'];
			if ($config && is_array ( $config )) {
				$db = M ( 'Config' );
				foreach ( $config as $name => $value ) {
					$map = array (
							'name' => $name 
					);
					$db->where ( $map )->setField ( 'value', $value );
				}
			}
			
			$db = $this->_updateconfig ( $data );
			if ($db !== false) {
				$this->success ( '参数设置成功！' );
			} else {
				$this->error ( '操作失败！' );
			}
		} else {
			$list = M ( 'config' )->where ( array (
					'status' => 1 
			) )->field ( 'id,name,title,extra,value,remark,type,group' )->order ( 'sort asc' )->select ();
			$this->assign ( 'list', $list );
			$this->assign ( 'group', parse_field_attr ( C ( 'config.CONFIG_GROUP_LIST' ) ) );
			$this->display ();
		}
	}
	
	// 配置信息保存
	private function _updateconfig($config) {
		$config_file = GLOBAL_CONFIG;
		create_file ( GLOBAL_CONFIG );
		$config_old = array ();
		$config_new = array ();
		if (is_array ( $config )) {
			$config_old = require $config_file;
			if (is_array ( $config_old )) {
				$config_new = array_merge ( $config_old, $config );
			} else {
				$config_new = $config;
			}
			arr2file ( $config_file, $config_new );
		}
		if (file_exists ( RUNTIME_PATH . APP_MODE . '~runtime.php' )) {
			@unlink ( RUNTIME_PATH . APP_MODE . '~runtime.php' );
		}
	}
	/**
	 * 配置管理
	 */
	public function config() {
		$list = M ( "config" )->order ( 'id desc' )->select ();
		$this->assign ( "list", $list );
		$this->display ();
	}
	
	// 添加配置
	public function addConfig($pid = 0) {
		if (IS_POST) {
			$db = D ( "config" );
			$data = empty ( $data ) ? $_POST : $data;
			$create = $db->create ( $data );
			if ($create) {
				if ($db->add ( $data )) {
					$this->success ( "添加配置成功！" );
				} else {
					$this->error ( '添加配置失败！' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
			$sort = M ( "config" )->max ( "id" );
			$this->assign ( "sort", $sort + 1 );
			$this->display ('addConfig');
		}
	}
	
	// 编辑配置
	public function editConfig($id = 0) {
		if (IS_POST) {
			$db = D ( "config" );
			$data = empty ( $data ) ? $_POST : $data;
			$create = $db->create ( $data );
			if ($create) {
				if ($db->save ( $data ) !== false) {
					$this->success ( "编辑配置成功！" );
				} else {
					$this->error ( '编辑配置失败' );
				}
			} else {
				$this->error ( $db->getError () );
			}
		} else {
			$db = M ( "config" )->find ( $id );
			$this->assign ( "db", $db );
			$this->display ('editConfig');
		}
	}
	
	// 删除配置
	public function deleteConfig($id) {
		$db = M ( "config" )->delete ( $id );
		if ($db !== false) {
			$this->success ( "删除成功！" );
		} else {
			$this->error ( "删除失败" );
		}
	}

}

// 数据导出模型
class Database {
	/**
	 * 文件指针
	 * 
	 * @var resource
	 */
	private $fp;
	
	/**
	 * 备份文件信息 part - 卷号，name - 文件名
	 * 
	 * @var array
	 */
	private $file;
	
	/**
	 * 当前打开文件大小
	 * 
	 * @var integer
	 */
	private $size = 0;
	
	/**
	 * 备份配置
	 * 
	 * @var integer
	 */
	private $config;
	
	/**
	 * 数据库备份构造方法
	 * 
	 * @param array $file
	 *        	备份或还原的文件信息
	 * @param array $config
	 *        	备份配置信息
	 * @param string $type
	 *        	执行类型，export - 备份数据， import - 还原数据
	 */
	public function __construct($file, $config, $type = 'export') {
		$this->file = $file;
		$this->config = $config;
	}
	
	/**
	 * 打开一个卷，用于写入数据
	 * 
	 * @param integer $size
	 *        	写入数据的大小
	 */
	private function open($size) {
		if ($this->fp) {
			$this->size += $size;
			if ($this->size > $this->config ['part']) {
				$this->config ['compress'] ? @gzclose ( $this->fp ) : @fclose ( $this->fp );
				$this->fp = null;
				$this->file ['part'] ++;
				session ( 'backup_file', $this->file );
				$this->create ();
			}
		} else {
			$backuppath = $this->config ['path'];
			$filename = "{$backuppath}{$this->file['name']}-{$this->file['part']}.sql";
			if ($this->config ['compress']) {
				$filename = "{$filename}.gz";
				$this->fp = @gzopen ( $filename, "a{$this->config['level']}" );
			} else {
				$this->fp = @fopen ( $filename, 'a' );
			}
			$this->size = filesize ( $filename ) + $size;
		}
	}
	
	/**
	 * 写入初始数据
	 * 
	 * @return boolean true - 写入成功，false - 写入失败
	 */
	public function create() {
		$sql = "-- -----------------------------\n";
		$sql .= "-- MySQL Data Transfer \n";
		$sql .= "-- \n";
		$sql .= "-- Host     : " . C ( 'DB_HOST' ) . "\n";
		$sql .= "-- Port     : " . C ( 'DB_PORT' ) . "\n";
		$sql .= "-- Database : " . C ( 'DB_NAME' ) . "\n";
		$sql .= "-- \n";
		$sql .= "-- Part : #{$this->file['part']}\n";
		$sql .= "-- Date : " . date ( "Y-m-d H:i:s" ) . "\n";
		$sql .= "-- -----------------------------\n\n";
		$sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";
		return $this->write ( $sql );
	}
	
	/**
	 * 写入SQL语句
	 * 
	 * @param string $sql
	 *        	要写入的SQL语句
	 * @return boolean true - 写入成功，false - 写入失败！
	 */
	private function write($sql) {
		$size = strlen ( $sql );
		
		// 由于压缩原因，无法计算出压缩后的长度，这里假设压缩率为50%，
		// 一般情况压缩率都会高于50%；
		$size = $this->config ['compress'] ? $size / 2 : $size;
		
		$this->open ( $size );
		return $this->config ['compress'] ? @gzwrite ( $this->fp, $sql ) : @fwrite ( $this->fp, $sql );
	}
	
	/**
	 * 备份表结构
	 * 
	 * @param string $table
	 *        	表名
	 * @param integer $start
	 *        	起始行数
	 * @return boolean false - 备份失败
	 */
	public function backup($table, $start) {
		// 创建DB对象
		$db = Db::getInstance ();
		
		// 备份表结构
		if (0 == $start) {
			$result = $db->query ( "SHOW CREATE TABLE `{$table}`" );
			$sql = "\n";
			$sql .= "-- -----------------------------\n";
			$sql .= "-- Table structure for `{$table}`\n";
			$sql .= "-- -----------------------------\n";
			$sql .= "DROP TABLE IF EXISTS `{$table}`;\n";
			$sql .= trim ( $result [0] ['Create Table'] ) . ";\n\n";
			if (false === $this->write ( $sql )) {
				return false;
			}
		}
		
		// 数据总数
		$result = $db->query ( "SELECT COUNT(*) AS count FROM `{$table}`" );
		$count = $result ['0'] ['count'];
		
		// 备份表数据
		if ($count) {
			// 写入数据注释
			if (0 == $start) {
				$sql = "-- -----------------------------\n";
				$sql .= "-- Records of `{$table}`\n";
				$sql .= "-- -----------------------------\n";
				$this->write ( $sql );
			}
			
			// 备份数据记录
			$result = $db->query ( "SELECT * FROM `{$table}` LIMIT {$start}, 1000" );
			foreach ( $result as $row ) {
				$row = array_map ( 'mysql_real_escape_string', $row );
				$sql = "INSERT INTO `{$table}` VALUES ('" . implode ( "', '", $row ) . "');\n";
				if (false === $this->write ( $sql )) {
					return false;
				}
			}
			
			// 还有更多数据
			if ($count > $start + 1000) {
				return array (
						$start + 1000,
						$count 
				);
			}
		}
		
		// 备份下一表
		return 0;
	}
	public function import($start) {
		// 还原数据
		$db = Db::getInstance ();
		
		if ($this->config ['compress']) {
			$gz = gzopen ( $this->file [1], 'r' );
			$size = 0;
		} else {
			$size = filesize ( $this->file [1] );
			$gz = fopen ( $this->file [1], 'r' );
		}
		
		$sql = '';
		if ($start) {
			$this->config ['compress'] ? gzseek ( $gz, $start ) : fseek ( $gz, $start );
		}
		
		for($i = 0; $i < 1000; $i ++) {
			$sql .= $this->config ['compress'] ? gzgets ( $gz ) : fgets ( $gz );
			if (preg_match ( '/.*;$/', trim ( $sql ) )) {
				if (false !== $db->query ( $sql )) {
					$start += strlen ( $sql );
				} else {
					return false;
				}
				$sql = '';
			} elseif ($this->config ['compress'] ? gzeof ( $gz ) : feof ( $gz )) {
				return 0;
			}
		}
		
		return array (
				$start,
				$size 
		);
	}
	/**
	 * 析构方法，用于关闭文件资源
	 */
	public function __destruct() {
		$this->config ['compress'] ? @gzclose ( $this->fp ) : @fclose ( $this->fp );
	}
}
?>