<?php
/*
	LEGO-PHP
	@author - Hoang Huy Phan
	@All rights reserved
	Support by	:	_
	Edited by	:	_
*/
//	Public function
class	lg_mssql
{
	var		$conn;
	var		$db_name;
	var		$count_query	=	0;	
//	init
	public	function	__construct( $host , $db_user , $db_pass , $db_name)
	{
		$this->$db_name	=	$db_name;
		$this->conn	=	mssql_connect($host , $db_user, $db_pass);
		mssql_select_db($db_name , $this->conn);
	}
	public	function	__destruct()
	{
		@mssql_close( $this->conn );
	}
//	select - insert - update - delete
	public	function	query ( $sql )
	{
		return @mssql_query($sql , $this->conn);
	}
	public	function	select ( $table , $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mssql_query($sql , $this->conn);
	}
	public	function	insert	( $table , $feild , $values )
	{
		$this->count_query++;
		$sql	=	"INSERT INTO ".$table;
		if	( trim($feild) != "" )
			$sql	.=	" (".$feild.")";
		$sql	.=	" VALUES (".$values.") SELECT @@IDENTITY as incId;";
		@mssql_query($sql, $this->conn );
		return	mssql_insert_id($this->conn);
	}
	public	function	update	( $table , $feild , $value , $where )
	{
		$this->count_query++;
		$sql	=	"UPDATE $table SET $feild = '".$this->inj_str($value)."'";
		if	( trim($where) != "" )
			$sql	.=	" WHERE ".$where;
		return	@mssql_query($sql, $this->conn );
	}
	public	function	delete	( $table , $where = "" )
	{
		$this->count_query++;
		$sql	=	"DELETE * FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		@mssql_query($sql , $this->conn);
		$this->optimize($table);
	}
	public	function	execute ( $procedure )
	{
		$stmt	=	@mssql_init($procedure, $this->conn);
		return	mssql_execute($stmt);
	}
//	optimize
	public	function	optimize ( $table_name )
	{
		return	false;
	}
//	fetch
	public	function	fetch ( $rs )
	{
		return @mssql_fetch_array( $rs );
	}
//	seek
	public	function	seek ( $rs , $id )
	{
		return @mssql_data_seek($rs, $id);
	}
//	Trả về - số records - của - 1 Result Set
	public	function	num_rows ( $rs )
	{
		return	mssql_num_rows( $rs );
	}
//	Hàm này - dùng để - chuyển - các ký tự - đặc biệt - sang - thể Escape - chống - Hack - SQL Injection
	public	function	inj_str	( $txt )
	{
		return	mysql_escape_string($txt);
	}
	public	function	escape ( $txt )
	{
		return	mysql_escape_string($txt);
	}
	public	function	error()
	{
		return mysql_error($this->conn);
	}
}
?>