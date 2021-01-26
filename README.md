# Top Trumps
Top Trumps game to showcase fetching data from APIs, uniforming the data,
caching and providing to a playable web based interface.

Utilising the Laravel framework

* Fetches card data from the respective APIs
* Creates routes for each game
* The HTML produced from Blade includes a Vue card component mounted which has the card data and displays the cards.

Running `php artisan static-site:build` a static site is built in `storage\dist`.

[![Netlify Status](https://api.netlify.com/api/v1/badges/6cd61d2a-b4a5-44f7-a497-7867061499fa/deploy-status)](https://app.netlify.com/sites/toptrumps/deploys)

[Online demo](https://toptrumps.netlify.app)

## Roadmap

* Add caching for the API calls so as not to hammer the APIs
* Create a Vue game component to actually play the game (with a crude algorithm for choosing the computer players choice)
* Enhanced algorithm using machine learning
* Add support for card date values
* Make the app a PWA (game should be able to be played offline)
