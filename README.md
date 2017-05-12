# Daddyleagues Groupme Bot

[JasonLBogle.com](http://jasonlbogle.com)

[Donate on PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LZV3AVMN5EK4Q)

This is an unofficial Groupme bot that you can use 
in conjuction with a Madden league on Daddyleagues. 

There are actually 2 bots. 1 for the main groupme, 
and 1 for an admin groupme. They use mostly the same
code, but the admin bot adds a couple of commands. 

---

### Dependencies

This bot depends on the httpful library from 
http://phphttpclient.com/
but I have added the file directly in the repository.

---

### Installation

#### Installing on Heroku

1. Install git and the Heroku CLI
2. Run this command from the command line to clone the repository and 
go into the directory: 
  * `git clone https://github.com/kicker10BOG/daddyleagues-groupme-bot.git`
  * `cd daddyleagues-groupme-bot`
3. Create a bot for the main groupme at https://dev.groupme.com/bots
  * select the desired group
4. Copy the bot id and paste it into the $bot_token variable
in "mainBot.php".
5. Repeat steps 3 and 4, but for the admin bot. 
6. Edit "config.xml" appropiately. See below for info regarding it. 
7. Deploy the app
  * Run these commands: 
    * `heroku create`
    * `git commit -am "initial push"`
    * `git push heroku master`
    * `heroku ps:scale web=1`
8. Put the URLs for mainBot.php and adminBot.php in the correct URL
  callback fields: 
  * Run `heroku open mainBot.php`
  * Copy that URL into the mainBot URL callback field
  * Run `heroku open adminBot.php`
  * Copy that URL into the adminBot URL callback field

#### Installing on a Web Server

1. Download the files
2. Create a bot for the main groupme at https://dev.groupme.com/bots
  * select the desired group 
3. Copy the bot id and paste it into the $bot_token variable
in "mainBot.php".
4. Repeat steps 2 and 3, but for the admin bot (adminBot.php). 
5. Edit "config.xml" appropiately. See below for info regarding it. 
6. Upload the files to a web server.
7. Put the URLs for mainBot.php and adminBot.php in the correct URL
  callback fields
  * put "http://yoururl.com/path/to/bot/mainBot.php" in the mainBot 
  URL callback field
  * put "http://yoururl.com/path/to/bot/adminBot.php" in the adminBot 
  URL callback field

#### The Config File
Edit the config.xml file to your needs. 

* config attributes
  * league: the daddyleagues directory of your league 
  (example: league website is "http://daddyleagues.com/TSL", 
  use "TSL")
  * cmdprefix: what will preceed each command
  * pslimit: the maximum numberr of players a player 
  search will return
  * charlimit: If a message by the bot exceeds this, the bot will 
  send a link to get.php that will generate the message when visited
* info attributes
  * league: the name of the league
  * commish: the league's commisioner
  * rules: a link to the rules (or you could just put the 
  rules there)
  * owners: a link to the owner list (or you could just put 
  the owner list there)
  * advance: the next scheduled advance
  * draft: the next scheduled draft
  * botdev: I ask that you leave this setting as-is
* custom: this is for info you don't want in the info section for 
when someone asks for all info and also for custom commands that will
have more options in future versions of this bot
* rings: the list of people with Super Bowl victories and how many 
they have
* alias: all aliases - an alias is a command that executes another 
command
* twitch attributes
  * put the twitch user name for each team's owner 
* magic8ball: all the 8ball answers
* emoji: all the ermojis

---

### Using Commands

Notes: 
* everything is case-insensitive unlesss otherwise noted.
* parameters in brackets are optional.

#### Basic

##### Daddyleagues-Based Commands

* tl: Gets a link to the team on Daddyleagues
* ps [options]: performs a player search baseds on options 
  * options: all are optional
    * name: player name of the player
	* position: the position (qb, hb, wr, ...)
	* team: can be abbreviation or team name (ten or titans)
	* rookie: search only rookies (r or rookie)
	* injured: search only injured players (i or inj or injured)
	* not specifying any options will return the top players in the league
* tws team week: Returns the score for the specified tean and week
  * team: can be abbreviation or team name (ten or titans)
  * week: 1-17, wc, dr, cc, sb
* sync week: Gets the scores/schedule for a specified week
  * week: 1-17, wc, dr, cc, sb
* unplayed week: Gets the unplayed games for a specified week
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
  * if no key is specified, it returns all youtube info\
* rings [key]: Returns ring (Super Bowl wins) count based on the key
  * key: the player's game handle (psn name or xbox live name or just whatever 
  you call them)
  * if no key is specified, it returns a list of the people with rings in order
  of most to least
* custom [key]: Returns custom info based on the key 
  * key: a key that exists in the custoim portion of config.xml
  * if no key is specified, it returns all custom info
* 8ball [question]: returns one of the 20 magic 8-ball replies
* simscores [key]: Returns a simscore based on the key
  * key: a key that exists in the simscore portion of config.xml
  * if no key is specified, it returns all simscore keys sorted high to low
* emoji [key]: Returns an emoji based on the key 
  * key: a key that exists in the emoji portion of config.xml
  * if no key is specified, it returns all emoji keys
* key: shorthand for "custom key", "info key", "img key", "youtube key", and 
"emoji key" 
  * searches in the following order:
    * custom
    * info
    * img
    * youtube
    * emoji
* help: returns a help message

#### Admin

* config [key]: Returns config info based on the key 
  * key: a key that exists in the config portion of config.xml
  * if no key is specified, it returns all config info. 
* set key1 key2 [value]: sets the value of an attribute
  * key1: options:
    * config
	* info
	* img
	* rings
	* custom
	* emoji
	* youtube
	* twitch
	* alias**
  * key2: an  existing or new attribute in the key1 portion of config.xml
  * value: case-sensitive. the value. if not specified, key2 is delted from key1
  
\*\*alias: you have the ability to add an alias to any command. For example, 
"advance" is stored in the "info" portion of the xml. To display it, you can 
send "?info advance" or just "?advance" normall (and assuming "?" is the prefix.
But maybe you want to be able to just send "?adv" or "?sim" instead. You can set 
it up that way! In the chat with the admin bot, just send "?set alias adv info 
advance" or "?set alias adv advance", either way will work. 

---

My next task is to refactor some of the code and add the ability to register users 
and user groups. 

---

## LICENSE

This bot is being made available under the MIT License as found in the 
repository.

If you use it in your own project, please let me know. While you are not 
required to let me know you are using it, I think it would be cool to 
see what others are using it for. 
