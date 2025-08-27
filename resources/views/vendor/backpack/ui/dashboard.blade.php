@extends(backpack_view('blank'))

@php
    use Domains\Secret\Models\Secret;
    if (backpack_theme_config('show_getting_started')) {
        $widgets['before_content'][] = [
            'type'        => 'view',
            'view'        => backpack_view('inc.getting_started'),
        ];
    } else {
        $nbSecrets = Secret::count();
        $widgets['before_content'][] = [
            'type'          => 'progress_white',
            'class'         => 'card mb-2 custom-card-secrets',
            'value'         => Secret::count(),
            'description'   => trans('backpack::base.secrets_count', ['count' => $nbSecrets]),
            'progressClass' => 'progress-bar bg-success',
        ];
    }
@endphp

@section('content')
@endsection
