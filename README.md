# Jela svijeta

Application that returns list of recipes based of the request parameters.
___

## How to use the app

After the initial setup of the app, seed the databse.

#### Request parameters
* #### lang 
  * (?lang=en/fr/de) - specifies language in which data will be returned.
  * Possible options are as listed above (en - English, fr - French, de - German).
  * lang is not required because of the fallback to en.
* #### page 
  * (?page=3) - defines the page (3) that will be returned.
* #### per_page
  * (?per_page=7) - defines the number of recipes that will be returned per page (7).
* #### tags
  * (?tags=2,5,7) - returns recipes that have tags with specified 'ids' (2,5,7).
  * it will filter integers out which means request with (?tags=a,2,,4) will return recipes that have tags with 'ids' 2 and 4.
* #### categories
  * (?categories=1,3) - returns recipes that have tags with specified 'ids' (1,3).
  * valid parameter here is also null which will return recipes without categories (?categories=null).
* #### diff_time
  * (?diff_time=1676000000) - returns recipes (also deleted ones) that are created, updated or deleted after requested unix time (1676000000 =  Friday, 10th February 2023 3:33:20).
* #### with
  * Specifies which additional data to be returned.
  * Possible options are tags, categories, ingredients and of course their combinations.
  * examples: ?with=tags | ?with=categories,ingredients | ?with=categories,tags,ingredients...
___

### Notes
* There are total of two pages (required index page and a show page for each recipe).
* Basic FE was also added.