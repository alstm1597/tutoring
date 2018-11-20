<?php 
class ImageCmtDao{
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

	public function getCmsg($num){
		try{
			$sql = "select * from imagecmt num where num = :num";

			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":num", $num, PDO::PARAM_STR);
			$pstmt->execute();
			$msg = $pstmt->fetch(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $msg;
	}

	public function getNumCmsgs($bdnum){
		try{
			$sql = "select count(*) from imagecmt where bdnum =:bdnum";

			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":bdnum", $bdnum, PDO::PARAM_INT);
			$pstmt->execute();

			$numMsgs = $pstmt->fetchColumn();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $numMsgs;
	}

	public function selectCmt($bdnum){
		try{
			$sql = "select * from imagecmt where bdnum =:bdnum order by num desc";
			
			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":bdnum", $bdnum, PDO::PARAM_INT);

			$pstmt->execute();
				$result = $pstmt->fetchAll(PDO::FETCH_ASSOC); //fechall()는 열 전부를 PDO::FETCH_ASSOC 연관배열로

			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $result;
		}		
		public function insertCmsg($id, $name, $bdnum, $cmt){
			try{
				$sql = "insert into imagecmt(id, name, bdnum, cmt) values(:id, :name, :bdnum, :cmt)";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->bindValue(":name", $name, PDO::PARAM_STR);
				$pstmt->bindValue(":bdnum", $bdnum, PDO::PARAM_INT);
				$pstmt->bindValue(":cmt", $cmt, PDO::PARAM_STR);


				$pstmt->execute();
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function deleteCmsg($num){
			try{
				$sql = "delete from imagecmt where num=:num";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":num", $num, PDO::PARAM_INT);
				$pstmt->execute();
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function updateCmt($num, $id, $name, $bdnum, $cmt){
			try{
				$sql = "update imagecmt set id=:id, name=:name, bdnum=:bdnum, cmt=:cmt where num=:num";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->bindValue(":name", $name, PDO::PARAM_STR);
				$pstmt->bindValue(":bdnum", $bdnum, PDO::PARAM_INT);
				$pstmt->bindValue(":cmt", $cmt, PDO::PARAM_STR);
				$pstmt->bindValue(":num", $num, PDO::PARAM_INT);

				$pstmt->execute();
				
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}
	}
	?>