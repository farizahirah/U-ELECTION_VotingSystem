@if (auth()->check() && request()->route()->getName() != null)
    @include('layouts.navbars.navs.auth')
@endif