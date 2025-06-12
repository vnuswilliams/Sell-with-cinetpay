# Laravel E-commerce avec CinetPay

Ce projet accompagne le tutoriel vidéo sur l'intégration de la solution de paiement CinetPay dans une application PHP/Laravel. Il s'agit d'un système e-commerce simple permettant aux utilisateurs de s'inscrire, de parcourir des produits et d'effectuer des achats en utilisant la passerelle de paiement CinetPay.

## 🚀 Fonctionnalités

- Authentification utilisateur (inscription, connexion, déconnexion)
- Catalogue de produits
- Intégration de CinetPay pour le traitement des paiements
- Historique des achats
- Gestion des statuts de transaction (en attente, complété, échoué)

## 📋 Prérequis

- PHP 8.2 ou supérieur
- Composer
- Un compte CinetPay avec des clés API
- Laravel 12.x

## 🔧 Installation

1. Clonez ce dépôt :
   ```bash
   git clone https://github.com/vanotis720/Sell-with-cinetpay
   cd sellWithCinetpay
   ```

2. Installez les dépendances :
   ```bash
   composer install
   ```

3. Copiez le fichier d'environnement :
   ```bash
   cp .env.example .env
   ```

4. Générez la clé d'application :
   ```bash
   php artisan key:generate
   ```

5. Configurez votre base de données dans le fichier `.env`

6. Exécutez les migrations :
   ```bash
   php artisan migrate
   ```

7. Configurez les variables d'environnement CinetPay dans votre fichier `.env` :
   ```
   CINETPAY_API_KEY=votre_api_key
   CINETPAY_SITE_ID=votre_site_id
   CINETPAY_API_URL=https://api-checkout.cinetpay.com/v2/payment
   ```

8. Lancez le serveur de développement :
   ```bash
   php artisan serve
   ```

## 💳 Configuration CinetPay

Pour que l'intégration de CinetPay fonctionne correctement :

1. Créez un compte sur [CinetPay](https://cinetpay.com/)
2. Créez un site dans votre espace marchand
3. Récupérez les clés d'API et l'ID du site
4. Configurez les URL de notification et de retour dans votre tableau de bord CinetPay pour qu'elles correspondent à vos routes Laravel

## 🔄 Flux de paiement

Le processus de paiement se déroule comme suit :

1. L'utilisateur choisit un produit à acheter
2. Une transaction avec statut "pending" est créée dans la base de données
3. La demande est envoyée à CinetPay avec un ID de transaction unique
4. L'utilisateur est redirigé vers la page de paiement CinetPay
5. Après le paiement, CinetPay notifie l'application via l'URL de notification
6. L'application vérifie le statut de la transaction et met à jour l'achat en "completed" ou "failed"
7. L'utilisateur est redirigé vers une page de confirmation ou d'erreur

## 📁 Structure du projet

- `app/Models/Purchase.php` - Modèle pour les achats
- `app/Models/Product.php` - Modèle pour les produits
- `app/Http/Controllers/PurchaseController.php` - Gestion des achats et transactions
- `app/Http/Controllers/AuthController.php` - Gestion de l'authentification

## 🛠️ Personnalisation

Vous pouvez personnaliser ce projet en :

- Modifiant le modèle de produit pour ajouter des attributs supplémentaires
- Ajoutant des catégories de produits
- Personnalisant la présentation visuelle
- Ajoutant d'autres méthodes de paiement

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou à soumettre une pull request.

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.

## 📺 Tutoriel Vidéo

Ce projet accompagne le tutoriel vidéo disponible sur [YouTube](https://www.youtube.com/@vanderotis) qui explique en détail l'intégration de CinetPay avec Laravel.
