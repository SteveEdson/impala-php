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
| `getAllocationById`      | [`GET /v2/hotel/:hotelId/allocation/:allocationId`][type-allocation]          |
| `getAllocations`         | [`GET /v2/hotel/:hotelId/allocation`][type-allocation]                        |
| `getAreaById`            | [`GET /v2/hotel/:hotelId/area/:areaId`][type-area]                            |
| `getAreas`               | [`GET /v2/hotel/:hotelId/area`][type-area]                                    |
| `getAreaTypeById`        | [`GET /v2/hotel/:hotelId/area-type/:areaTypeId`][type-areatype]               |
| `getAreaTypes`           | [`GET /v2/hotel/:hotelId/area-type`][type-area-type]                          |
| `getBillById`            | [`GET /v2/hotel/:hotelId/bill/:billId`][type-bill]                            |
| `getChargeByIdForBill`   | [`GET /v2/hotel/:hotelId/bill/:billId/charge/:chargeId`][type-bill]           |
| `getChargesForBill`      | [`GET /v2/hotel/:hotelId/bill/:billId/charge`][type-bill]                     |
| `createChargeForBill`    | [`POST /v2/hotel/:hotelId/bill/:billId/charge`][type-bill]                    |
| `refundChargeByIdForBill`| [`POST /v2/hotel/:hotelId/bill/:billId/charge/:chargeId/refund`][type-bill]   |
| `getPaymentByIdForBill`  | [`GET /v2/hotel/:hotelId/bill/:billId/payment/:paymentId`][type-bill]         |
| `getPaymentsForBill`     | [`GET /v2/hotel/:hotelId/bill/:billId/payment`][type-bill]                    |
| `createPaymentForBill`   | [`POST /v2/hotel/:hotelId/bill/:billId/payment`][type-bill]                   |
| `refundPaymentByIdForBill`| [`POST /v2/hotel/:hotelId/bill/:billId/payment/:paymentId/refund`][type-bill]|
| `getBookingById`         | [`GET /v2/hotel/:hotelId/booking/:bookingId`][type-booking]                   |
| `getBookings`            | [`GET /v2/hotel/:hotelId/booking`][type-booking]                              |
| `createBooking`          | [`POST /v2/hotel/:hotelId/booking`][type-booking]                             |
| `updateBookingById`      | [`PATCH /v2/hotel/:hotelId/booking/:bookingId`][type-booking]                 |
| `checkInBookingById`     | [`POST /v2/hotel/:hotelId/booking/:bookingId/check-in`][type-booking]         |
| `checkOutBookingById`    | [`POST /v2/hotel/:hotelId/booking/:bookingId/check-out`][type-booking]        |
| `cancelBookingById`      | [`POST /v2/hotel/:hotelId/booking/:bookingId/cancel`][type-booking]           |
| `getGuestsForBooking`    | [`GET /v2/hotel/:hotelId/booking/:bookingId/guest`][type-booking]             |
| `getBillsForBooking`     | [`GET /v2/hotel/:hotelId/booking/:bookingId/bill`][type-booking]              |
| `getBookingSets`         | [`GET /v2/hotel/:hotelId/booking-set`][type-bookingset]                       |
| `getBookingSetById`      | [`GET /v2/hotel/:hotelId/booking-set/:bookingSetId`][type-bookingset]         |
| `createBookingSet`       | [`POST /v2/hotel/:hotelId/booking-set`][type-bookingset]                      |
| `updateBookingSet`       | [`PATCH /v2/hotel/:hotelId/booking-set/:bookingSetId`][type-bookingset]       |
| `getExtraById`           | [`GET /v2/hotel/:hotelId/extra/:extraId`][type-extra]                         |
| `getExtras`              | [`GET /v2/hotel/:hotelId/extra`][type-extra]                                  |
| `getGuestById`           | [`GET /v2/hotel/:hotelId/guest/:guestId`][type-guest]                         |
| `getGuests`              | [`GET /v2/hotel/:hotelId/guest`][type-guest]                                  |
| `createGuest`            | [`POST /v2/hotel/:hotelId/guest`][type-guest]                                 |
| `updateGuest`            | [`PATCH /v2/hotel/:hotelId/guest/:guestId`][type-guest]                       |
| `getBillsForGuest`       | [`GET /v2/hotel/:hotelId/guest/:guestId/bill`][type-guest]                    |
| `getRatePlanById`        | [`GET /v2/hotel/:hotelId/rate-plan/:ratePlanId`][type-rateplan]               |
| `getRatePlans`           | [`GET /v2/hotel/:hotelId/rate-plan`][type-rateplan]                           |
| `getPriceForRatePlan`    | [`GET /v2/hotel/:hotelId/rate-plan/:ratePlanId/price`][type-rateplan]         |
| `updatePriceForRatePlan` | [`PUT /v2/hotel/:hotelId/rate-plan/:ratePlanId/price`][type-rateplan]         |
| `getRateSets`            | [`GET /v2/hotel/:hotelId/rate-set`][type-rateset]                             |

[getting-started]: https://docs.getimpala.com/#getting-started
[type-allocation]: https://docs.getimpala.com/#allocation-group-block
[type-area]: https://docs.getimpala.com/#area
[type-areatype]: https://docs.getimpala.com/#area-types
[type-bill]: https://docs.getimpala.com/#bill
[type-booking]: https://docs.getimpala.com/#booking
[type-booking]: https://docs.getimpala.com/#booking-set
[type-extra]: https://docs.getimpala.com/#extra
[type-guest]: https://docs.getimpala.com/#guest
[type-rateplan]: https://docs.getimpala.com/#rate-plan
[type-rateset]: https://docs.getimpala.com/#rate-set
