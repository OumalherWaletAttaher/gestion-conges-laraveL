<x-app-layout>
    <x-slot name="header">
        <h4 class="fw-bold mb-0">Mon profil</h4>
    </x-slot>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="stat-card">
                <h5 class="fw-bold mb-3">Informations du profil</h5>
                <p class="text-muted small mb-4">Mettez à jour votre nom et votre adresse email.</p>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2 small">
                                Votre adresse email n'est pas vérifiée.
                                <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                                    Renvoyer l'email de vérification
                                </button>
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-brand">
                        Enregistrer
                    </button>

                    @if (session('status') === 'profile-updated')
                        <span class="text-success small ms-2">Enregistré.</span>
                    @endif
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="stat-card">
                <h5 class="fw-bold mb-3">Mettre à jour le mot de passe</h5>
                <p class="text-muted small mb-4">Utilisez un mot de passe long et unique pour rester en sécurité.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="update_password_current_password" class="form-label">Mot de passe actuel</label>
                        <input type="password" id="update_password_current_password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password" class="form-label">Nouveau mot de passe</label>
                        <input type="password" id="update_password_password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                        @error('password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-brand">
                        Mettre à jour
                    </button>

                    @if (session('status') === 'password-updated')
                        <span class="text-success small ms-2">Mis à jour.</span>
                    @endif
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="stat-card">
                <h5 class="fw-bold mb-3">Session</h5>
                <p class="text-muted small mb-4">Déconnectez-vous en toute sécurité. Vous pourrez vous reconnecter à tout moment avec vos identifiants.</p>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-brand">
                        <i class="bi bi-box-arrow-right me-2"></i>Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>