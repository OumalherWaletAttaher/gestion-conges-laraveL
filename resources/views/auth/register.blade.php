<x-guest-layout>
    <div class="auth-wrapper">
        <div class="row g-0">
            <div class="col-md-5">
                <div class="auth-side h-100">
                    <div class="auth-side-content">
                        <div class="icon-circle">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h3 class="fw-bold mb-2">Bienvenue</h3>
                        <p class="opacity-75 mb-0">Créez votre compte pour commencer</p>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="p-5">
                    <h2 class="fw-bold mb-4">Inscription</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" required autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label">Vous êtes</label>
                            <select id="role" name="role" class="form-select form-select-lg @error('role') is-invalid @enderror" required>
                                <option value="employe" {{ old('role') == 'employe' ? 'selected' : '' }}>Employé</option>
                                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-brand btn-lg w-100 mb-3">
                            S'inscrire
                        </button>

                        <p class="text-center text-muted mb-0">
                            Déjà inscrit ?
                            <a href="{{ route('login') }}" class="link-brand">Se connecter</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>