# Riot-API-PHP-Library
This is a PHP Library for Riot Games API, used to make efficient calls to their API.

**To-Do List:**
- Rework the URL building to clean up the code and make it more efficient and futureproof.
- Finish the rate limiting function to avoid bottlenecking the API.
- Build a function to handle information caching.
- Implement error handling.
- Add more calls.

**How-to Use:**
1. Set your API key
2. Include the library in your project like this: `include('riot_api_connect.php');`
3. Make a new instance of the RiotApi Class. Example: `$test = new RiotApi('Example Region: euw1');`

**Now you are ready to go.**

# Functions

**Summoner-V3 Functions**
   

    // Get a summoner by account ID
    getSummonerByAccountId($accountId);
    
    // Get a summoner by summoner name
    getSummonerByName($summonerName);
    
    // Get a summoner by summoner ID
    getSummonerById($summonerId);

**League-Status-V3**

    // Get League Status Information
    getLeagueStatus();

**Champion-Mastery-V3**

    // Get a player's total champion mastery score, which is the sum of individual champion mastery levels.
    totalMasteryScore($summonerId);
    
    // Get all champion mastery entries sorted by number of champion points descending
    championMasteryEntries($summonerId);
    
    // Get a player's total champion mastery score, which is the sum of individual champion mastery levels.
    getChampionMastery($summonerId, $championId);

**LOL-Static-Data-V3**

    // Get any static data
    // $type = the type of data you want
    // $locale = the language you want the data presented in
    // $id = specific id of item/champion, if you want everything then leave it as null.
    getStaticData($type, $locale = null, $id = null);
