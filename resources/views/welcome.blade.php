<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Gestion des Congés') }}</title>

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
        <!-- Google Fonts (Roboto) -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
        <!-- MDBootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet" />
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

        <style>
            body {
                display: flex;
                align-items: center;
                min-height: 100vh;
                background-color: #f5f5f7;
            }

            .welcome-wrapper {
                width: 100%;
                max-width: 900px;
                margin: auto;
                background: white;
                border-radius: 1.5rem;
                box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.15);
                overflow: hidden;
                animation: fadeInUp 0.5s ease-out;
            }

            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .welcome-side {
                background: linear-gradient(135deg, #7b2f5f 0%, #4a1942 100%);
                position: relative;
                overflow: hidden;
                min-height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 3rem 2rem;
            }

            .welcome-side::before {
                content: "";
                position: absolute;
                top: -20%;
                left: -30%;
                width: 250px;
                height: 250px;
                background: rgba(255, 255, 255, 0.08);
                transform: rotate(45deg);
            }

            .welcome-side::after {
                content: "";
                position: absolute;
                bottom: -25%;
                right: -20%;
                width: 300px;
                height: 300px;
                background: rgba(255, 255, 255, 0.06);
                transform: rotate(45deg);
            }

            .welcome-side-content {
                position: relative;
                z-index: 1;
                text-align: center;
                color: white;
            }

            .icon-circle {
                width: 90px;
                height: 90px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.15);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                font-size: 2.5rem;
            }

            .btn-brand {
                background-color: #7b2f5f;
                border: none;
                color: white;
                transition: all 0.15s ease;
            }

            .btn-brand:hover {
                background-color: #5f2449;
                color: white;
                transform: translateY(-1px);
            }

            .btn-outline-brand {
                border: 2px solid #7b2f5f;
                color: #7b2f5f;
                transition: all 0.15s ease;
            }

            .btn-outline-brand:hover {
                background-color: #7b2f5f;
                color: white;
                transform: translateY(-1px);
            }
        </style>
    </head>
    <body>

        <div class="welcome-wrapper">
            <div class="row g-0">
                <div class="col-md-5">
                    <div class="welcome-side h-100">
                        <div class="welcome-side-content">
                            <div class="icon-circle">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h3 class="fw-bold mb-2">Gestion des Congés</h3>
                            <p class="opacity-75 mb-0">Simulez et gérez vos demandes de congés employés</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 d-flex align-items-center">
                    <div class="p-5 w-100 text-center">
                        <h2 class="fw-bold mb-3">Bienvenue</h2>
                        <p class="text-muted mb-4">
                            Une plateforme simple pour déposer, suivre et valider les demandes de congés au sein de votre équipe.
                        </p>

                        @if (Route::has('login'))
                            <div class="d-grid gap-2">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-brand btn-lg">
                                        Accéder à mon espace
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-brand btn-lg">
                                        Se connecter
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-brand btn-lg">
                                            Créer un compte
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- MDBootstrap JS -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js"></script>
    </body>
</html>