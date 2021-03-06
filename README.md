# postnl-rest-api
Client for the PostNL Rest API


## Attention!
Currently this project is stalled as no access to the PostNL is currently available to us.\
Sorry for the inconvenience 


## Installation
```
composer require 123lens/postnl-rest-api-client
```

## Client initialization:
```php
use Budgetlens\PostNLApi\RestApiClient;
$client = new RestApiClient('---  YOUR APIKEY ---');
```

## Testing
```php
./vendor/bin/phpunit 
```

## Examples
`See tests folder`


## Implementation Status
This library is still in development. After an endpoint implementation is finished a new (sub)version will be 
released. \
Meaning of **Is finished:**:
- All available services for endpoint are completed
- unit tests are available

## Current Development State
|Service | Version | Implemented
|---|---|---
|**Addresses** [More info](https://developer.postnl.nl/browse-apis/addresses/)||
| [Adrescheck Nationaal](#Adrescheck-Nationaal)             | v1 | &#9745;
| [Adrescheck Internationaal](#Adrescheck-Internationaal)   | v1 | &#9745;
| [Geo Adrescheck Nationaal](#Geo-Adrescheck-Nationaal)     | v1 | &#9745;
| [Adrescheck Basis Nationaal](#Adrescheck-Basis-Nationaal) | v1 | &#9745;
|**Send and Track** [More info](https://developer.postnl.nl/browse-apis/send-and-track/)||
| [Shipping webservice](#Shipping-webservice)               | v1 | &#9745;
| [Barcode webservice](#Barcode-webservice)                 | v1 | &#9745;
| [Labelling webservice](#Labelling-webservice)             | v1 | &#9745;
| [Confirming webservice](#Confirming-webservice)           | v1 | &#9745;
| [Shippingstatus webservice](#Shippingstatus-webservice)   | v1 | &#9745;
|**Delivery Options** [More info](https://developer.postnl.nl/browse-apis/delivery-options/)||
| [Deliverydate webservice](#Deliverydate-webservice)       | v1 | &#9745;
| [Location webservice](#Location-webservice)               | v1 | &#9745;
| [Timeframe webservice](#Timeframe-webservice)             | v1 | &#9745;
|**Checkout** [More info](https://developer.postnl.nl/browse-apis/checkout/)
| [Checkout Postalcode Check](#Checkout-Postalcode-Check)   | v1 | &#9745;
| [Checkout API](#Checkout-API)                             | v1 | &#9745;
|**Customer Overview** [More info](https://developer.postnl.nl/browse-apis/customer-overview/)
| [Bedrijfscheck Nationaal](#Bedrijfscheck-Nationaal)       | v1 | &#9745;

## Endpoint/Service specific

### Adrescheck Nationaal
**No contract for this service, tests not 100%!** 

Base endpoint: /address/national

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v1/validate/ | v1 | &#9745;| &#9745;


### Adrescheck Internationaal
**No contract for this service, tests not 100%!**

Base endpoint: /address/international

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v1/labelformat | v1 | &#9744;| &#9744;
| /v1/validate | v1 | &#9745;| &#9745;

### Geo Adrescheck Nationaal
**No contract for this service, tests not 100%!**

Base endoint: /address/national

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v1/geocode | v1 | &#9745;| &#9745;

### Adrescheck Basis Nationaal
**No contract for this service, tests not 100%!**

Base endoint: /address/sequence 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v1/postalcode | v1 | &#9745;| &#9745;

### Shipping webservice
Base endoint: / 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v1/shipment | v1 | &#9745;| &#9745;


### Barcode webservice
Base endoint: /shipment/v1_1 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /barcode | v1_1 | &#9745;| &#9745;

### Labelling webservice
Base endoint: /shipment/v2_2 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /label | v2_2 | &#9745;| &#9745;

### Confirming webservice
Base endoint: /shipment/v2 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /confirm | v2 | &#9745;| &#9745;

### Shippingstatus webservice
Base endoint: /shipment 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v2/status/barcode                            | v2 | &#9745;| &#9745;
| /v2/status/reference                          | v2 | &#9745;| &#9745;
| /v2/status/lookup                             | v2 | &#9745;| &#9745;
| /v2/status/signature                          | v2 | &#9745;| &#9745;
| /v2/status/{customerNumber}/updatedshipments  | v2 | &#9745;| &#9745;

### Deliverydate webservice
Base endoint: /shipment 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v2_2/calculate/date/delivery | v2_2 | &#9745;| &#9745;
| /v2_2/calculate/date/shipping | v2_2 | &#9745;| &#9745;

### Location webservice
Base endoint: /shipment 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v2_1/locations/nearest           | v2_1 | &#9745;| &#9745;
| /v2_1/locations/nearest/geocode   | v2_1 | &#9745;| &#9745;
| /v2_1/locations/area              | v2_1 | &#9745;| &#9745;
| /v2_1/locations/lookup            | v2_1 | &#9745;| &#9745;

### Timeframe webservice
Base endoint: /shipment/v2_1 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /calculate/timeframes |  v2_1 | &#9745;| &#9745;

### Checkout Postalcode Check
Base endoint: /shipment/checkout 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v1/postalcodecheck/ |  v1 | &#9745;| &#9745;

### Checkout API
Base endoint: /shipment/v1 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /checkout |  v1 | &#9745;| &#9745;

### Bedrijfscheck Nationaal
**No contract for this service, tests not 100%!**

Base endoint: /company/search 

|Endpoint|Version|Implemented|Tested
|---|---|---|---
| /v3/phonenumber/ |  v3 | &#9745;| &#9745;
