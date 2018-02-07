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

**Output**

    $someArray['profileIconId']
    $someArray['name']
    $someArray['summonerLevel']
    $someArray['revisionDate']
    $someArray['id']
    $someArray['accountId']
