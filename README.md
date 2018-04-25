# Impala API PHP SDK
[![CircleCI](https://circleci.com/gh/GetImpala/impala-php.svg?style=svg)](https://circleci.com/gh/GetImpala/impala-php)
[![Maintainability](https://api.codeclimate.com/v1/badges/94b4737a43d9fddca5c4/maintainability)](https://codeclimate.com/github/GetImpala/impala-php/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/94b4737a43d9fddca5c4/test_coverage)](https://codeclimate.com/github/GetImpala/impala-php/test_coverage)

## Installation

It's as simple as:

```bash
$ composer require get-impala/impala-php
```

## Tests

To run the tests you can run the following command:

```bash
$ ./vendor/bin/phpunit
```

## Obtaining an API key

To use this library, you will need an Impala API key. More information can be
found in the ['Getting Started'][getting-started] section of the Impala developer documentation.

## Getting Started

After installation, you can instantiate the library using its factory class:

```php
require_once __DIR__ . '/vendor/autoload.php';

use Impala\ImpalaFactory;

$impala = ImpalaFactory::create(<api-key>);
```

### Working with a single hotel

If your application will only be dealing with a single hotel at a time,
you can instantiate the Impala API like this:

```php
$hapiHotel = ImpalaFactory::create('secret', 'hapi');
```

### Working with multiple hotels

If your application will be dealing with multiple hotels, you can omit the `hotelId`
parameter, like so:

```php
$impala = ImpalaFactory::create('secret');

// You can then pass the hotelId directly to the method
$impala->getBookings(['hotelId' => 'hapi']);

// Or with extra parameters
$impala->getBookings([
    'hotelId' => 'hapi',
    'startDate' => '2018-02-03',
    'endDate' => '2018-02-05',
]);

// Or, you can call getHotel to return a single-hotel API instance
$hapiHotel = $impala->getHotel('hapi')

// You can then call the API methods like normal
$hapiHotel->getBookings();
```

## Making API calls

API methods accept an associative array as their first argument, containing the parameters for the API call. This can be omitted if there are no arguments to set.

API methods that take an ID have the ID as the first argument.

API methods that update a resource take the array representation of a [JSON merge patch](https://tools.ietf.org/html/rfc7386) as their second argument. 

For example:

```php
use Impala\ImpalaFactory;

$hapiHotel = ImpalaFactory::create('secret', 'hapi')

$hapiHotel->getBookings([
    'startDate' => '2018-02-03',
    'endDate' => '2018-02-05',
]);

$hapiHotel->getBookingById('c4be6570-15fc-4926-b339-446db4800f81');
```

## API methods

| Name                     | HTTP API endpoint                                                             |
|:-------------------------|:------------------------------------------------------------------------------|
| `getBookingById`         | [`GET /v1/hotel/:hotelId/booking/:bookingId`][type-booking]                   |
| `getBookings`            | [`GET /v1/hotel/:hotelId/booking`][type-booking]                              |
| `updateBookingById`      | [`PATCH /v1/hotel/:hotelId/booking/:bookingId`][type-booking]                 |
| `getGuestById`           | [`GET /v1/hotel/:hotelId/guest/:guestId`][type-guest]                         |
| `getGuests`              | [`GET /v1/hotel/:hotelId/guest`][type-guest]                                  |
| `getRateById`            | [`GET /v1/hotel/:hotelId/rate/:rateId`][type-rate]                            |
| `getRatePlanById`        | [`GET /v1/hotel/:hotelId/rate-plan/:ratePlanId`][type-rateplan]               |
| `getRatePlans`           | [`GET /v1/hotel/:hotelId/rate-plan`][type-rateplan]                           |
| `getRatePrices`          | [`GET /v1/hotel/:hotelId/rate/:rateId/price`][type-rateprice]                 |
| `getRatePrices`          | [`GET /v1/hotel/:hotelId/rate/price`][type-rateprice]                         |
| `getRates`               | [`GET /v1/hotel/:hotelId/rate`][type-rate]                                    |
| `getRoomAvailabilities`  | [`GET /v1/hotel/:hotelId/room/:roomId/availability`][type-roomavailability]   |
| `getRoomAvailabilities`  | [`GET /v1/hotel/:hotelId/room/availability`][type-roomavailability]           |
| `getRoomById`            | [`GET /v1/hotel/:hotelId/room/:roomId`][type-room]                            |
| `getRoomTypeAvailabilities` | [`GET /v1/hotel/:hotelId/room-type/:roomTypeId/availability`][type-roomtypeavailability] |
| `getRoomTypeAvailabilities` | [`GET /v1/hotel/:hotelId/room-type/availability`][type-roomtypeavailability]             |
| `getRoomTypeById`        | [`GET /v1/hotel/:hotelId/room-type/:roomTypeId`][type-roomtype]               |
| `getRoomTypes`           | [`GET /v1/hotel/:hotelId/room-type`][type-roomtype]                           |
| `getRooms`               | [`GET /v1/hotel/:hotelId/room`][type-room]                                    |

[getting-started]: https://docs.getimpala.com/#getting-started
[type-booking]: https://docs.getimpala.com/#booking
[type-guest]: https://docs.getimpala.com/#guest
[type-room]: https://docs.getimpala.com/#room
[type-roomtype]: https://docs.getimpala.com/#room-type
[type-roomavailability]: https://docs.getimpala.com/#room-availability
[type-roomtypeavailability]: https://docs.getimpala.com/#room-type-availability
[type-rate]: https://docs.getimpala.com/#rate
[type-rateplan]: https://docs.getimpala.com/#rate-plan
[type-rateprice]: https://docs.getimpala.com/#rate-price
