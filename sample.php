<?php
// Include Library and create new instance of RiotApi();
include('riot_api_connect.php');
$riotApi = new RiotApi('euw1');

// Set userdata Variables
$summonerName = "ENTER_A_SUMMONER_NAME";

// Retrieve summoner data by name
$summoner = $riotApi->getSummonerByName($summonerName);
echo "<img src='http://ddragon.leagueoflegends.com/cdn/8.3.1/img/profileicon/". $summoner['profileIconId'] .".png' alt='Summoner Icon' width='60' height='auto'><br />  ";
echo "Summoner Name: " . $summoner['name'] . "<br/>";
echo "Summoner Level: " . $summoner['summonerLevel'] . "<br/>";
echo "Account ID: " . $summoner['accountId'] . "<br/><br/>";

// Fetch Summoner Mastery Information
$totalMastery = $riotApi->totalMasteryScore($summoner['id']);
$masteryEntries = $riotApi->championMasteryEntries($summoner['id']);
// Converting the champion ID into the champions name using the getStaticData function
$staticChamp = $riotApi->getStaticData('champions', null , $masteryEntries[0]['championId']);
echo "Total Mastery Score: " . $totalMastery . "<br />";
echo "Highest Mastery Champion: " . $staticChamp['name'] . "<br />";

echo "<hr>";

// League Status Information
$status = $riotApi->getLeagueStatus();
echo "Server: " . $status['name'] . "<br/>";
echo "Game Status: " . $status['services'][0]['status'] . "<br/>";
echo "Store Status: " . $status['services'][1]['status'] . "<br/>";
echo "Client Status: " . $status['services'][3]['status'] . "<br/>";
echo "Website Status: " . $status['services'][2]['status'] . "<br/><br/>";
