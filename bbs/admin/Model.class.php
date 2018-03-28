<?php
	//数据库操作类
	class Model
	{
		//成员属性
		public $tableName;		//表名
		private $link;			//连接成功的数据库对象资源
		private $pk;			//存储表中的主键
		private $fields;		//存储表中的其他字段
		private $field;			//存储查询时的字段信息（注意：若为空则代表 *）
		private $where;			//存储查询时的条件信息
		private $order;			//存储查询时的排序信息
		private $limit;			//存储查询时的分页信息

		//构造方法
		public function __construct($tableName)
		{
			//赋初值
			$this->tableName = $tableName;

			//1. 连接数据库服务器，并判断是否成功
			$this->link = mysqli_connect(HOST,USER,PASS)or die('数据库连接失败！');

			//2. 设置字符集
			mysqli_set_charset($this->link,CHARSET);

			//3. 选择数据库
			mysqli_select_db($this->link,DBNAME);

			//4. 构造方法执行时，自动获取表中所有字段信息
			$this->getAllFields();
		}

		//获取表中所有字段的方法
		public function getAllFields()
		{
			//获取表中所有的字段信息
			$sql = "desc ".$this->tableName;
			$result = mysqli_query($this->link,$sql);

			//判断是否执行成功
			if($result!=false && mysqli_num_rows($result)>0){

				//存储主键信息的变量，存储其他字段的变量
				$pk = '';
				$fields = array();

				//遍历解析信息
				while($rows = mysqli_fetch_assoc($result)){

					//判断是不是主键
					if($rows['Key']=='PRI'){
						$pk = $rows['Field'];
					}else{
						$fields[] = $rows['Field'];
					}
				}
			}

			//将此方法获取到的主键以及其他字段信息放入成员属性
			$this->pk = $pk;
			$this->fields = $fields;
		}

		//过滤字段信息的方法
		public function filterData($data)
		{
			//过滤字段信息方法
			foreach($data as $k=>$v){

				//判断下标是否存在于表字段中
				if(!in_array($k,$this->fields) && $this->pk!=$k){
					
					//判断权限
					if(AUTH==1){
						unset($data[$k]);
					}
					if(AUTH==2){
						die('抱歉，您所传递的信息当中含有非法字段！字段为：'.$k);
					}
				}
			}
			//返回过滤完毕的信息
			return $data;
		}

		//清空搜索条件的方法
		protected function clearCondition()
		{
			//清空存储搜索条件的成员属性
			$this->field = null;
			$this->where = null;
			$this->order = null;
			$this->limit = null;
		}

		//1.添加数据
		//$data = array('name'=>'小江','sex'=>'m','age'=>18,'classid'=>'web1709','job'=>3)
		//								||
		//								||
		//								\/
		//insert into student (name,sex,age,classid,job) values ('小江','m',18,'web1709',3);
		public function add($data)
		{
			//0.调用过滤字段信息的方法
			$data = $this->filterData($data);

			//1.获取数组中的所有下标
			$keys = array_keys($data);

			//2.将取出的下标按逗号进行拼装
			$key_sql = implode(',',$keys);

			//3.获取数组中的所有值
			$values = array_values($data);

			//4.将取出的值按都好进行拼装
			$val_sql = "'".implode("','",$values)."'";

			//5. 定义sql语句，并发送执行
			$sql = "insert into ".$this->tableName." (".$key_sql.") values (".$val_sql.")";
//			echo $sql;
			$bool = mysqli_query($this->link, $sql);

			//6.判断是否添加成功
			if($bool!=false && mysqli_affected_rows($this->link)>0){

				//返回刚才添加成功信息的id号码
				return mysqli_insert_id($this->link);
			}else{
				return false;
			}
		}

		//2.删除数据
		public function del($id)
		{
			//定义一条删除指定id信息的sql
			$sql = "delete from ".$this->tableName." where ".$this->pk."=".$id.";";
			$bool = mysqli_query($this->link, $sql);

			//判断是否删除成功
			if($bool!=false && mysqli_affected_rows($this->link)>0){
				return mysqli_affected_rows($this->link);
			}else{
				return false;
			}
		}

		//3.修改数据
		public function save($data)
		{
			//1.过滤字段信息
			$data = $this->filterData($data);

			//2.判断是否传入了id
			if(!array_key_exists($this->pk,$data)){
				die('您修改的数据中没有传入要修改信息的主键！请检查后重试！');
			}

			//3.定义存储修改信息与修改条件的空变量
			$set = '';
			$where = '';

			//4.遍历数组
			foreach($data as $k=>$v){

				//判断是否为主键
				if($k==$this->pk){
					$where = $k."=".$v;
				}else{
					$set .= $k."='".$v."',";
				}
			}

			//5.将修改信息最后的逗号去除
			$set = rtrim($set,',');

			//6.定义修改信息的sql语句
			$sql = "update ".$this->tableName." set ".$set." where ".$where;
			$bool = mysqli_query($this->link, $sql);

//			var_dump($sql);

			//7.判断是否修改成功
			if($bool!=false && mysqli_affected_rows($this->link)>0){

				//返回刚才添加成功信息的id号码
				return mysqli_affected_rows($this->link);
			}else{
				return false;
			}
			
		}

		//4.查询单条数据
		public function find($id)
		{
			//定义查询单条数据的sql语句
			$sql = "select * from ".$this->tableName." where ".$this->pk."=".$id;
			$result = mysqli_query($this->link, $sql);
			
			//判断是否查询成功
			if($result!=false && mysqli_num_rows($result)>0){
				//解析结果集
				return mysqli_fetch_assoc($result);
			}else{
				return false;
			}
		}

		//5.查询多条数据
		public function select()
		{
			//1.判断是否限定了要查询的字段信息
			$f = '';
			if(empty($this->field)){
				$f = '*';
			}else{
				$f = $this->field;
			}

			//2.判断是否限定了要查询条件的信息
			$w = '';
			if(!empty($this->where)){
				$w = " where ".$this->where;
			}

			//3.判断是否设定了排序的信息
			$o = '';
			if(!empty($this->order)){
				$o = " order by ".$this->order;
			}

			//4.判断是否设定了分页的信息
			$l = '';
			if(!empty($this->limit)){
				$l = " limit ".$this->limit;
			}

			//5.定义查询多条并且指定条件的sql语句
			$sql = "select ".$f." from ".$this->tableName." ".$w." ".$o." ".$l;
			$result = mysqli_query($this->link, $sql);

			//清空检索条件
			$this->clearCondition();

			//6.判断
			if($result!=false && mysqli_num_rows($result)>0){

				$data = array();
				//解析
				while($rows = mysqli_fetch_assoc($result)){
					$data[] = $rows;
				}

				return $data;
			}else{
				return false;
			}
		}

		//6.定义封装查询字段的信息
		public function field($field)
		{
			$this->field = $field;
			return $this;
		}

		//7.定义封装查询条件的信息
		public function where($where)
		{
			$this->where = $where;
			return $this;
		}

		//8.定义封装排序条件的信息
		public function order($order)
		{
			$this->order = $order;
			return $this;
		}

		//9.定义封装分页条件的信息
		public function limit($limit)
		{
			$this->limit = $limit;
			return $this;
		}

		//10.统计条数的方法
		public function count()
		{
			//定义统计条数的sql语句
			$sql = "select count(*) sum from ".$this->tableName;
			$result = mysqli_query($this->link,$sql);

			//判断是否执行成功
			if($result!=false && mysqli_num_rows($result)>0){
				return mysqli_fetch_assoc($result)['sum'];
			}else{
				return false;
			}
		}

		//12.发送原生语句的方法
		public function query($sql)
		{
			//1.通过分割空格的方式，取出SQL语句的第一个单词
			$point = explode(' ',$sql)[0];
			
			//2.根据单词的含义，执行相应的操作
			switch($point){
				case "insert":

					$bool = mysqli_query($this->link, $sql);
					//判断是否成功
					if($bool!=false && mysqli_affected_rows($this->link)>0){
						return mysqli_insert_id($this->link);
					}else{
						return false;
					}

					break;

				case "delete":

					$bool = mysqli_query($this->link, $sql);
					//判断是否成功
					if($bool!=false && mysqli_affected_rows($this->link)>0){
						return mysqli_affected_rows($this->link);
					}else{
						return false;
					}

					break;

				case "update":

					$bool = mysqli_query($this->link, $sql);
					//判断是否成功
					if($bool!=false && mysqli_affected_rows($this->link)>0){
						return mysqli_affected_rows($this->link);
					}else{
						return false;
					}

					break;

				case "select":

					$result = mysqli_query($this->link, $sql);
					//判断是否成功
					if($result!=false && mysqli_num_rows($result)>0){
						
						$data = array();
						while($rows = mysqli_fetch_assoc($result)){
							$data[] = $rows;
						}
						return $data;

					}else{
						return false;
					}

					break;
			}
		}

		public function __destruct()
		{
			mysqli_close($this->link);
		}
	}