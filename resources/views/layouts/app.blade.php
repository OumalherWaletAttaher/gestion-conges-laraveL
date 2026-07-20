<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gestion des Congés') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

        <style>
            body {
                background-color: #f5f5f7;
            }

            .sidebar {
                width: 260px;
                min-height: 100vh;
                background: linear-gradient(180deg, #7b2f5f 0%, #4a1942 100%);
                position: fixed;
                left: 0;
                top: 0;
            }

            .sidebar-brand {
                padding: 1.5rem;
                color: white;
                font-weight: 700;
                font-size: 1.25rem;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }

            .sidebar .nav-link {
                color: rgba(255,255,255,0.75);
                padding: 0.75rem 1.5rem;
                border-radius: 0;
                transition: all 0.15s ease;
            }

            .sidebar .nav-link i {
                width: 20px;
                margin-right: 0.75rem;
            }

            .sidebar .nav-link:hover {
                color: white;
                background: rgba(255,255,255,0.08);
            }

            .sidebar .nav-link.active {
                color: #7b2f5f;
                background: white;
                border-radius: 2rem 0 0 2rem;
                margin-left: 0.5rem;
                font-weight: 600;
            }

            .main-content {
                margin-left: 260px;
                min-height: 100vh;
            }

            .topbar {
                background: white;
                padding: 1rem 2rem;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .stat-card {
                background: white;
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: 0 0.25rem 1rem rgba(0,0,0,0.06);
                border: none;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: white;
            }

            .avatar-circle {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #7b2f5f;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
            }

            .btn-brand {
                background-color: #7b2f5f;
                border: none;
                color: white;
            }

            .btn-brand:hover {
                background-color: #5f2449;
                color: white;
            }

            .badge-valide { background-color: #198754; }
            .badge-refuse { background-color: #dc3545; }
            .badge-attente { background-color: #fd7e14; }
        </style>
    </head>
    <body>

        <nav class="sidebar d-flex flex-column">
            <div class="sidebar-brand">
                <i class="bi bi-calendar-check me-2"></i>Gestion Congés
            </div>

            <div class="nav flex-column mt-3">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>Dashboard
                </a>
                <a href="{{ route('demande-conges.index') }}" class="nav-link {{ request()->routeIs('demande-conges.index') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    {{ auth()->user()->role === 'manager' ? 'Demande à traiter' : 'Mes demandes' }}
                </a>
                @if (auth()->user()->role !== 'manager')
                    <a href="{{ route('demande-conges.create') }}" class="nav-link {{ request()->routeIs('demande-conges.create') ? 'active' : '' }}">
                        <i class="bi bi-plus-circle"></i>Nouvelle demande
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-person"></i>Profil
                </a>
            </div>

            <div class="mt-auto p-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right"></i>Déconnexion
                    </button>
                </form>
            </div>
        </nav>

        <div class="main-content">
            <div class="topbar">
                @isset($header)
                    <div>{{ $header }}</div>
                @else
                    <div></div>
                @endisset

                <div class="d-flex align-items-center gap-2">
                    <div class="avatar-circle">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div>
                        <div class="fw-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-muted small">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                </div>
            </div>

            <div class="p-4">
                {{ $slot }}
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>