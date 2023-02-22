# Star wars Stuff

### Setup

Make sure to have the following value on your env file (you can find a sample on the `.env.example` file):

```env
STARWARS_API_URL="https://mystarwarsapi.com/"
```
### Endpoints

Postman collection can be found [here](./docs/StarWars.postman_collection.json)

# Show Starships related to Luke

Returns a list of starships related to Luke

**URL** : `/star-wars/people/luke/starships`

**Method** : `GET`

**Auth required** : NO

**Permissions required** : None

## Success Response

**Code** : `200 OK`


# Shows classification for all species in the 1st episode

Returns a list of species grouped by classification

**URL** : `/star-wars/films/phantom/species/classification`

**Method** : `GET`

**Auth required** : NO

**Permissions required** : None

## Success Response

**Code** : `200 OK`


# Returns total population of the galaxy

Returns a simple object

**URL** : `/star-wars/galaxy/population`

**Method** : `GET`

**Auth required** : NO

**Permissions required** : None

## Success Response

**Code** : `200 OK`
