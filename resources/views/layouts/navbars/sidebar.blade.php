<div class="sidebar" data-image="{{ asset('light-bootstrap/img/sidebar-5.jpg') }}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                <img style="width:230px;height:90px;" class="avatar border-gray" src="{!! asset('archieve/uniten.png') !!}" alt="...">
                {{ __("U-Election") }}
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>{{ __("Dashboard") }}</p>
                </a>
            </li>
            @if (Auth::user()->role_id != 1)
            <li class="nav-item @if($activePage == 'user') active @endif">
                <a class="nav-link" href="{{route('profile.edit')}}">
                    <i class="nc-icon nc-single-02"></i>
                    <p>{{ __("User Profile") }}</p>
                </a>
            </li>
            @endif
            @if (Auth::user()->role_id == 1)
            <li class="nav-item @if($activePage == 'user-management') active @endif">
                <a class="nav-link" href="{{route('user.index')}}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>{{ __("User Management") }}</p>
                </a>
            </li>
            @endif
            <li class="nav-item @if($activePage == 'candidate') active @endif">
                <a class="nav-link" href="{{route('candidate.index')}}">
                    <i class="nc-icon nc-badge"></i>
                    <p>{{ __("Candidate") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'vote') active @endif">
                <a class="nav-link" href="{{route('vote.index')}}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __("Voting") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'result') active @endif">
                <a class="nav-link" href="{{route('result.index')}}">
                    <i class="nc-icon nc-notes"></i>
                    <p>{{ __("Result") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'buletin-new-index') active @endif">
                <a class="nav-link" href="{{route('buletin_new.index')}}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>{{ __("Buletin News") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'feedback-index') active @endif">
                <a class="nav-link" href="{{route('feedback.index')}}">
                    <i class="nc-icon nc-email-85"></i>
                    <p>{{ __("Feedbacks") }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
