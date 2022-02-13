<?php
class SermonInfo {
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

  function __construct() {}
}

class SermonApp {
  /**
   * Church Ubuntu
   * DO NOT commit DB connection info
   * These info will be updated in the production
   */
  private static $chsql_server = '';
  private static $chsql_user = '';
  private static $chsql_ps = '';
  private static $chsql_db = '';

  function __construct() {}
  private function db_Connect() {}

  // Function to get sermon info by its id form DB
  function getInfoById($sermonid) {
    try {
      $TheSermonInfo= new SermonInfo;
      $DBCon = mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);
      $DBCon->set_charset("utf8");

      if (!$DBCon) {
        throw new Exception('Failed to connect to MySQL: ');
      }

      $MySQLString = 'SELECT * FROM ch_sermon where id = "'.$sermonid.'"';
      $result = $DBCon->query($MySQLString);
    } catch (Exception $e) {
      echo 'Failed to get sermon info by id. Exception: '. $e->getMessage().'\n';
    }

    mysqli_close($DBCon);

    if($result->num_rows == 1) {
      $TheSermon = mysqli_fetch_assoc($result);
      $TheSermonInfo->id = $TheSermon['id'];
      $TheSermonInfo->sermondate = $TheSermon['sermondate'];
      $TheSermonInfo->speaker = $TheSermon['speaker'];
      $TheSermonInfo->topic = $TheSermon['topic'];
      $TheSermonInfo->section = $TheSermon['section'];
      $TheSermonInfo->location = $TheSermon['location'];
      $TheSermonInfo->remark = $TheSermon['remark'];
      $TheSermonInfo->audiofile = $TheSermon['audiofile'];
      $TheSermonInfo->bibleID = $TheSermon['bibleID'];
      $TheSermonInfo->updatedBy = $TheSermon['updatedBy'];
      $TheSermonInfo->updatedTime = $TheSermon['updatedTime'];
      $TheSermonInfo->activeFlag = $TheSermon['activeFlag'];
    }

    return $TheSermonInfo;
  }

  // Function to get sermon list from DB
  function listSermon() {
    try {
      $DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);
      $DBCon->set_charset("utf8");

      if (!$DBCon) {
        throw new Exception('Failed to connect to MySQL: ');
      }

      $MySQLString='SELECT * FROM ch_sermon where activeFlag="Active" order by sermondate desc';
      $result = $DBCon->query($MySQLString);
    } catch (Exception $e) {
      echo 'Failed to get sermon list. Exception: '.$e->getMessage().'\n';
    }

    mysqli_close($DBCon);

    return $result;
  }

  // Function to get sermon list by year from DB
  function listSermonByYear($TheYear) {
    try {
      $DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);
      $DBCon->set_charset("utf8");

      if (!$DBCon) {
        throw new Exception('Failed to connect to MySQL: ');
      }

      $MySQLString='SELECT * FROM ch_sermon where YEAR(sermondate) = "'.$TheYear.'" AND activeFlag="Active" order by sermondate desc';
      $result = $DBCon->query($MySQLString);
    } catch (Exception $e) {
      echo 'Failed to get sermon list by year. Exception: '.$e->getMessage().'\n';
    }

    mysqli_close($DBCon);
    return $result;
  }

  // Function to create and insert sermon record to DB
  function create($sermonData) {
    try {
      $DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);
      $DBCon->set_charset("utf8");

      if (!$DBCon){
        throw new Exception('Failed to connect to MySQL: ');
      }

      $sermonData->updatedTime=date("Y-m-d H:i:s");
      $MySQLString='INSERT INTO ch_sermon (sermondate,speaker,topic,section,location,remark,audiofile,updatedBy,updatedTime,bibleID) VALUES ("'
      .$DBCon->real_escape_string($sermonData->sermondate).'","'
      .$DBCon->real_escape_string($sermonData->speaker). '","'
      .$DBCon->real_escape_string($sermonData->topic).'","'
      .$DBCon->real_escape_string($sermonData->section).'","'
      .$DBCon->real_escape_string($sermonData->location).'","'
      .$DBCon->real_escape_string($sermonData->remark).'","'
      .$DBCon->real_escape_string($sermonData->audiofile).'","'
      .$sermonData->updatedBy.'","'
      .$sermonData->updatedTime.'","'
      .$sermonData->bibleID.'","';

      if($DBCon->query($MySQLString) !=true) {
        throw new Exception('Failed to create the record into MySQL:sql:'.$MySQLString.' ||Error:'.$DBCon->error);
      }

    } catch (Exception $e) {
      error_log($e->getMessage(),0);
      echo 'Failed to create sermon record. Exception: '.$e->getMessage().'\n';
    }

    mysqli_close($DBCon);

  }

  // Function to update sermon record in DB
  function update($sermonData) {
    try {
      $DBCon=mysqli_connect(self::$chsql_server,self::$chsql_user,self::$chsql_ps,self::$chsql_db);
      $DBCon->set_charset("utf8");
      if (!$DBCon) {
        throw new Exception('Failed to connect to MySQL: ');
      }

      $sermonData->updatedTime = date("Y-m-d H:i:s");
      $MySQLString='Update ch_sermon SET '
        .'sermondate="'.$DBCon->real_escape_string($sermonData->sermondate).'",'
        .'speaker="'.$DBCon->real_escape_string($sermonData->speaker).'",'
        .'topic="'.$DBCon->real_escape_string($sermonData->topic).'",'
        .'section="'.$DBCon->real_escape_string($sermonData->section).'",'
        .'location="'.$DBCon->real_escape_string($sermonData->location).'",'
        .'remark="'.$DBCon->real_escape_string($sermonData->remark).'",'
        .'audiofile="'.$DBCon->real_escape_string($sermonData->audiofile).'",'
        .'updatedBy="'.$sermonData->updatedBy.'",'
        .'updatedTime="'.$sermonData->updatedTime.'",'
        .'activeFlag="'.$sermonData->activeFlag.'",'
        .'bibleID="'.$sermonData->bibleID.'" where '
        .'id="'.$sermonData->id.'"';

      if($DBCon->query($MySQLString) !=true) {
        throw new Exception('Failed to update the record into MySQL:sql:'.$MySQLString.' ||Error:'.$DBCon->error);
      }

    } catch (Exception $e) {
      error_log($e->getMessage(),0);
      echo 'Failed to update sermon record. Exception: '.$e->getMessage().'\n';
    }

    mysqli_close($DBCon);

  }

  // Function to delete recode -> update its flg to 'inactive'
  function delete($sermonData) {
    $sermonData->activeFlag = 'Inactive';
    $this->update($sermonData);
  }
}
?>
