<?php
$config      = include('config.php');
$password    = $config["password"];
$server_ip   = $config["server_ip"];
$server_port = $config["server_port"];
if ($_GET["password"] == $password) {
    $mcpe = $config["mcpe"];
    if ($mcpe == true) {
        $query                       = json_decode(file_get_contents("https://mcapi.ca/query/$server_ip:$server_port/mcpe"), true);
        $query_status                = $query["status"];
        $query_error                 = $query["error"];
        $query_version               = $query["version"];
        $query_players_online        = $query["players"]["online"];
        $query_players_online_commas = number_format($query_players_online);
        $query_players_max           = $query["players"]["max"];
        $query_players_max_commas    = number_format($query_players_max);
    } else {
        $query                       = json_decode(file_get_contents("https://mcapi.ca/query/$server_ip:$server_port/info"), true);
        $query_status                = $query["status"];
        $query_error                 = $query["error"];
        $query_motd                  = $query["motd"];
        $query_version               = $query["version"];
        $query_players_online        = $query["players"]["online"];
        $query_players_online_commas = number_format($query_players_online);
        $query_players_max           = $query["players"]["max"];
        $query_players_max_commas    = number_format($query_players_max);
        $query_ping                  = $query["ping"];
        $query_cache                 = $query["cache"];
    }
    $twitter_consumer_key        = $config["twitter_consumer_key"];
    $twitter_consumer_secret     = $config["twitter_consumer_secret"];
    $twitter_access_token        = $config["twitter_access_token"];
    $twitter_access_token_secret = $config["twitter_access_token_secret"];
    
    if ($query_status == TRUE) {
        $twitter_update = "Online Players:\n$query_players_online_commas/$query_players_max_commas";
    } else {
        $twitter_update = $query_error;
    }
    require_once('codebird/codebird.php');
    \Codebird\Codebird::setConsumerKey("$twitter_consumer_key", "$twitter_consumer_secret");
    $cb = \Codebird\Codebird::getInstance();
    $cb->setToken("$twitter_access_token", "$twitter_access_token_secret");
    $params = array(
        'status' => "$twitter_update"
    );
    $reply  = $cb->statuses_update($params);
} else {
    echo "Invalid Password";
}
?>