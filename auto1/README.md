I was confused by the next condition:

"Delicious bananas LTD" adds lot of "Red Dacca" cultivar bananas, planted in Costa Rica and harvested on July 27, 2018 with total weight of 500 kg, but minimum weight allowed is 1000 kg.

it means "Delicious bananas LTD" tries  to add the lot but because the marketplace has min weight for lots the platform rejects the adding?

or 

it means the lot has weight 500kg, but buyers can buy min 1000kg (so min 2 lots) and  the platform should support quantity for lots?

for simplicity, I assume the first one. So the marketplace just has min weight requirements  for lots.


I use README.MD syntax for this text.


#API for Marketplace

## Lots:

in general a Lot have the next structure for responses/requests:
```
{
    "id": 1,
    "startsAt": "2022-04-23T00:00:00Z",
    "endsAt": "2022-04-24T00:00:00Z",
    "seller": {
        "id": 11
    },
    "buyer": {
        "id": 22
    },
    "weight": 12,
    "country": "germany",
    "harvestedAt": "2020-04-23",
    "cultivar": "yamiami",
    "initPrice": 1.11
}
```
Where `startsAt`, `endsAt`, `buyer` can be nullable (not exist)

### Get all lots:
[GET] /lots
Response: List of lots objects

### Get one lot:
[GET] /lots/{id}
Response: A lot object

### Add a lot:
[POST] /lots

Body:
```
{
    "weight": {int},
    "country": {string},
    "harvestedAt": {date},
    "cultivar": {string}
}
```
Response: the created object. Response code: 201

the seller will be added on the backend side based on auth data.


### Patch a lot:
[PATCH] /lots/{id}

Body:
```
{
    "startsdAt": {DateTime},
    "endsAt": {DateTime},
    "weight": {int},
    "country": {string},
    "harvestedAt": {date},
    "cultivar": {string},
    "initPrice": {double}
    
}
```
Response: patched object. Response code: 200

where any field is optional as it is Patch

### Delete a lot:
[DELETE] /lots/{id}

## Starting and ending of an auction
No need to develop separate API endpoints for starting and ending an auction as the owner of a lot  can patch the lot by updating `startedAt` `endedAt` fields.
The owner can not change other fields if there is at least one bind for the lot to avoid confusing buyers. 

##Bids
A bid have the next structure:
```
{
  "user": {
    "id": {int}
  },
  "createdAt": {datetime},
  "value": {double}
}
```

Where `value` is price per `kg`

### Get bids for a lot:
[GET] /lots/{lotId}/bids
Response: list of bids

### Adding a bid
[POST] /lots/{lotId}/bids
Body: 
```
{
  "user": {
    "id": {int}
  },
  "value": {double}
}
```
Response: Created bid object and 201 response code


#Examples:

1) Seller "Delicious bananas LTD" (id=899) successfully adds lot of "Red Dacca" cultivar bananas, planted in Costa Rica and harvested on July 27, 2018 with total weight of 1500 kg.

Request: [POST] /lots

Request Body:
```
{
    "weight": 1500,
    "country": "Costa Rica",
    "harvestedAt": "27-07-2018",
    "cultivar": "Red Dacca"
}
```

Response:
```
{
    "id": 1,
    "seller": {
        "id": 899
    },
    "weight": 1500,
    "country": "Costa Rica",
    "harvestedAt": "27-07-2018",
    "cultivar": "Red Dacca",
    "initPrice": 0
}
```
Response code: 201


2) "Delicious bananas LTD" adds lot of "Red Dacca" cultivar bananas, planted in Costa Rica and harvested on July 27, 2018 with total weight of 500 kg, but minimum weight allowed is 1000 kg.

Request: [POST] /lots

Request Body:
```
{
    "weight": 500,
    "country": "Costa Rica",
    "harvestedAt": "27-07-2018",
    "cultivar": "Red Dacca"
}
```

Response: 
```
{
    "error": "Can not add the lot. Minimum weight is 1000 kg"
}
```
Response code: 400


3) "Delicious bananas LTD" changes harvesting date of created lot to June 14, 2018.

Request: [PATCH] /lots/1

Request Body:
```
{
    "harvestedAt": "14-06-2018"
}
```

Response:
```
{
    "id": 1,
    "seller": {
        "id": 899
    },
    "weight": 500,
    "country": "Costa Rica",
    "harvestedAt": "14-06-2018",
    "cultivar": "Red Dacca",
    "initPrice": 0
}
```
Response code: 200


4) "Delicious bananas LTD" starts an auction on Sep 4, 2018 on the same lot with initial price $1.20/kg and duration 1 day.

Request: [PATCH] /lots/1

Request Body:
```
{
    "startsAt": "2018-09-04T00:00:00Z",
    "endsAt": "2018-09-05T00:00:00Z",
    "initPrice": 1.2
}
```

Response:
```
{
    "id": 1,
    "startsAt": "2018-09-04T00:00:00Z",
    "endsAt": "2018-09-05T00:00:00Z",
    "seller": {
        "id": 899
    },
    "weight": 500,
    "country": "Costa Rica",
    "harvestedAt": "14-06-2018",
    "cultivar": "Red Dacca",
    "initPrice": 1.2
}
```
Response code: 200


5) A buyer "German Retailer GmbH" (id=72) bids on the same lot with a price $1.35/kg

Request [POST] /lots/1/bids

Request Body:
```
{"value": 1.35}
```

Response:
```
{
  "user": {
    "id": 72
  },
  "createdAt": "2018-09-04T12:00:00Z",
  "value": 1.35
}
```
Response Code: 201


6) "Delicious bananas LTD" wants to see a list of bids on his lot
Request: [GET] /lots/1/bids

Response:
```
[
    {
      "user": {
        "id": 72
      },
      "createdAt": "2018-09-04T12:00:00Z",
      "value": 1.35
    }
]
```
Response Code: 200

7) "Delicious bananas LTD" wants to remove sold lot

Request: [DELETE] /lots/1

Response: empty

Response code: 200

