{{-- Utilise le layout Backpack approprié selon que l'utilisateur est connecté ou non --}}
@extends(backpack_view(backpack_user() ? 'layouts.'.backpack_theme_config('layout') : 'errors.blank'))
@php
    $error_number = 404;
@endphp

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 text-center">
        <div class="error-page">
            <div class="error-icon mb-4">
                <div class="forbidden-icon">
                    <i class="las la-search" style="color: #dc3545;"></i>
                </div>
            </div>
            <div class="error_number mb-3">
                <small>ERREUR</small><br>
                404
                <hr>
            </div>
            <div class="error_title mb-3">
                Page non trouvée
            </div>
            <div class="error_description mb-4">
                La page que vous recherchez est introuvable.
            </div>
            <div class="error-actions mt-4">
                <a href="javascript:history.back()" class="btn btn-outline-secondary me-2">
                    ← Retour
                </a>
                <a href="{{ backpack_url('dashboard') }}" class="btn btn-primary">
                    🏠 Tableau de bord
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

