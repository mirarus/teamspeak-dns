# teamspeak-dns
 TeamSpeak Short DNS Service API


composer require mirarus/teamspeak-dns



require "vendor/autoload.php";

use Mirarus\TeamSpeakDNS\Authorization;
use Mirarus\TeamSpeakDNS\Dns;

$authorization = new Authorization("--email--", "--password--"); 

$dns = new Dns($authorization);

print_r($dns->list());
