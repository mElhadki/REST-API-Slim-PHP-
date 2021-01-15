<?php
/**
 * Connect MySQL with PDO class
 */
class db {
  
  private $dbhost = 'localhost';
  private $dbuser = 'root';
  private $dbpass = '';
  private $dbname = 'gallery';

  public function connect() {

    $prepare_conn_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
    $dbConn = new PDO( $prepare_conn_str, $this->dbuser, $this->dbpass );


    $dbConn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // return the database connection back
    return $dbConn;
  }
}