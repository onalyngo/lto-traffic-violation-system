<?php
error_reporting(E_ALL);

class DBCon extends PDO{

    public function __construct( $DB_TYPE, $DB_HOST, $DB_NAME, $DB_USERNAME, $DB_PASSWORD ){
		//construct db connection using PDO method
		parent::__construct( $DB_TYPE . ':host=' . $DB_HOST . '; dbname=' . $DB_NAME, $DB_USERNAME, $DB_PASSWORD );
    
	}

}

?>