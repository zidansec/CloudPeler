#!/usr/bin/php
<?php @ini_set('display_errors', 0); error_reporting(0);

if(!empty($_GET['url'])){
     $url = urldecode($_GET['url']); 
    }
    elseif(!empty($argv[1])){ 
        $url = $argv[1]; 
    }else{
    system("clear");
         die("
\033[0;36m       __     
\033[0;36m    __(  )_   \033[1;97m\033[4;37mCloudFlare Bypass Hostname\e[0;0m \033[4;31mv2.1\e[0;0m
\033[0;36m __(       )_   \e[0;0mAuthor : zidansec (Chemod-77)
\033[0;36m(____________)  \e[0;0mContact: zidansec@gmail.com
                Sites  : https://zidan.xploit.my.id

\033[45m-------------------------------\e[0;0m[\e[0m\e[1;91m NOTES \e[0;0m]\033[45m---------------------------------------\e[0;0m

This tools can help you to see the real \033[1;97m\033[4;37mIP\e[0;0m behind \033[1;97m\033[4;37mCloudFlare\e[0;0m protected websites

    \033[1;91m❝\033[1;36m Not all websites with cloudflare WAF can be bypassed with this tool \033[1;91m❞

\033[1;92m    - \033[1;97mHow do I run it?\e[0;0m
\033[1;92m    - \033[1;97mCommand: php crimeflare.php exemple.com\e[0;0m
         \n"); 
        }

echo "
\033[0;36m Loading...

\033[1;92m   Scanning: \033[1;97m\033[4;37m".htmlspecialchars(addslashes($url))."\e[0;0m
\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://crimeflare.herokuapp.com/?url=".htmlspecialchars(addslashes($url)).""); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$exec = curl_exec($ch);
curl_close ($ch);

$alert = "
\033[0;36m       __     
\033[0;36m    __(  )_   \033[1;97m\033[4;37mCloudFlare Bypass Hostname\e[0;0m \033[4;31mv2.1\e[0;0m
\033[0;36m __(       )_   \e[0;0mAuthor : zidansec (Chemod-77)
\033[0;36m(____________)  \e[0;0mContact: zidansec@gmail.com
                Sites  : https://zidan.xploit.my.id

\033[45m-------------------------------\e[0;0m[\e[0m\e[1;91m ALERT \e[0;0m]\033[45m---------------------------------------\e[0;0m

    \033[1;91m❝\033[1;36m Not all websites with cloudflare WAF can be bypassed with this tool \033[1;91m❞
";

system("clear");

$logo = "\033[0;92m
  ______             __                          ________  __                               
 /      \           /  |                        /        |/  |                              
/$$$$$$  |  ______  $$/  _____  ____    ______  $$$$$$$$/ $$ |  ______    ______    ______  
$$ |  $$/  /      \ /  |/     \/    \  /      \ $$ |__    $$ | /      \  /      \  /      \ 
$$ |      /$$$$$$  |$$ |$$$$$$ $$$$  |/$$$$$$  |$$    |   $$ | $$$$$$  |/$$$$$$  |/$$$$$$  |
$$ |   __ $$ |  $$/ $$ |$$ | $$ | $$ |$$    $$ |$$$$$/    $$ | /    $$ |$$ |  $$/ $$    $$ |
$$ \__/  |$$ |      $$ |$$ | $$ | $$ |$$$$$$$$/ $$ |      $$ |/$$$$$$$ |$$ |      $$$$$$$$/ 
$$    $$/ $$ |      $$ |$$ | $$ | $$ |$$       |$$ |      $$ |$$    $$ |$$ |      $$       |
 $$$$$$/  $$/       $$/ $$/  $$/  $$/  $$$$$$$/ $$/       $$/  $$$$$$$/ $$/        $$$$$$$/ \e[0;0m \033[4;31mv2.1\e[0;0m
";

if(!empty($exec)) {
    $cloudflare = gethostbyname(htmlspecialchars(addslashes($url)));
    preg_match('/(\d*\.\d*\.\d*\.\d*)/', $exec, $ip);
    if(empty($ip[1])){
        exit("$alert
\033[1;92m    -\e[0;0m Unable to detect \033[1;97mIP\e[0;0m address from (\033[1;97m\033[4;37m".htmlspecialchars(addslashes($url))."\e[0;0m)
        \n"); 
    }
    $get = json_decode(file_get_contents("http://ipinfo.io/$ip[1]/json?token=51a986ffa5ddb1"));
    print_r ("$logo
        Website Target : $url
        CloudFlare IP  : $cloudflare
        \033[1;92m--------------------------------------------------------------------------------\e[0;0m
        Real IP        : $get->ip
        Hostname       : $get->hostname
        Organization   : $get->org
        City           : $get->city
        Country        : $get->country
        Postal Code    : $get->postal
        Location       : $get->loc
        Time Zone      : $get->timezone
        \n");
    } else {
        echo "$alert
\033[1;92m    -\e[0;0m \e[0;0m \033[4;31mThere seems to be a problem with your network!\e[0;0m\n
        \n";
    }
    
?>
