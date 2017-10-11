# GoogleSheetsToXML
## The easiest way to transform the tabs of your Google spreadsheet into an XML file.

Many applications use XML as a way to collect content in an organized and simple way. The format is readable for humans and various types of programming languages.

What I created was a way to update this XML file in real time using Google Spreadsheets. Nothing simpler than filling a table and having your data ready to be accessed by systems on the web.

### Requirements for everything to work well

* Server with PHP above 5.5
* Google worksheet shared with public. Read only for those who have the link.

### To use it is very easy:

* Download GoogleSheetsToXML and put it on your server.
* Add your API Key and API Project Name. You get this data in the Google Sheets APIs console.
* Set the range of your worksheet

### Now, we just need to change a few lines:
* Open the GoogleSheetsToXML.class.php file
* You need to change a few lines in the beginning of the file for the system to be able to communicate with Google.

```php
define( "API_KEY","HERE-YOUR-GOOGLE-API-CONSOLE-KEY" );
define( "API_NAME","HERE-THE-NAME-OF-YOUR-API-PROJECT" );
```

Now let's put the ID of your spreadsheet. To find this ID just go to your worksheet and pick up the URL itself.
Example: https://docs.google.com/spreadsheets/d/ **1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms** /edit

```php
define( "ID_SPREADSHEET","HERE-THE-ID-OF-SPREADSHEET" );
```

To conclude, let's define the range in the table to work with. This interval is defined by the concept A1.

```php
define( "RANGE_SPREADSHEET","A:E" );
```

In the above code I'm asking for all values ​​between column A and column E.


### Ready! :+1: Now just call the library and tell which tab (or page) of the spreadsheet you want the data.

```php
<?php
include_once( "GoogleSheetsToXML.class.php" );
$example = new GoogleSheetsToXML();
$example->generateXML( "NAME-OF-YOUR-TAB" );
```

### Attention to an important detail:

**The first line of the spreadsheet in Google has to contain the title of the column** you are going to list in the XML. Example name, phone, email, etc. This title will be the tag in the XML.

### What is the best way to use the library?

You can create several PHP files and in each of them call one of the tabs of the spreadsheet in Google. Let's assume you need to know the data from a spreadsheet with 3 tabs. A worksheet calls Clients, the other Suppliers, and the other schedule.

To collect data from the Suppliers tab is very simple:

```php
<?php
include_once( "GoogleSheetsToXML.class.php" );
$example = new GoogleSheetsToXML();
$example->generateXML( "Suppliers" );
```
This example will return a PHP file with the headers stating that it is data organized as valid XML.

I hope it is useful in your project !!
Enjoy it. :+1:



