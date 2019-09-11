# User-Inviter
by Lucas Rothamel.

The next-generation social network to invite users!

A simple test site using Laravel 6. Requires php 7.2+ and mysql

## Recommended Dev Setup
- Run in Devilbox: 
  - https://devilbox.readthedocs.io/en/latest/getting-started/install-the-devilbox.html
  - this provides a handy dev setup with php, nginx, mysql, phpmyadmin, etc, all pre-configured and ready to use. 
- git-clone this repos into the ``data/www/user-inviter`` folder
- copy the the two files in the ``/devilbox`` folder to the devilbox root folder
  - this selects the correct php version and adds selenium to docker-compose
- run ``docker-compose up -d`` from within the devilbox root folder

## First-Run
You need to:
- create an empty mysql database
  - if using Devilbox, point your browser to: http://localhost/vendor/phpmyadmin-4.8.4/index.php
- define a ``.env``file (use ``.env.example`)`, and define the mysql database connection details
- if using Devilbox, enter the container, then change to the user-inviter folder.
  - ``./shell.sh`` from the devilbox root folder
  - ``cd data/www/user-inviter``
- install all dependencies
  - ``composer install``
  - ``npm install && npm run dev``
  - ``php artisan migrate --seed`` (a useful db seed is included)
- add ``127.0.0.1 user-inviter.loc`` to your ``/etc/hosts`` file
- visit ``http://user-inviter.loc`` and log in using `demo@test.com` as user and `secret` as password
  - this is an admin account added by the user seeder

## Notes
- the local laravel storage is used. However, the php file functions are not used, only the laravel storage facade, so switchting to AWS S3 or similar would be easy.
- phpCS and phpmd are included as dependencies for easy usage in a CI pipeline.

## Tests
- most user interface parts are tested by Laravel Feature- and Browser-Tests. 
Run them together using the command ``./run-tets.sh`` - include in a future CI pipeline.
- The tests run against a local sqlite database, and selenium is included in the docker-compose. 

## Expansion Thoughts
- Posts are boring text-only plus an image, should add a WSYWIG editor, or expand it with different post types, previews of shared links, etc
- Of course, a feature to actually make "friends" with any user should be added
- once we have "friends", we can make a stream of recent content posted by our friends
- Invitation should be expanded to the likes of Linked In, Facebook, etc, so the user can pick or "invite all", and receiving a notification at those services to join our site. 
- Actual sending of emails needs implementing. Should be done using Laravel Queues.
- The feature tests could do with some re-factoring, too much copy-paste of setting up tests there.
- The simple profile view UI could be really made beautiful, with some gallery features, pagination, etc
- Then, a bigger admin area with statistics on how invitations are going over last days, weeks, months, etc, is missing
- The whole UI better be redesigned with a JS framework. VueJS integrates nicely with Laravel.
