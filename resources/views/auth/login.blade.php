<x-guest-layout>
    <div class="auth-wrapper">
        <div class="row g-0">
            <div class="col-md-5">
                <div class="auth-side h-100">
                    <div class="auth-side-content">
                        <div class="icon-circle">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h3 class="fw-bold mb-2">Bon retour</h3>
                        <p class="opacity-75 mb-0">Connectez-vous pour gérer vos demandes de congés</p>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="p-5">
                    <h2 class="fw-bold mb-4">Connexion</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>

                        <button type="submit" class="btn btn-brand btn-lg w-100 mb-3">
                            Se connecter
                        </button>

                        <p class="text-center text-muted mb-0">
                            Pas encore de compte ?
                            <a href="{{ route('register') }}" class="link-brand">S'inscrire</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>