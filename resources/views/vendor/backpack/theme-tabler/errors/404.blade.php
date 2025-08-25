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

@section('after_styles')
<style>
.error-page {
    padding: 2rem 0;
    min-height: 60vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.forbidden-icon {
    font-size: 5rem;
    animation: pulse 2s infinite;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.8;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.error_number {
    font-size: 120px;
    font-weight: 600;
    line-height: 80px;
    color: #dc3545;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.error_number small {
    font-size: 24px;
    font-weight: 700;
    color: #6c757d;
    letter-spacing: 2px;
}

.error_number hr {
    margin: 20px auto;
    width: 80px;
    border: 2px solid #dc3545;
    border-radius: 2px;
}

.error_title {
    font-size: 32px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 1rem;
}

.error_description {
    font-size: 18px;
    color: #6c757d;
    line-height: 1.6;
    max-width: 500px;
    margin: 0 auto;
}

.btn {
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin: 0.25rem;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    color: white;
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
    background: transparent;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: white;
}

@media (max-width: 768px) {
    .error_number {
        font-size: 80px;
        line-height: 60px;
    }
    
    .error_title {
        font-size: 24px;
    }
    
    .error_description {
        font-size: 16px;
    }
    
    .forbidden-icon {
        font-size: 3rem;
    }
}
</style>
@endsection
