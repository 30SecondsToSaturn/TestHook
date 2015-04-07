<?php
include "database.php";

// retrieve the request's body and parse it as JSON
$body = @file_get_contents( 'php://input' );
$event_json = json_decode( $body, true );

// GitHub will hit us with POST (http://help.github.com/post-receive-hooks/)
if ($event_json['pull_request'] != '{}')
{
   // required pull request data
   $statuses_url = $event_json["pull_request"]["statuses_url"];
   $title = $event_json["pull_request"]["title"];
   $pull_request_number = $event_json["pull_request"]["number"];
   
   // which branch was committed?
   $branch = $event_json["pull_request"]["head"]["ref"];
   
   // Create connection
   $db = new Bit_db();
   
   $db->close();
}
?>
