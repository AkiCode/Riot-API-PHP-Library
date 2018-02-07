<?php
/*
#########################################################################################
##Riot API PHP Class                                                                   ##
##Christian Skogstad | AkiCode.com                                                     ##
##                                                                                     ##
##This is a PHP Wrapper for Riot Games API, used to make efficient calls to their API. ##
##You need to provide your own Riot API code down below to make use of the script.     ##
#########################################################################################

To-Do List:
- Rework the URL building to clean up the code and make it more efficient and futureproof.
- Finish the rate limiting function to avoid bottlenecking the API.
- Build a function to handle information caching.
- Implement error handling.
- Add more calls.
*/

class RiotApi
{
    // Enter your API key here, the API key can be found at Riot Games developer site.
    const API_KEY = 'REPLACE_WITH_YOUR_API_KEY';
    
    // Rate limit settings (Not yet implemented)
    //$request_limit = 3; // Max ammount of requests within the time limit.
    //$request_timer = 30; // Time limit in seconds
    
    // List of Riot API urls for calls
    const API_SUMMONER_V3 = 'https://{region}.api.riotgames.com/lol/summoner/v3/summoners';
    
    // Properties
    private $region;
    
    
    /*
    Error Handling Here (SoonTM)
    */
    
     public function __construct($region){
            $this->region = $region;
    }
    
    public function getSummonerByAccountId($accountId){
            $callUrl = self::API_SUMMONER_V3 . "/by-account/" . $accountId;
            return $this->request($callUrl);
    }
    
    public function getSummonerByName($summonerName){
            $callUrl = self::API_SUMMONER_V3 . "/by-name/" . rawurlencode($summonerName);
            return $this->request($callUrl);
    }
    
    public function getSummonerById($summonerId){
            $callUrl = self::API_SUMMONER_V3 . "/" . $summonerId;
            return $this->request($callUrl);
    }
    
    private function request($callUrl){
            $requestUrl = $this->format_url($callUrl);
            
            // Initiating cURL request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $requestUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Riot-Token: ' . self::API_KEY));
            
            $returnValue = curl_exec($ch);
            curl_close($ch);
            
            // Convert JSON result into array
            $returnValue = json_decode($returnValue, true);
            return $returnValue;
    }
    
    private function format_url($callUrl){
            return str_replace('{region}', $this->region, $callUrl);
    }
}
