<?php
/*
   MySQL Database Connection Class
*/

class Database 
{
  protected $host;
  protected $user;
  protected $password;
  protected $name;
  protected $conn;
  protected $connectError;


	function __construct( $host, $user, $pass, $name )
	{
		$this->host = $host;
		$this->user = $user;
		$this->password = $pass;
		$this->name = $name;
		$this->connectToDB();
	}

   
   function selectDatabase()
   {
   if (! mysqli_select_db( $this->conn, $this->name ) )
      {
         trigger_error( 'selection failed' );  
         $this->connectError = true;                     
      }
   }
    

	function connectToDB()
	{
		$this->conn = mysqli_connect( $this->host, $this->user, $this->password );
		if ( !$this->conn )
		{
		   trigger_error('connection failed' );
		   $this->connectError = true;
        }
	   
	}

   function isError()
   {
      if  ( $this->connectError )
      {
         return true;
      }
      $error = mysqli_error( $this->conn );
      if (empty ($error))
      {
           return false;
      }
      else
      {
           return true;   
      }
   }

  

	function query( $sql )
	{
      mysqli_query( $this->conn, "set character_set_results='utf8'"); 
      if (!$queryResource = mysqli_query($this->conn, $sql ))
		 {
			trigger_error ( 'Query Failed: <br>' . mysqli_error($this->conn ) . '<br> SQL: ' . $sql );
			return false;
		 }	 
		 return new MySQLResult( $this, $queryResource ); 
   }
   
}


class MySQLResult 
{
   protected $mysql;
   protected $query;

   function __construct( &$mysql, $query )
   {
     $this->mysql = &$mysql;
     $this->query = $query;
   }

    function size()
    {
        return mysqli_num_rows($this->query);
    }

    function fetch()
    {
		if ( $row = mysqli_fetch_array( $this->query , MYSQLI_ASSOC ))
		{
		   return $row;
		}
			   else if ( $this->size() > 0 )
       {
           mysqli_data_seek ( $this->query , 0 );
           return false;
       }
       else
       {
           return false;
       }         
    }

    function insertID()
    {
            /**
            * returns the ID of the last row inserted
            * @return  int
            * @access  public
            */
          return mysqli_insert_id($this->mysql->conn);
    }


   function isError()
   {
        return $this->mysql->isError();
   }
}