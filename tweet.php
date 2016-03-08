<?php
# Input your server IP and port :)
$server_IP   = "play.lbsg.net";
$server_Port = "19132";

# You probably shouldn't touch these variables. Move along!
$query_JSON          = json_decode(file_get_contents("https://mcapi.ca/query/$server_IP:$server_Port/mcpe"), true);
$query_OnlineStatus  = $query_JSON["status"];
$query_ServerVersion = $query_JSON["version"];
$query_OnlinePlayers = $query_JSON["players"]["online"];
$query_MaxPlayers    = $query_JSON["players"]["max"];

# Twitter API Tokens
$your_ConsumerKey       = "blank";
$your_ConsumerSecret    = "blank";
$your_AccessToken       = "blank";
$your_AccessTokenSecret = "blank";

# Tweets
if ($query_OnlineStatus == TRUE) {
	# YAY! Your server is online! Tweet about it :)
    $your_Tweet = "Connected Players\n$query_OnlinePlayers/$query_MaxPlayers\n\nVersion\n$query_ServerVersion";
} else {
	# The script is having trouble querying your server. Tweet about it :(
    $your_Tweet = "Server is offline or unreachable.";
}

# UNLESS YOU KNOW WHAT YOU'RE DOING - DON'T EDIT ANYTHING BELOW THIS LINE! #
require_once('codebird/codebird.php');

\Codebird\Codebird::setConsumerKey("$your_ConsumerKey", "$your_ConsumerSecret");
$cb = \Codebird\Codebird::getInstance();
$cb->setToken("$your_AccessToken", "$your_AccessTokenSecret");

$params = array(
    'status' => "$your_Tweet"
);
$reply  = $cb->statuses_update($params);
?>