# Daddyleagues Groupme Bot

[JasonLBogle.com](http://jasonlbogle.com)

This is an unofficial Groupme bot that you can use 
in conjuction with a Madden league on Daddyleagues. 

There are actually 2 bots. 1 for the main groupme, 
and 1 for and admin groupme. They use mostly the same
code, but the admin bot adds a couple of commands. 

---

### Dependencies

This bot depends on the httpful library. Download it at 
http://phphttpclient.com/
and simply upload the httpful.phar file to the same directory
as the bots. 

---

### Installation

1. Edit the config.xml file to your needs. 
  * config attributes
    * league: the daddyleagues directory of your league 
	(example: league website is "http://daddyleagues.com/TSL", 
	use "TSL")
    * cmdprefix: what will preceed each command
    * pslimit: the maximum numberr of players a player 
    search will return
  * info attributes
    * league: the name of the league
	* commish: the league's commisioner
	* rules: a link to the rules (or you could just put the 
	rules there)
	* owners: a link to the owner list (or you could just put 
	the owner list there)
	* adv: the next scheduled advance
	* draft: the next scheduled draft
	* botdev: I ask that you leave this setting as-is
  * twitch attributes
    * put the twitch user name for each team's owner 
2. Upload the files to a server.
3. Create a bot for the main groupme at https://dev.groupme.com/bots
  * select the desired group 
  * paste the mainBot.php url into the Callback URL field
4. Copy the bot id and paste it into the $bot_token variable
in "mainBot.php" then reupload it.
5. Repeat steps 3 and 4, but for the admin bot. 

---

### Using Commands

Notes: 
* everything is case-insensitive unlesss otherwise noted.
* parameters in brackets are optional.

#### Basic

##### Daddyleagues-Based Commands

NOTE: Daddyleagues does not work for Madden 17 leagues yet, 
so these commands are useless in Madden 17 leagues right now.
This is why they are currently not included in the helpme message. 

* tl: Gets a link to the team on Daddyleagues
* ps [options]: performs a player search baseds on options 
  * options: all are optional
    * name: player name of the player
	* position: the position (qb, hb, wr, ...)
	* team: can be abbreviation or team name (ten or titans)
	* rookie: search only rookies (r or rookie)
	* not specifying any options will return the top players in the league
* tws team week: Returns the score for the specified tean and week
  * team: can be abbreviation or team name (ten or titans)
  * week: 1-17, wc, dr, cc, sb
* sync week: Gets the scores/schedule for a specified week
*NOTE* This command almost never finishes before it times out. 
  * week: 1-17, wc, dr, cc, sb
* week: Gets the current week according to daddyleagues
* helpme: Returns a help message

##### XML-Based Commands

These commands get info from config.xml

* twitch team [team2] [popout]: Returns a link to the team's twitch
  * team: can be abbreviation or team name (ten or titans); if "list",
  a list of the twitch names is returned
  * team2: if specified, a multitwitch link is returned
  * poput: optional. Makes the command return a link to the popout 
  url (p or popout)
* rules: Returns the rules
* info [key]: Returns info based on the key 
  * key: a key that exists in the info portion of config.xml
  * if no key is specified, it returns all info
* img [key]: Returns an image based on the key 
  * key: a key that exists in the img portion of config.xml
  * if no key is specified, it returns a list of images
* youtube [key]: Returns youtube info based on the key 
  * key: a key that exists in the youtube portion of config.xml
  * if no key is specified, it returns all youtube info
* custom [key]: Returns custom info based on the key 
  * key: a key that exists in the custoim portion of config.xml
  * if no key is specified, it returns all custom info
* emoji [key]: Returns an emoji based on the key 
  * key: a key that exists in the emoji portion of config.xml
  * if no key is specified, it returns all emoji keys
* key: shorthand for "info key", "img key", "custom key", and "emoji key" 
  * searches "info" first, then "img" if not found

#### Admin

* config [key]: Returns config info based on the key 
  * key: a key that exists in the config portion of config.xml
  * if no key is specified, it returns all config info. 
* set key1 key2 [value]: sets the value of an attribute
  * key1: options:
    * config
	* info
	* img
	* custom
	* emoji
	* youtube
	* twitch
  * key2: an  existing or new attribute in the key1 portion of config.xml
  * value: case-sensitive. the value. if not specified, key2 is delted from key1

---

My next task is to refactor some of the code. 

---

## LICENSE

This plugin is being made available under the MIT License as found in the 
repository.

If you use it in your own project, please let me know. While you are not 
required to letr me know you are using it, I think it would be cool to see what 
others are using it for. 