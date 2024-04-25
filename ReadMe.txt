ReadMe Test technique : CRUD de News en Laravel

Mustapha Ramadan
Email: mustapha.ramadan04@gmail.com

J'ai réalisé le test technique de création d'une API pour la gerre des News. 
J'ai utilisé Laravel version 10, et j'ai testé l'API à l'aide du programme PostMan.
Et j'ai réalisé ce qui m'était demandé dans le cahier de charge.

je l'ai fait :

# Base de données news_db (Users, News, Categories).
# Modéls (User, News, Categorie).
# Controller: 
    * Api\Auth\UserController : pour l'authentification user.
    * Api\NewsController : pour gérer les opérations CRUD sur les news (création, lecture, mise à jour, suppression).
# Middelware: middleware pour restreindre l'accès à l'API aux utilisateurs authentifiés.
# Request: pour validation les requests.
# Route: routes API pour les opérations CRUD, middleware Appliqué aux routes de l'API.
# Réponse: la réponse API contient des codes d'état HTTP, status message.
    * 200 pour OK,
    * 201 pour la création,
    * 202 pour la miss à joure,
    * 204 pour la suppression,
    * 400 pour erreur request.
    * 401 unauthorized Authentication
    * 404 pour pas trouvé element.
    * 500 pour erreur interne du serveur.
# Seeders: pour insérer data en la bass de données.
    * UserSeeder: pour créer user Admin.
    * CategoriesSeeder: pour créer arbre des catégories.


Exécute ces commandes pour exécuter l'API

# 1 demarer le server
php artisan serve


# 2 Exécutez cette commande pour créer la base de données et les tables
php artisan migrate


# 3 Exécutez cette commande pour créer user
php artisan db:seed --class=UserSeeder


# 3 Exécutez cette commande pour créer categories
php artisan db:seed --class=CategoriesSeeder


# 4 pour afficher tous les routes de Api
php artisan route:list --path=api


# 5 User admin:
    * email: admin@email.com
    * password: admin123456

# 6 Routes lApi:
    api/auth/login ......................................... Api\Auth\UserController@login
    GET|HEAD  api/news ..................................... Api\NewsController@index
    POST      api/news ..................................... Api\NewsController@store
    GET|HEAD  api/news/categorie/{categorie} ............... Api\NewsController@search
    GET|HEAD  api/news/{id} ................................ Api\NewsController@show
    PUT       api/news/{id} ................................ Api\NewsController@update
    DELETE    api/news/{id} ................................ Api\NewsController@destroy 
    GET|HEAD  api/user .....................................


Enfin, Merci de vous intéresser à ma candidature.
