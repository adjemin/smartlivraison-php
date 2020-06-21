# Smart Livraison PHP

[![Latest Stable Version](https://poser.pugx.org/adjemin/smartlivraison-php/v)](//packagist.org/packages/adjemin/smartlivraison-php) [![Total Downloads](https://poser.pugx.org/adjemin/smartlivraison-php/downloads)](//packagist.org/packages/adjemin/smartlivraison-php) [![Latest Unstable Version](https://poser.pugx.org/adjemin/smartlivraison-php/v/unstable)](//packagist.org/packages/adjemin/smartlivraison-php) [![License](https://poser.pugx.org/adjemin/smartlivraison-php/license)](//packagist.org/packages/adjemin/smartlivraison-php)

The Smart Livraison PHP library provides convenient access to the Smart Livraison API from
applications written in the PHP language. It includes a pre-defined set of
classes for API resources that initialize themselves dynamically from API
responses which makes it compatible with a wide range of versions of the Smart Livraison API

## Requirements

PHP 5.6.0 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require adjemin/smartlivraison-php
```

## Getting Started

Simple usage looks like:

### Create Merchant Task and Assign to Delivery service

```php


$customer_name = "Ange Bagui"; 
$customer_phone = "+22501000000";
$customer_email = "";
$location_name = "Immeuble Maiko, Rue L84, 8ᵉ tranche, Caféier, Cocody, Abidjan, 28, Côte d'Ivoire";
$location_latitude = 5.396215700000001; 
$location_longitude = -3.9768630282901785; 
$order_id = "1ebf79e3-da47-4f73-aefc-9557afa22e33";
$order_description = "Savon 200g Catégorie: Beauté Quantité: 1";
$order_price = "2000";
$currency_code = "XOF";
$has_pickup = true;
$delivery_fees = "1500";

$job_datetime = "2020-07-15 11:35:51";

$images = ["https://i.imgur.com/UbFukAq.jpg"];
$description = "Ramassage ";

$pickup = SmartLivraison::paramJob(
    $customer_name, 
    $customer_phone,
    $customer_email,
    $location_name, 
    $location_latitude, 
    $location_longitude, 
    $order_id, 
    $order_description,
    $order_price,
    $currency_code,
    $has_pickup,
    $delivery_fees,
    $job_datetime ,
    $images,
    $description
);

$customer_name = "Ange Bagui"; 
$customer_phone = "+22501000000";
$customer_email = "";
$location_name = "Pharmacie du Bonheur, Rue I168, Riviéra Palmeraie, Les Palmeraies, Palmeraie, Cocody, Abidjan, BP 51 CIDEX 3 ABIDJAN, Côte d'Ivoire";
$location_latitude = 5.3695041; 
$location_longitude = -3.9590591; 
$order_id = "1ebf79e3-da47-4f73-aefc-9557afa22e33";
$order_description = "Savon 200g Catégorie: Beauté Quantité: 1";
$order_price = "2000";
$currency_code = "XOF";
$has_pickup = false;
$delivery_fees = "1500";
$job_delivery_datetime =  "2020-07-15 13:35:51";
$images = ["https://i.imgur.com/UbFukAq.jpg"];
$description = "Livraison ";

$delivery = SmartLivraison::paramJob(
    $customer_name, 
    $customer_phone,
    $customer_email,
    $location_name, 
    $location_latitude, 
    $location_longitude, 
    $order_id, 
    $order_description,
    $order_price,
    $currency_code,
    $has_pickup,
    $delivery_fees,
    $job_delivery_datetime,
    $images,
    $description
);

 $client_id = '11211111'; //Your CLIENT ID
 $client_secret = '10997210-b096-4dd7-b834-837856e4fe25'; //Your CLIENT SECRET
 $smartLivraison = new SmartLivraison($client_id, $client_secret);

 $merchant_id = "21121"; //Your merchant ID
 $merchant_notification_url = "http://example.com/sl_notify"; //Your merchant notification url

 $delivery_service_username = "adjemin"; // The username of the delivery service in Smart Livraison
 $customer_payment_method_code = "cash"; //cash or online
 $customer_paid = false; // if true so the customer will not paid at the delivery

/** var array $result */
$result = $smartLivraison->merchantCreateTask(
                            $merchant_id,
                            $pickup,
                            $delivery,
                            $delivery_service_username,
                            $customer_payment_method_code, 
                            $customer_paid,
                            $merchant_notification_url
                        );

```

