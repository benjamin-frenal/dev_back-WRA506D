# Projet Application "Movies" - Benjamin Frenal S5 F

# Liens Utiles :
Accéder à mon [repository front](https://github.com/benjamin-frenal/dev_front-WRA505D)

Accès à ma [Collection Postman](https://mmi21g08.mmi-troyes.fr/wra506/postman.json)

Accès via mon VPS : [https://mmi21g08.mmi-troyes.fr/wra505/dev_front-WRA505D/](https://mmi21g08.mmi-troyes.fr/wra505/dev_front-WRA505D/).

# Consignes Back :

- [x] GIT + GITFLOW + Commit conventionnel
- [x] Documentation du code ( readme )
- [x] Run Fixtures ( pertinence des données  )
- [x] Recherche ( code back )
- [x] Filtres ( front ) 
- [x] Asserts ( back ) 
- [x] Upload ( config code source + back )
- [x] Interet et participation en cours

# Documentation 
## Installation du projet

Cloner le projet ```git@github.com:benjamin-frenal/dev_back-WRA506D.git ```

Et installer ses dépendances : 
 ```
cd dev_back-WRA506D
git pull
composer install
php bin/console c:c
php bin/console d:s:u --force
composer require symfony/security-bundle
composer require lexik/jwt-authentication-bundle
php bin/console lexik:jwt:generate-keypair
composer require --dev symfony/maker-bundle
composer require --dev orm-fixtures
composer require api
 ```
## Aspect Technique
### Acteur

Récupérer les Auteurs :  ```GET /api/authors ```

Créer un Auteur :  ```POST /api/authors ```

Récupérer un Auteur :  ```GET /api/authors/{id} ```

Mettre à jour un Auteur :  ```PATCH /api/authors/{id} ```

Supprimer un Auteur :  ```DELETE /api/authors/{id} ```

### Catégorie

Récupérer les Catégories :  ```GET /api/categories```

Créer une Catégorie :  ```POST /api/categories```

Récupérer une Catégorie :  ```GET /api/categories/{id}```

Mettre à jour une Catégorie :  ```PATCH /api/categories/{id}```

Supprimer une Catégorie :  ```DELETE /api/categories/{id}```

### Login Check

Créer un Jeton Utilisateur :  ```POST /api/login_check```

### MediaObject

Récupérer les Objets Média :  ```GET /api/media_objects```

Créer un Objet Média :  ```POST /api/media_objects```

Récupérer un Objet Média :  ```GET /api/media_objects/{id}```

### Film

Récupérer les Films :  ```GET /api/movies```

Créer un Film :  ```POST /api/movies```

Récupérer un Film :  ```GET /api/movies/{id}```

Mettre à jour un Film :  ```POST /api/movies/{id}```

Supprimer un Film :  ```DELETE /api/movies/{id}```

### Utilisateur

Récupérer les Utilisateurs :  ```GET /api/users```

Créer un Utilisateur :  ```POST /api/users```

Récupérer un Utilisateur :  ```GET /api/users/{id}```

Mettre à jour un Utilisateur :  ```POST /api/users/{id}```

Supprimer un Utilisateur :  ```DELETE /api/users/{id}```
