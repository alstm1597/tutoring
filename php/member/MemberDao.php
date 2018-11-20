<?php 
	class MemberDao{
		private $db;
		//다른 파일에서 new MemberDao가 호출되면 __construct가 자동 호출됨 자바의 생성자 격
		public function __construct(){
			try{
				$this->db = new PDO("mysql:host=localhost;dbname=php", "root", "1111");

				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}
		public function getMember($id){
			try{
				$sql = "select * from member where id = :id";
				/*
				준비하다, 실행준비, DB서버가...
				1. 문법검사
				2. 유효성검사
				3. 실행계획 수립
				*/
				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->execute();
				$result = $pstmt->fetch(PDO::FETCH_ASSOC);

			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $result;
		}
		public function insertMember($id, $pw, $name){
			try{
				$sql = "insert into member(id, pw, name) values(:id, :pw, :name)";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->bindValue(":pw", $pw, PDO::PARAM_STR);
				$pstmt->bindValue(":name", $name, PDO::PARAM_STR);
				$pstmt->execute();	
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function updateMember($id, $pw, $name){
			try{
				$sql = "update member set pw=:pw, name=:name where id=:id";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":pw", $pw, PDO::PARAM_STR);
				$pstmt->bindValue(":name", $name, PDO::PARAM_STR);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);

				$pstmt->execute();
				
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function deleteMember($id){
			try{
				$sql = "delete from member where id=:id";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->execute();
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}
		public function getMsg($id){
			try{
				$sql = "select * from member where id = :id";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->execute();
				$msg = $pstmt->fetch(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $msg;
		}
		public function getNumMsgs(){
			try{
				$sql = "select count(*) from member where id != 'admin'";

				$pstmt = $this->db->prepare($sql);
				$pstmt->execute();
#
				$numMsgs = $pstmt->fetchColumn();
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $numMsgs;
		}

		public function getManyMsgs($start, $rows){
			try{
				$sql = "select * from member where id != 'admin' order by id desc limit :start, :rows";
				
				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":start", $start, PDO::PARAM_INT);
				$pstmt->bindValue(":rows", $rows, PDO::PARAM_INT);
				$pstmt->execute();
				$msgs = $pstmt->fetchAll(PDO::FETCH_ASSOC); 

			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $msgs;
		}
	}
 ?>