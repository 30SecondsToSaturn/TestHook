<?php
class Bit_db
{
   private $table_webhook = "webhook";
   private $conn;
   private $logger = Logger::getLogger("main");
   function __construct()
   {
      // load database connection settings
      $filename = "mysql.json";
      $db_handle = fopen( $filename, "r" ) || die( "Can't open database connection file!" );
      $mysql_connection_data = json_decode( fread( $handle, filesize( $filename ) ) );
      
      // get connection settings
      $servername = $mysql_connection_data["servername"];
      $username = $mysql_connection_data["username"];
      $password = $mysql_connection_data["password"];
      $dbname = $mysql_connection_data["DB"];
      
      // create connection
      $conn = new mysqli( $servername, $username, $password, $dbname );
   }
   public function addWebhook($statuses_url, $title, $number, $branch)
   {
      switch ( substr($branch, 0, 4) )
      {
         case "feat":
            $prio = 0;
            break;
         case "bugf":
            $prio = 1;
            break;
         case "hotf":
            $prio = 2;
            break;
         default:
            $prio = -1;
            break;
      }
      
      $sql = "INSERT INTO $table_webhook (priority, statuses_url, title, number, branch) ";
      $sql .= "VALUES ($prio, '$statuses_url', '$title', $number, '$branch')";
      
      // Check connection
      if ($conn->connect_error)
      {
         $logger->error( "Connection failed: " . $conn->connect_error );
      }
      elseif ($conn->query( $sql ) === TRUE)
      {
         $logger->debug("New record created successfully");
      }
      else
      {
         $logger->error("Error: " . $sql . "<br>" . $conn->error);
      }
   }
}
?>