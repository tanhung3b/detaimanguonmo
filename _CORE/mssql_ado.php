<?php
class	mssql_ado()
{
	var		$conn;
	var		$db_name;
	var		$count_query	=	0;	
//	init
	public	function	__construct( $host , $db_user , $db_pass , $db_name)
	{
		$this->$db_name	=	$db_name;		
		$this->conn = new COM ("ADODB.Connection",NULL,CP_UTF8);
		try
		{
			$connStr = "Provider=sqlncli;Data Source=".$host.";Database=".$db_name.";uid=".$db_user.";pwd=".$db_pass.";";
			$this->conn->Open($connStr);
		}
		catch (Exception $ex)
		{
			die("Không thể kết nối với Database");
		}
	}
	public	function	__destruct()
	{
		$this->conn->Close();
	}
//	select - insert - update - delete
	public	function	query ( $sql )
	{
		return	$this->conn->Execute($sql);
	}
	public	function	select ( $table , $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	$this->conn->Execute($sql);
	}
	public	function	insert	( $table , $feild , $values )
	{
		$this->count_query++;
		$sql	=	"INSERT INTO ".$table;
		if	( trim($feild) != "" )
			$sql	.=	" (".$feild.")";
		$sql	.=	" VALUES (".$values.") SELECT @@IDENTITY as incId;";
		
		$this->conn->Execute($sql);
		
		return true;
	}
	public	function	update	( $table , $feild , $value , $where )
	{
		$this->count_query++;
		$sql	=	"UPDATE $table SET $feild = '".$this->inj_str($value)."'";
		if	( trim($where) != "" )
			$sql	.=	" WHERE ".$where;
		
		return $this->conn->Execute($sql);
	}
	public	function	delete	( $table , $where = "" )
	{
		$this->count_query++;
		$sql	=	"DELETE * FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		@mssql_query($sql , $this->conn);
	}
	public	function	execute ( $sql )
	{
		return $this->conn->Execute($sql);
	}
}
?>