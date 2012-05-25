<?php
//**********************************
//public function
//**********************************	
function getRowById($db, $table, $id) {
	$sql = "select * from $table where id=$id";
	return $db->get_row ( $sql );
}

function getAllRows($db, $table, $order_by = 'name') {
	$sql = "select * from $table where active=0 order by $order_by;";
	return $db->get_results ( $sql );
}

function getRowsByCondition($db, $table, $where) {
	$sql = "select * from $table ";
	
	$w = "";
	for($i = 0; $i < count ( $where ); $i ++) {
		$w .= $where [$i] . ' ';
	}
	
	if ($w) {
		return $db->get_results ( $sql . ' where ' . $w );
	} else {
		return $db->get_results ( $sql );
	}

}

function updateRecordActive($db,$table,$id,$active){
	$sql = "update $table set active=$active where id=$id";
	$db->query ( $sql );
	return $db->rows_affected;
}


//**********************************
//function related to the user
//**********************************	
function getUserInfo($db, $user_id) {
	$sql = "select * from users where id=$user_id";
	return $db->get_row ( $sql );
}

function addUser($db, $email, $password, $pic, $locale = NULL, $account_type = 'normal' ,$active=0,$register=0) {
	if (! $locale) {
		$locale = DEFAULT_LOCALE;
	}
	$sql = "insert into users (email,password,pic,locale,account_type,active,register) values ('$email','$password','$pic','$locale','$account_type',$active,$register);";
	$db->query ( $sql );
	return getUserInfo ( $db, $db->insert_id );
}

function checkUserByEmail($db, $email,$account_type) {
	$sql = "select * from users where email='$email' and account_type='$account_type' and active=0;";
	return $db->get_results ( $sql );
}

function getAllUsers($db) {
	$sql = "select * from users where active=0 order by email;";
	return $db->get_results ( $sql );
}

function updateUserPoints($db, $user_id, $points) {
	$sql = "update users set points=points+($points) where id=$user_id";
	$db->query ( $sql );
	return $db->rows_affected;
}

function addExchangeLog($db, $user_id, $points) {
	$sql = "Insert into exchange_log(user_id,points) values($user_id,$points);";
	$db->query ( $sql );
	return $db->insert_id;
}


function getUserGroups($db,$user_id){
	$sql = "select g.* from groups g,user_group ug where g.id=ug.group_id and ug.user_id=$user_id;";
	$groups = $db->get_results ( $sql );
	return $groups;
}



function points2Books($db, $user_id, $book_ids) {
	$download_book_ids = array ();
	foreach ( getDownloadBooks ( $db, $user_id ) as $b ) {
		array_push ( $download_book_ids, $b->id );
	}
	
	$user = getRowById ( $db, 'users', $user_id );
	$total_points = 0;
	$new_books = array ();
	foreach ( $book_ids as $bid ) {
		if (! array_key_exists ( $bid, $download_book_ids )) {
			$new_book = getRowById ( $db, 'books', $bid );
			$total_points += $new_book->points;
			array_push ( $new_books, $new_book );
		}
	}
	
	if ($user->points < $total_points) {
		$result = array ('1', 'No enought points for the download books!', $user->points, $total_points );
	} else {
		foreach ( $new_books as $nb ) {
			addDownloadHistory ( $db, $user_id, $nb->id, $nb->points );
		}
		updateUserPoints ( $db, $user_id, $total_points * - 1 );
		$result = array ('0', 'OK', $user->points, $total_points );
	}
	return $result;
}


function activeRegister($db,$id,$register){
	$sql = "update users set register=$register where id=$id;";
	$db->query ( $sql );
	return $db->rows_affected;
}

//**********************************
//function related to the group
//**********************************	
function saveGroup($db, $type, $id, $name, $desc) {
	if ($type == 'UPDATE') {
		$sql = "update groups set name='$name',description='$desc' where id=$id;";
	} elseif ($type == 'NEW') {
		$sql = "insert into groups (name,description) values ('$name','$desc');";
	} elseif ($type == 'DELETE') {
		$sql = "update groups set active = 1 where id=$id;";
	}
	$db->query ( $sql );
	return $db->rows_affected;
}


function getGroupsByUser($db,$userid){
	$sql = "select g.* FROM groups g,user_group ug where g.id = ug.group_id and ug.user_id=$userid";
	return $db->get_results ( $sql );
}

//**********************************
//function related to the book
//**********************************
function getAllBooks($db) {
	$sql = "SELECT b.*,u.email from books b,users u WHERE b.active=0 and u.active=0 and b.create_by=u.id";
	return $db->get_results ( $sql );
}

function addBook($db, $name,$author, $desc, $short_desc, $point, $create_by, $pages,$cover) {
	$sql = "insert into books(name,author,description,short_description,points,create_by,pages,cover) values ('$name','$author','$desc','$short_desc',$point,$create_by,'$pages','$cover');";
	$db->query ( $sql );
	return $db->insert_id;
}

//**********************************
//function related to the category
//**********************************


function saveCateogry($db, $type, $id, $name, $desc, $create_by, $promote) {
	if ($type == 'UPDATE') {
		$sql = "update categories set name='$name',description='$desc',promote=$promote where id=$id;";
	} elseif ($type == 'NEW') {
		$seq = date("YmdHis");
		$sql = "insert into categories (name,description,create_by,promote,seq) values ('$name','$desc',$create_by,$promote,'$seq');";
	} elseif ($type == 'DELETE') {
		$sql = "update categories set active = 1 where id=$id;";
	}
	$db->query ( $sql );
	return $db->rows_affected;
}

//**********************************
//function related to the process
//**********************************
function getDownloadBooks($db, $user_id) {
	$sql = "SELECT b.* from books b, user_book ub where ub.active=0 and b.id=ub.book_id and ub.user_id=$user_id";
	return $db->get_results ( $sql );
}

function getUploadBooks($db, $user_id) {
	$sql = "SELECT b.* from books b , user_book ub where b.active=0 and b.id=ub.book_id and ub.user_id=$user_id";
	return $db->get_results ( $sql );
}

function getDownloadBook($db, $user_id, $book_id) {
	$sql = "select * from user_book where user_id=$user_id and book_id=$book_id";
	return $db->get_row ( $sql );
}

function addDownloadTime($db, $book_id) {
	$sql = "update books set download_times=download_times+1 where id=$book_id";
	$db->query ( $sql );
	return $db->rows_affected;
}

function addDownloadHistory($db, $user_id, $book_id, $points) {
	$sql = "insert into user_book (user_id,book_id,points) values ($user_id,$book_id,$points);";	
	echo $sql;
	$db->query ( $sql );
	return $db->insert_id;
}

//**********************************
//function related to the attachments
//**********************************
function saveAttachment($db, $file_name, $file_path, $file_url, $create_by, $file_size, $file_type) {
	$sql = "insert into attachments(name,file_path,file_url,create_by,file_size,file_type) values('$file_name','$file_path','$file_url',$create_by,$file_size,'$file_type');";
	$db->query ( $sql );
	return $db->insert_id;
}

//**********************************
//function related to the exchange points
//**********************************


//$status  : 0 is new ,1 is approved, -1 is cancel, 2 is not disapproved.
function getExchangeLog($db, $user_id, $status) {
	$sql = "select l.*,u.email,u.points as user_points  from exchange_log l, users u where l.active=0 and u.id=l.user_id ";
	$conditions = array ();
	
	if ($user_id) {
		array_push ( $conditions, " user_id=$user_id " );
	}
	if ($status) {
		array_push ( $conditions, " status=$status" );
	}
	
	if (sizeof ( $conditions ) > 0) {
		$sql .= join ( ' and ', $conditions );
	}
	
	$sql .= ' order by id DESC ;';
	return $db->get_results ( $sql );
}

function processExchangeLog($db, $id, $status) {
	$sql = "update exchange_log set status=$status where id=$id; ";
	$db->query ( $sql );
	return $db->rows_affected;
}

//**********************************
//function related to the buy points
//**********************************
function createOrderNo() {
	$timestr = nowStr ();
	$ramdon = randomStr ( 100, 999 );
	return 'SO' . $timestr . $ramdon;
}

function createOrder($db, $points, $currency, $amount, $remark, $pay_way, $user_id) {
	$no = createOrderNo ();
	$sql = "insert into buy_log(no,points,currency,amount,remark,pay_way,user_id) values ('$no',$points,'$currency',$amount,'$remark','$pay_way',$user_id);";
	$db->query ( $sql );
	echo $sql;
	return $db->insert_id;
}

function updateOrderStatus($db, $id, $status) {
	$sql = "update buy_log set status=$status where id=$id; ";
	$db->query ( $sql );
	return $db->rows_affected;
}
?>