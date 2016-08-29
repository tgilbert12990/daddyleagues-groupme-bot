<?php


function sendConfig($option) {
	global $xmlArr;
	$msg = "";
	if (!$option || $option == "all") {
		foreach ($xmlArr["config"] as $key => $value) {
			$msg .= "$key: $value\n";
		}
		$msg = substr($msg, 0, -1);
	}
	elseif (key_exists($option, $xmlArr["coinfig"])) {
		$msg = "$option: " . $xmlArr["config"][$option];
	}
	else {
		$msg = "$option is not a cofig setting";
	}
	sendMsg($msg);
}

function setCommand($options) {
	if (!$options) {
		sendMsg("no command specified");
		return;
	}
	global $xmlArr;
	$command = $options[0];
	$options = array_slice($options, 1);
	$setWorked = false;
	if (array_key_exists($command, $xmlArr)) {
		if ($command == "twitch") {
			$setWorked = setTwitch($options);
		}
		elseif ($command == "info") {
			$setWorked = setInfo($options);
		}
		elseif ($command == "config") {
			$setWorked = setConfig($options);
		}
	}
}

function setInfo($options) {
	global $xml, $xmlFile;
	if (count($options) > 1) {
		$options[1] = join(" ", array_slice($options, 1));
		$xml->info->{strtolower($options[0])} = $options[1];
	}
	else {
		unset($xml->info->{strtolower($options[0])});
	};
	$xml->twitch->{$team} = $options[1];
	if ($xml->asXml($xmlFile)) {
		sendMsg("Info update successful");
	}
	else {
		sendMsg("Info update unsuccessful");
	}
}

function setConfig($options) {
	global $xml, $xmlFile;
	if (count($options) > 1) {
		$options[1] = join(" ", array_slice($options, 1));
		$xml->config->{strtolower($options[0])} = $options[1];
	}
	else {
		unset($xml->config->{strtolower($options[0])});
	}
	$xml->twitch->{$team} = $options[1];
	if ($xml->asXml($xmlFile)) {
		sendMsg("Config update successful");
	}
	else {
		sendMsg("Config update unsuccessful");
	}
}

function setTwitch($options) {
	global $xml, $xmlFile;
	$team = "";
	$origiTeam;
	$team = getTeam($options[0]);
	$origiTeam = $options[0];
	if (!$team) {
		return;
	} 
	$xml->twitch->{$team} = $options[1];
	if ($xml->asXml($xmlFile)) {
		sendMsg("Twitch update successful");
	}
	else {
		sendMsg("Twitch update unsuccessful");
	}
}
?>
