<?php
ob_start();
session_start();
//echo "hi";exit;
class emirror_config
{


public $dbhost="localhost";
public $dbuser="vdevserv_root";
public $dbpass="Varna123";
public $dbname="vdevserv_emirror";


//public $dbhost="localhost";
//public $dbuser="root";
//public $dbpass="";
//public $dbname="emirror";

public $cn;
}
define(SITE_HOST,"http://".$_SERVER['HTTP_HOST']."/");
define(SITE_ROOT,$_SERVER['DOCUMENT_ROOT']."/stage/");
define(MEDIA_ROOT,SITE_HOST."media/");
define(IMG_ROOT,MEDIA_ROOT."images/");
define(TRIGGER_ROOT,MEDIA_ROOT."trigger_files/");
define(UTILS_ROOT,SITE_HOST."utils/");
define(SCRIPTS_ROOT,UTILS_ROOT."scripts/");
define(STYLES_ROOT,UTILS_ROOT."styles/");
$_SESSION['user_id']=1;
$_SESSION['user_id']="";
if($_SESSION['user_id'])
{
define(NO_SESSION,"<!-- ");
define(NO_SESSION_END," -->");
}
else
{
define(NO_SESSION,"");
define(NO_SESSION_END,"");

}
require_once('database.inc.php');
require_once('template.inc.php');
require_once('module.inc.php');
require_once('pagination1.php');
require_once('functions.inc.php');
require_once('phpgmailer/class.phpgmailer.php');
require_once('phpmailer/class.phpmailer.php');


?>