#!/usr/bin/php
<?php @ini_set('display_errors', 0); error_reporting(0); @ini_set('output_buffering', 'Off'); @ini_set('implicit_flush', 1); @ini_set('zlib.output_compression', 0); ob_implicit_flush(1); $cf = basename($_SERVER['SCRIPT_FILENAME']);

if(!empty($_GET['url'])){
     $url = urldecode($_GET['url']); 
    }
    elseif(!empty($argv[1])){ 
        $url = $argv[1]; 
    }else{
    system("clear");
         die("
\033[0;36m       __     
\033[0;36m    __(  )_   \033[1;97m\033[4;37mCloudFlare Bypass Hostname\e[0;0m \033[4;31mv2.2\e[0;0m
\033[0;36m __(       )_   \e[0;0mAuthor : zidansec (Chemod-77)
\033[0;36m(____________)  \e[0;0mContact: zidansec@gmail.com
                Sites  : https://zidan.xploit.my.id

\033[45m-------------------------------\e[0;0m[\e[0m\e[1;91m NOTES \e[0;0m]\033[45m---------------------------------------\e[0;0m

This tools can help you to see the real \033[1;97m\033[4;37mIP\e[0;0m behind \033[1;97m\033[4;37mCloudFlare\e[0;0m protected websites

    \033[1;91m❝\033[1;36m Not all websites with cloudflare WAF can be bypassed with this tool \033[1;91m❞

\033[1;92m    - \033[1;97mHow do I run it?\e[0;0m
\033[1;92m    - \033[1;97mCommand: \033[1;37m./$cf\e[0;0m \033[1;97mexemple.com\e[0;0m
         \n"); 
        }
        
$alert = "
\033[0;36m       __     
\033[0;36m    __(  )_   \033[1;97m\033[4;37mCloudFlare Bypass Hostname\e[0;0m \033[4;31mv2.2\e[0;0m
\033[0;36m __(       )_   \e[0;0mAuthor : zidansec (Chemod-77)
\033[0;36m(____________)  \e[0;0mContact: zidansec@gmail.com
                Sites  : https://zidan.xploit.my.id

\033[45m-------------------------------\e[0;0m[\e[0m\e[1;91m ALERT \e[0;0m]\033[45m---------------------------------------\e[0;0m

    \033[1;91m❝\033[1;36m Not all websites with cloudflare WAF can be bypassed with this tool \033[1;91m❞
";

system("clear");

echo "\033[1;92mScanning: \033[1;97m\033[4;37m".htmlspecialchars(addslashes($url))."\e[0;0m\n";

function showProgressBar($percentage, int $numDecimalPlaces)
{
    $percentageStringLength = 4;
    if ($numDecimalPlaces > 0)
    {
        $percentageStringLength += ($numDecimalPlaces + 1);
    }

    $percentageString = number_format($percentage, $numDecimalPlaces) . '%';
    $percentageString = str_pad($percentageString, $percentageStringLength, " ", STR_PAD_LEFT);

    $percentageStringLength += 3;

    $terminalWidth = `tput cols`;
    $barWidth = $terminalWidth - ($percentageStringLength) - 2;
    $numBars = round(($percentage) / 100 * ($barWidth));
    $numEmptyBars = $barWidth - $numBars;

    $barsString = '[' . str_repeat("\033[0;92m#\e[0;0m", ($numBars)) . str_repeat(" ", ($numEmptyBars)) . ']';

    echo "($percentageString) " . $barsString . "\r";
}

//$level = ob_get_level();
$total = '1000';
for ($i=0; $i<$total; $i++) 
{
    $percentage = $i / $total * 100;
    showProgressBar($percentage, 2); ob_end_flush();
} 

ob_start();

// Replace URL
$url = str_replace("www.", "", $url);
$url = str_replace("http://", "", $url);
$url = str_replace("https://", "", $url);
$url = str_replace("/", "", $url);

// sudo apt install php-curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://crimeflare.herokuapp.com/?url=".htmlspecialchars(addslashes($url)).""); // CrimeFlare API v2.1
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$exec = curl_exec($ch);
curl_close ($ch);

ob_end_flush(); sleep(2); system("clear");

$logo = "\033[0;92m  ______             __                          ________  __                               
 /      \           /  |                        /        |/  |                              
/$$$$$$  |  ______  $$/  _____  ____    ______  $$$$$$$$/ $$ |  ______    ______    ______  
$$ |  $$/  /      \ /  |/     \/    \  /      \ $$ |__    $$ | /      \  /      \  /      \ 
$$ |      /$$$$$$  |$$ |$$$$$$ $$$$  |/$$$$$$  |$$    |   $$ | $$$$$$  |/$$$$$$  |/$$$$$$  |
$$ |   __ $$ |  $$/ $$ |$$ | $$ | $$ |$$    $$ |$$$$$/    $$ | /    $$ |$$ |  $$/ $$    $$ |
$$ \__/  |$$ |      $$ |$$ | $$ | $$ |$$$$$$$$/ $$ |      $$ |/$$$$$$$ |$$ |      $$$$$$$$/ 
$$    $$/ $$ |      $$ |$$ | $$ | $$ |$$       |$$ |      $$ |$$    $$ |$$ |      $$       |
 $$$$$$/  $$/       $$/ $$/  $$/  $$/  $$$$$$$/ $$/       $$/  $$$$$$$/ $$/        $$$$$$$/ \e[0;0m \033[4;31mv2.2\e[0;0m
";

if(!empty($exec)) {
    $cloudflare = gethostbyname(htmlspecialchars(addslashes($url)));
    preg_match('/(\d*\.\d*\.\d*\.\d*)/s', $exec, $ip); // Regex Real IP CloudFlare
    if(empty($ip[1])){
        exit("$alert
\033[1;92m    -\e[0;0m Unable to detect \033[1;97mIP\e[0;0m address from (\033[1;97m\033[4;37m".htmlspecialchars(addslashes($url))."\e[0;0m)
        \n"); 
    }

    $data = json_decode(file_get_contents("http://ip-api.com/json/".$ip[1]."?fields=status,message,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,query")); $token = "51a986ffa5ddb1"; $get = json_decode(file_get_contents("http://ipinfo.io/$ip[1]/json?token=$token")); $host = file_get_contents("https://get.geojs.io/v1/dns/ptr/$ip[1]"); $host = str_replace("\n", "", $host); $host = str_replace("Failed to get PTR record", "\e[0;0m\033[4;31mNot detected\e[0;0m", $host); $dns = dns_get_record( $url, DNS_NS); $ns1 = $dns[0]['target']; $ns2 = $dns[1]['target'];
    $geo = json_decode(file_get_contents("https://get.geojs.io/v1/ip/country/".$ip[1].".json"));


    print_r ("$logo
        Website Target  : $url
        CloudFlare IP   : $cloudflare
        CloudFlare NS1  : $ns1
        CloudFlare NS2  : $ns2
        \033[1;92m--------------------------------------------------------------------------------\e[0;0m
        Real IP Address : $get->ip
        Hostname        : $host
        Company         : $data->org
        Country         : $geo->name
        Address         : $get->country, $get->city, $get->region
        Location        : $get->loc
        Time Zone       : $get->timezone
        \n");
    } else {
        echo "$alert
\033[1;92m    -\e[0;0m \e[0;0m\033[4;31mThere seems to be a problem with your network!\e[0;0m\n
        \n";
    }

ob_flush(); flush();

?>
