# Impala API PHP SDK

## Installation

It's as simple as:

```bash
$ composer require get-impala/impala-php
```

## Obtaining an API key

To use this library, you will need an Impala API key. More information can be
found in the ['Getting Started'][getting-started] section of the Impala developer documentation.

## Getting Started

After installation, you can instantiate the library using its factory class:

```php

Impala\ImpalaFactory;
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
$impala = ImpalaFactory::create('secret', 'hapi');

// You can then pass the hotelId directly to the method
$impala->getBookings('hapi');

// Or, you can call getHotel to return a single-hotel API instance
$hapiHotel = $impala->getHotel('hapi')

// You can then call the API methods like normal
$hapiHotel->getBookings();
```

## Making API calls

All API methods accept an object as their first argument, containing the parameters for the API call. This object can be omitted if there are no arguments to set.

API methods that take an ID have the ID as the first argument.

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

| Name               | HTTP API endpoint                                                  |
|:-------------------|:-------------------------------------------------------------------|
| `getBookings`      | [`GET /v1/hotel/:hotelId/booking`][type-booking]                   |
| `getBookingById`   | [`GET /v1/hotel/:hotelId/booking/:bookingId`][type-booking]        |
| `getGuests`        | [`GET /v1/hotel/:hotelId/guest`][type-guest]                       |
| `getGuestById`     | [`GET /v1/hotel/:hotelId/guest/:guestId`][type-guest]              |
| `getRooms`         | [`GET /v1/hotel/:hotelId/room`][type-room]                         |
| `getRoomById`      | [`GET /v1/hotel/:hotelId/room/:roomId`][type-room]                 |
| `getRoomTypes`     | [`GET /v1/hotel/:hotelId/room-type`][type-roomtype]                |
| `getRoomTypeById`  | [`GET /v1/hotel/:hotelId/room-type/:roomTypeId`][type-roomtype]    |
| `getRates`         | [`GET /v1/hotel/:hotelId/rate`][type-rate]                         |
| `getRateById`      | [`GET /v1/hotel/:hotelId/rate/:rateId`][type-rate]                 |
| `getRatePlans`     | [`GET /v1/hotel/:hotelId/rate-plan`][type-rateplan]                |
| `getRatePlanById`  | [`GET /v1/hotel/:hotelId/rate-plan/:ratePlanId`][type-rateplan]    |
| `getRatePrices`    | [`GET /v1/hotel/:hotelId/rate-price`][type-rateprice]              |
| `getRatePriceById` | [`GET /v1/hotel/:hotelId/rate-price/:ratePriceId`][type-rateprice] |

[getting-started]: https://docs.getimpala.com/#getting-started
[type-booking]: https://docs.getimpala.com/#booking
[type-guest]: https://docs.getimpala.com/#guest
[type-room]: https://docs.getimpala.com/#room
[type-roomtype]: https://docs.getimpala.com/#room-type
[type-rate]: https://docs.getimpala.com/#rate
[type-rateplan]: https://docs.getimpala.com/#rate-plan
[type-rateprice]: https://docs.getimpala.com/#rate-price