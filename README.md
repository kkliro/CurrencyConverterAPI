# Currency Converter API
**Authors: Konstantin Klironomos & Dante Lo Monaco**

Conversion Co.’s _Currency Converter API_ is a simple API that allows clients to convert amounts of certain currencies into a foreign currency. Using various tools and technologies, the Currency Converter API is able to authenticate users based on JWT tokens, convert money based on an original and a target currency, and display the flag of the countries involved with AWS S3. The API utilizes HTTP requests and responses to communicate resources and handles the responses based on the HTTP verbs and headers passed in the request.

# Project Structure

```
CurrencyConversionAPI
│   README.md (Instructions)
|   Documentation.yaml (API Documentation)
|   LICENSE (License Agreement)
│	
└───CurrencyConversionService
│   └───API
|	| .htaccess
|	| Request.php
|	| Response.php
|	| index.php
│   └───CDN
|	└───Images (Country Flags)
|	└───vendor (Composer Dependencies)
|	| AWSHandler.php (AWS Communication)
|	| composer.json
|	| composer.lock
│   └───Controllers
|	| AuthenticationController.php
|	| ClientController.php
|	| ConversionController.php
|   └───Database
|	| ConnectionManager.php
|	| config.xml
|	| currencyconversiondb.sql
|   └───Logs
|	| LogHandler.php
|	| api-logs.log
|	| desktop.ini
|   └───Models
|	| Client.php
|	| Conversion.php
│   └───Token
│       │ jwt.php
```

## Requirements

- PHP 8.0 or later

## Installation

You can install AWS SDK via  [Composer](http://getcomposer.org/).
```
composer require composer require aws/aws-sdk-php
```

## Deployment

1. Download the project's .zip
2. Copy the files into the server directory
3. Upload the database file (CurrencyConverterAPI/CurrencyConversionService/Database/currencyconversiondb.sql) to your database server
4. In CurrencyConverterAPI/CurrencyConversionService/CDN, add the following XML file **(name it aws-config.xml)**: 
```xml
<?xml version="1.0"?>  
<awsconnection> 
	<key>AWS_KEY</key>  
	<secret>AWS_SECRET_KEY</secret>  
	<bucket>AWS_BUCKET</bucket>  
</awsconnection>
```
5. Run your server (either localhost or cloud)

## Recommendations

If you do not want to use this service as a cloud application, you can mount it locally using [XAMPP](apachefriends.org/index.html).

## External Sources

[Exchange Rate API](https://exchangeratesapi.io/)
