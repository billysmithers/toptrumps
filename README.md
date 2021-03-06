# Top Trumps
Top Trumps game to showcase fetching data from APIs, uniforming the data,
caching and rendering the cards to a web based interface.

It utilises the Laravel framework to act as an API Gateway and then build a static site as the User Interface.
The following tasks are performed to achieve this: 

* Build a static site from game config which in turn
* Fetches card data from the respective APIs
* Transforms the API data to card data
* Renders a blade template

## Running the application locally

* Run `php artisan static-site:build` and a static site will be built in `storage\dist`.
* Run `php artisan serve`

or using sail

* Run `./vendor/bin/sail up`
* Run `docker exec -it top-trumps_laravel.test_1 bash` to enter the test app container
* Run `php artisan static-site:build` from within the container

[![Netlify Status](https://api.netlify.com/api/v1/badges/6cd61d2a-b4a5-44f7-a497-7867061499fa/deploy-status)](https://app.netlify.com/sites/toptrumps/deploys)

[Online demo](https://toptrumps.netlify.app)

## Adding a theme / game
* Create a `Client` and `Fetcher` in the app Api namespace
* Create a `DataTransformer` in the app Transformers namespace
* Write unit tests for the `Fetcher` and `Transformer` (see the Star Wars examples in `tests`)
* Add the theme / game config to `config/games.php`

## Roadmap

* Make the command more robust - only publish pages and links to said pages if content generated
* Image manipulation so images are not called directly from third party but made to fit and base64 encoded (work offline)
* Add caching for the API calls so as not to hammer the APIs
* Create a Vue game component to actually play the game (with a crude algorithm for choosing the computer players choice)
* An enhanced algorithm for the computers choice using machine learning
* Add support for card date values
* Make the app a PWA (game should be able to be played offline)
* Web sockets for multiplayer support
* Create CSS themes for different game themes i.e. Star Wars, Lego
* Games config to be split by themes in a games folder - make it easier to add themes and games to existing themes
