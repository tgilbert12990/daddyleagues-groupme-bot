<?php

// get xml config file
$xmlFile = "config.xml";
$xml = simplexml_load_file($xmlFile);
// convert to array
$xmlArr = xml2array($xml);

// easy to access arrays
$cmd_prefix = $xmlArr["config"]["cmdprefix"];
$base_url = $xmlArr["config"]["baseurl"];
$league = $xmlArr["config"]["league"];
$search_limit = $xmlArr["config"]["pslimit"];

// easy to accerss info
$rules = $xmlArr["info"]["rules"];
$ownerList = $xmlArr["info"]["owners"];
// the info array
$importantInfo = $xmlArr["info"];
// the help message for info
$infohelp = "options are:";
foreach ($importantInfo as $key => $value) {
	$infohelp .= " $key,";
}
$infohelp = substr($infohelp, 0, -1);
$importantInfo["help"] = $infohelp;
// twitch names array
$twitchNames = $xmlArr["twitch"];

// get the message as json
$cont = file_get_contents("php://input");
$json = json_decode($cont);
// lowercase makes it easier to recognize commands
$msgText = strtolower( $json->text );
// break into array
$command = preg_split('/\s+/', $msgText);
// check for command prefix
if (substr($command[0], 0, strlen($cmd_prefix)) == $cmd_prefix){
	// get the command
	$cmd = substr($command[0], strlen($cmd_prefix));
	switch ($cmd){
		case "tl": // get a link to a team
			sendTeamLink($command[1]);
			break;

		case "ps": // do a player search
			sendPlayerSearch(array_slice($command, 1));
			break;

		case "tws": // team week score
			sendTeamWeekScore($command[1], $command[2]);
			break;

		case "sync": // get scores for 1 week
			sendLeagueScoresForWeek($command[1]);
			break;

		case "week": // get current week
			sendCurrentWeek();
			break;

		case "twitch": // get Twitch link
			sendTwitchLink(array_slice($command, 1));
			break;
			
		case "info": // get info
			if (!array_key_exists(1, $command) || $command[1] == "") {
				$command[1] = "all";
			}
			sendInfo($command[1]);
			break;
			
		case "img": // get img
			if (!array_key_exists(1, $command) || $command[1] == "") {
				$command[1] = "all";
			}
			sendImg($command[1]);
			break;

		case "helpme": // get help
			sendHelp();
			break;

		default: 
			if (array_key_exists($cmd, $xmlArr["info"])) {
				sendInfo($cmd);
			}
			elseif(array_key_exists($cmd, $xmlArr["img"])) {
				sendImg($cmd);
			}
			elseif ($isAdmin) { // is admin chat?
				include("adminCommands.php");
			}
			else { // main chat
				sendMsg(sprintf("Invalid command. send \"%shelpme\" for help", $cmd_prefix));
			}
			break;
	}
} 
else if (!$msgText && !$json) { // testing zone
	//sendTeamWeekScore("bal", "8");
	//sendLeagueScoresForWeek("8");
	//sendPlayerSearch(array("marcus"));
	//sendCurrentWeek();
	//sendMsg("Rule Book: $rules");
	//sendTwitchLink(array("nyj", "P"));
	//setCommand(array("info", "test"));
	//sendImg($xmlArr["img"]["scalp"]);
}
?>