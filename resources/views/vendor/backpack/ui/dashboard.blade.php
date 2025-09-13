@extends(backpack_view('blank'))

@php
    use Domains\Secret\Models\Secret;
    if (backpack_theme_config('show_getting_started')) {
        $widgets['before_content'][] = [
            'type'        => 'view',
            'view'        => backpack_view('inc.getting_started'),
        ];
    } else {
            $user = backpack_auth()->user();
            $nbSecretsShared = $user->sharedSecrets()->count();
            $nbSecretsOwned = Secret::where('created_by', $user->id)->count();  
            $widgets['before_content'][] = [
                'type'          => 'progress_white',
                'class'         => 'card mb-2 custom-card-secrets',
                'value'         => $nbSecretsShared == 0 ? $nbSecretsOwned : $nbSecretsShared,
                'description'   => trans('backpack::base.secrets_count', ['count' => $nbSecretsShared]),
                'progressClass' => 'progress-bar bg-success',
            ];
    }
@endphp

@section('content')
@endsection
