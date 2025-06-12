<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Augmentez vos compétences avec nos cours</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">EduMarket</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="#"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">Accueil</a>
                    <a href="#"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">Cours</a>
                    <a href="#"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">Contact</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-10 bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center py-16">
                <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                    <span class="block">Développez vos compétences numériques</span>
                    <span class="block">avec nos cours premium</span>
                </h2>
                <p class="mt-4 text-xl text-indigo-100">
                    Des cours de qualité pour vous aider à maîtriser les technologies d'aujourd'hui et de demain.
                </p>
                <div class="mt-8">
                    <a href="#courses"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50">
                        Découvrir nos cours
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="courses" class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-10">Nos Cours Populaires</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($products as $product)
                    <div
                        class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:transform hover:scale-105">
                        <div class="h-64">
                            <img src="{{ asset($product->url) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900">{{ $product->name }}</h3>
                            <p class="mt-2 text-gray-600 line-clamp-2">{{ $product->description }}</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-xl font-bold text-indigo-600">{{ number_format($product->price, 2) }}
                                    CDF </span>
                                <a href="{{ route('purchase', $product->id) }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                    Acheter maintenant
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-10">Pourquoi Nous Choisir</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-medium text-gray-900">Cours de Qualité</h3>
                    <p class="mt-2 text-gray-600">Des cours réalisés par des experts dans leur domaine.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-medium text-gray-900">Accès à Vie</h3>
                    <p class="mt-2 text-gray-600">Accédez à vos cours quand vous voulez, pour toujours.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-medium text-gray-900">Support Premium</h3>
                    <p class="mt-2 text-gray-600">Une équipe à votre écoute pour vous accompagner.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-12 bg-indigo-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white">Restez informé de nos nouveaux cours</h2>
                <p class="mt-4 text-xl text-indigo-200">Inscrivez-vous à notre newsletter pour recevoir nos actualités.
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-md shadow">
                        <input type="email" placeholder="Votre adresse email"
                            class="px-5 py-3 border-transparent rounded-l-md focus:ring-indigo-500 focus:border-indigo-500 block w-64 sm:w-96">
                        <button type="button"
                            class="px-5 py-3 border border-transparent text-base font-medium rounded-r-md text-indigo-600 bg-white hover:bg-indigo-50">S'inscrire</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">À propos</h3>
                    <p class="mt-4 text-base text-gray-300">
                        Nous proposons les meilleurs cours pour développer vos compétences numériques et booster votre
                        carrière.
                    </p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Liens Utiles</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Conditions Générales</a>
                        </li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Politique de
                                Confidentialité</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Nous Suivre</h3>
                    <div class="mt-4 flex space-x-6">
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8">
                <p class="text-base text-gray-400 text-center">&copy; 2025 EduMarket. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>

</html>
