{{-- Utilise le layout Backpack approprié selon que l'utilisateur est connecté ou non --}}
@extends(backpack_view(backpack_user() ? 'layouts.'.backpack_theme_config('layout') : 'errors.blank'))

@php
    $error_number = 403;
@endphp

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 text-center">
        <div class="error-page">
            <!-- Icône d'interdiction -->
            <div class="error-icon mb-4">
                <div class="forbidden-icon">
                    🚫
                </div>
            </div>
            <div class="error_number mb-3">
                <small>ERREUR</small><br>
                403
                <hr>
            </div>
            <div class="error_title mb-3">
                Accès Interdit
            </div>
            <div class="error_description mb-4">
                @if(isset($exception) && $exception->getMessage())
                    {{ $exception->getMessage() }}
                @else
                    Vous n'avez pas les autorisations nécessaires pour accéder à cette ressource.
                @endif
            </div>
            @if(backpack_user())
            <div class="error-actions mt-4">
                <a href="javascript:history.back()" class="btn btn-outline-secondary me-2">
                    ← Retour
                </a>
                <a href="{{ backpack_url('dashboard') }}" class="btn btn-primary">
                    🏠 Tableau de bord
                </a>
            </div>
            @else
            <div class="error-actions mt-4">
                <a href="{{ backpack_url('login') }}" class="btn btn-primary">
                    🔐 Se connecter
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
