# Top Trumps
Top Trumps game to showcase fetching data from APIs, uniforming the data,
caching and rendering the cards to a web based interface.

It utilises the Laravel framework to

* Build a static site from game config which in turn
* Fetches card data from the respective APIs
* Transforms the API data to card data
* Renders a blade template

## Running the application locally

* Run `php artisan static-site:build` and a static site will be built in `storage\dist`.
* Run `php artisan serve`

or using sail

* Run `./vendor/bin/sail up`
* Run `php artisan static-site:build`

[![Netlify Status](https://api.netlify.com/api/v1/badges/6cd61d2a-b4a5-44f7-a497-7867061499fa/deploy-status)](https://app.netlify.com/sites/toptrumps/deploys)

[Online demo](https://toptrumps.netlify.app)

## Roadmap

* Add caching for the API calls so as not to hammer the APIs
* Create a Vue game component to actually play the game (with a crude algorithm for choosing the computer players choice)
* An enhanced algorithm for the computers choice using machine learning
* Add support for card date values
* Make the app a PWA (game should be able to be played offline)
* Web sockets for multiplayer support
* Create CSS themes for different game themes i.e. Star Wars, Rick and Morty, Lego
