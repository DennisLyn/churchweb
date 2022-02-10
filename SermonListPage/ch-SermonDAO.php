<?php # BibleApplication.php

class sermonInfo {
	
	public $id;
	public $sermondate;
	public $speaker;
	public $topic;
	public $section;
	public $location;
	public $remark;
	public $audiofile;
	public $bibleID;
	public $updatedBy;
	public $updatedTime;
	public $activeFlag;
	
	function __construct() 
		{	
		
		}	
		

}

class sermonApp {

	// Church Ubuntu
	private static $chsql_server="";
	private static $chsql_user="";
	private static $chsql_ps="";
	private static $chsql_db="";
	
	
	function __construct() 
		{	
		
		}	
	private function db_Connect()
		{
			
		}
	function GetInfoById($sermonid)
		{
			try
			{
				$TheSermonInfo=new sermonInfo;
				$DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);
				
				$DBCon->set_charset("utf8");
				if (!$DBCon)
					{
						throw new Exception('Failed to connect to MySQL: ');
						//echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					$MySQLString="SELECT * FROM ch_sermon where id = '".$sermonid."'";
					//echo $MySQLString;			
					$result = $DBCon->query($MySQLString);
					//$count=mysql_num_rows($result);
					//echo "==>".$count;
			}
			catch (Exception $e) 
			{
				//$ReturnMessage="Error:" + $e->getMessage();
				echo 'Caught exception: '.  $e->getMessage(). "\n";
			}	
			/*
			finally
			{
			  
			}
			*/
			mysqli_close($DBCon);
			if($result->num_rows==1)
				{
					$TheSermon = mysqli_fetch_assoc($result);
					$TheSermonInfo->id=$TheSermon["id"];
					$TheSermonInfo->sermondate=$TheSermon["sermondate"];
					$TheSermonInfo->speaker=$TheSermon["speaker"];
					$TheSermonInfo->topic=$TheSermon["topic"];
					$TheSermonInfo->section=$TheSermon["section"];
					$TheSermonInfo->location=$TheSermon["location"];
					$TheSermonInfo->remark=$TheSermon["remark"];
					$TheSermonInfo->audiofile=$TheSermon["audiofile"];
					$TheSermonInfo->bibleID=$TheSermon["bibleID"];
					$TheSermonInfo->updatedBy=$TheSermon["updatedBy"];
					$TheSermonInfo->updatedTime=$TheSermon["updatedTime"];
					$TheSermonInfo->activeFlag=$TheSermon["activeFlag"];
				}
			return $TheSermonInfo;
		
		}
	function ListSermon()
		{
			try
			 {
				$DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);
				
				$DBCon->set_charset("utf8");
				if (!$DBCon)
					{
						throw new Exception('Failed to connect to MySQL: ');
						//echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					$MySQLString="SELECT * FROM ch_sermon where activeFlag='Active' order by sermondate desc";
					//echo $MySQLString;			
					$result = $DBCon->query($MySQLString);
					//$count=mysql_num_rows($result);
					//echo "==>".$count;
			}
			catch (Exception $e) 
				{
					//$ReturnMessage="Error:" + $e->getMessage();
					echo 'Caught exception: '.  $e->getMessage(). "\n";
				}	
			/*
			finally
			{
			  
			}
			*/
			mysqli_close($DBCon);
			return $result;
		
		}
	function ListSermonByYear($TheYear)
		{
			try
			{
				$DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);
				
				$DBCon->set_charset("utf8");
				if (!$DBCon)
					{
						throw new Exception('Failed to connect to MySQL: ');
						//echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					$MySQLString="SELECT * FROM ch_sermon where YEAR(sermondate) = '".$TheYear."' AND activeFlag='Active' order by sermondate desc";
					//echo $MySQLString;			
					$result = $DBCon->query($MySQLString);
					//$count=mysql_num_rows($result);
					//echo "==>".$count;
			}
			catch (Exception $e) 
			{
				//$ReturnMessage="Error:" + $e->getMessage();
				echo 'Caught exception: '.  $e->getMessage(). "\n";
			}	
			/*
			finally
			{
			  
			}
			*/
			mysqli_close($DBCon);
			return $result;
		
		}
		
	function Create($sermonData)	
		{
			try
			 {
				$DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);			
				$DBCon->set_charset("utf8");
				if (!$DBCon)
					{
						throw new Exception('Failed to connect to MySQL: ');
						//echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					
				$sermonData->updatedTime=date("Y-m-d H:i:s");
				$MySQLString="INSERT INTO ch_sermon (sermondate,speaker,topic,section,location,remark,audiofile,updatedBy,updatedTime,bibleID) VALUES ('"
				.$DBCon->real_escape_string($sermonData->sermondate)."','"
				.$DBCon->real_escape_string($sermonData->speaker)."','"
				.$DBCon->real_escape_string($sermonData->topic)."','"
				.$DBCon->real_escape_string($sermonData->section)."','"
				.$DBCon->real_escape_string($sermonData->location)."','"
				.$DBCon->real_escape_string($sermonData->remark)."','"
				.$DBCon->real_escape_string($sermonData->audiofile)."','"
				.$sermonData->updatedBy."','"
				.$sermonData->updatedTime."','"
				.$sermonData->bibleID."')";
				
				//echo "<BR> sql=".$MySQLString;
				
				if($DBCon->query($MySQLString)===true)
					{
						
					}
				else
					{
						throw new Exception('Failed to create the record into MySQL:sql:'.$MySQLString." ||Error:".$DBCon->error);
					}
				
			 }
			 catch (Exception $e) 
				{
					//$ReturnMessage="Error:" + $e->getMessage();
					//echo 'Caught exception: '.  $e->getMessage(). "\n";
					error_log($e->getMessage(),0);
				}	
		
			mysqli_close($DBCon);
			
		}
	
	function Update($sermonData)	
		{
			try
			 {
				$DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);				
				$DBCon->set_charset("utf8");
				if (!$DBCon)
					{
						throw new Exception('Failed to connect to MySQL: ');
						//echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					
				$sermonData->updatedTime=date("Y-m-d H:i:s");
				
				$MySQLString="Update ch_sermon SET "
				."sermondate='".$DBCon->real_escape_string($sermonData->sermondate)."',"
				."speaker='".$DBCon->real_escape_string($sermonData->speaker)."',"
				."topic='".$DBCon->real_escape_string($sermonData->topic)."',"
				."section='".$DBCon->real_escape_string($sermonData->section)."',"
				."location='".$DBCon->real_escape_string($sermonData->location)."',"
				."remark='".$DBCon->real_escape_string($sermonData->remark)."',"
				."audiofile='".$DBCon->real_escape_string($sermonData->audiofile)."',"
				."updatedBy='".$sermonData->updatedBy."',"
				."updatedTime='".$sermonData->updatedTime."',"
				."activeFlag='".$sermonData->activeFlag."',"
				."bibleID='".$sermonData->bibleID."' where "
				."id='".$sermonData->id."'";
				
								
				//echo "<BR> sql=".$MySQLString;
				
				if($DBCon->query($MySQLString)===true)
					{
						
					}
				else
					{
						throw new Exception('Failed to update the record into MySQL:sql:'.$MySQLString." ||Error:".$DBCon->error);
					}
				
			 }
			 catch (Exception $e) 
				{
					//$ReturnMessage="Error:" + $e->getMessage();
					//echo 'Caught exception: '.  $e->getMessage(). "\n";
					error_log($e->getMessage(),0);
				}	
		
			mysqli_close($DBCon);
			
		}
		
		function Delete($sermonData)
			{
				$sermonData->activeFlag="Inactive";
				$this->Update($sermonData);
			}
		
}

?>