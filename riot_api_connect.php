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
    const API_LOL_STATUS_V3 = 'https://{region}.api.riotgames.com/lol/status/v3/shard-data';
    const API_CHAMPION_MASTERY_V3 = 'https://{region}.api.riotgames.com/lol/champion-mastery/v3';
    const API_STATIC_DATA_V3 = 'https://{region}.api.riotgames.com/lol/static-data/v3/';
    const API_CHAMPION_V3 = 'https://{region}.api.riotgames.com/lol/platform/v3/champions';
    
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
    
    public function getLeagueStatus(){
            $callUrl = self::API_LOL_STATUS_V3;
            return $this->request($callUrl);
    }
    
    public function championMasteryEntries($summonerId){
            $callUrl = self::API_CHAMPION_MASTERY_V3 . "/champion-masteries/by-summoner/" . $summonerId;
            return $this->request($callUrl);
    }
    
    public function getChampionMastery($summonerId, $championId){
            $callUrl = self::API_CHAMPION_MASTERY_V3 . "/champion-masteries/by-summoner/" . $summonerId . "/by-champion/" . $championId;
            return $this->request($callUrl);
    }
    
    public function totalMasteryScore($summonerId){
            $callUrl = self::API_CHAMPION_MASTERY_V3 . "/scores/by-summoner/" . $summonerId;
            return $this->request($callUrl);
    }
    
    public function getStaticData($type, $locale = null, $id = null){
            $callUrl = self::API_STATIC_DATA_V3 . $type;
            
            if($id != null){
                $callUrl.= "/" . $id;
            }
            
            if($locale != null){
                $callUrl.= "?locale=" . $locale;
            }

            return $this->request($callUrl);
    }
    
    public function getChampionData($freeToPlay = false){
            $callUrl = self::API_CHAMPION_V3;
            
            if($freeToPlay == true){
                $callUrl.= "?freeToPlay=true";
            }
            
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
