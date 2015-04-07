<?php
class Bit_db
{
   private $table_webhook = "webhook";
   private $conn;
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
      $sql = "INSERT INTO $table_webhook (statuses_url, title, number, branch) ";
      $sql .= "VALUES ('$statuses_url', '$title', '$number', $branch)";
      
      // Check connection
      if ($conn->connect_error)
      {
         die( "Connection failed: " . $conn->connect_error );
      }
      elseif ($conn->query( $sql ) === TRUE)
      {
         echo "New record created successfully";
      }
      else
      {
         echo "Error: " . $sql . "<br>" . $conn->error;
      }
   }
}
?>