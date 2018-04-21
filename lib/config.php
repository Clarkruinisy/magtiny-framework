<?php

/**
 * Magtiny default config parameters. Please do not modify the data here.
 * If you want to modify framework config parameters. Please modify the app config file.
 * App config file parameter will override the default parameters here.
 * The "magtinyExceptions" parameter should not be modified.
 */

return [
	"debug"					=> false,
	"reportRunningStatus"	=> false,
	"crossDomain"			=> false,
	"domainName"			=> "*",
	"contentType"			=> "text/html",
	"charset"				=> "utf-8",
	"applicationPath"		=> "app",
	"safeFiltersFuncs"		=> ['trim', 'htmlentities'],
	"errorIgnoreMessage"	=> "System running error, please contact administrator!",
	"errorTempateMessage"	=> "Error!\r\nInformation: {{message}}.\r\nFile: {{file}}({{line}}).",
	"routerParseFrom"		=> "PATH_INFO",
	"routerDirName"			=> "controller",
	"defaultRouter"			=> "/index/index",
	"sessionAutoStart"		=> false,
	"sessionUse"			=> "cookie",
	"sessionKey"			=> "PHPSESSID",
	"viewDirName"			=> "view",
	"viewExtension"			=> "html",
	"viewIncludeRegular"	=> "/<include\s{1}name=\".+?\"><\/include>/",
	"viewInlcudePattern"	=> "/\".+?\"/",
	"magtinyExceptions"		=> [
		100			=> "The config file does not exist.",
		101			=> "Config parameters do not exist in config file.",
		102			=> "The template variable format is incorrect",
		103			=> "The safe filter function is incorrect.",
		104			=> "Super global variables do not exist.",
		105			=> "PDO Model-driven methods do not exist.",
		106			=> "The default routing data config is incorrect.",
		107			=> "The routing request controller does not exist.",
		108			=> "The routing request method does not exist.",
		109			=> "View template file does not exist.",
		110			=> "Session has already started.",
		111			=> "Session has not started yet.",
	],
	"services"				=> []
];

