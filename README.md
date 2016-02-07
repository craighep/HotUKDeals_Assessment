# HotUKDeals_Assessment
Assessment repo for HomeGroup. Acts as a JSON API for retrieving and comparing Argos Hot UK Deals with BestBuy.
----------------
CURRENT STATUS:
-The current status of the API allows the user to retrieve top Argos deals from HotUKDeals, and organsises them by the price difference of the product between Argos and BestBuy (Largest first).
-Currently unable to search properly using the information gained from HotUKDeals API (difficult to search with regex, and with no product codes etc.)
-Links to Argos products may fail, though this is the fault of the HotUKDeals site, as they have the same problem due to users inputting incorrect links.

-----------------
APPLICATION USAGE:
-Please upload the files to any server running PHP (Latest version is preferable e.g. 7).
-Alternatively, upload the files toa  local server running PHP.
-Extra: The application is live at http://craighep.co.uk/argos/

-----------------
API USAGE:

To call API and return a JSON array of top 10 products:
  http://craighep.co.uk/argos/api/getHottestDeals.php?action=argosDeals
  
Where 'action=argosDeals' could be added to in the future for more specific sets of data.

A general response contains:
[
    {
        "title":"",
        "description":".",
        "price": 0.00,
        "dealLink":"",
        "productLink":"",
        "temperature": 0.00,
        "image":"",
        "altPrice": 0.00,
        "priceDifference": 0.00
   },
   ...
]
