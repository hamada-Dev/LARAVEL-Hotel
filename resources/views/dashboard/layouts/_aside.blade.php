<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name . ' ' . auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> @lang('site.statue')</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">


            <li><a href="{{ route('dashboard.home',) }}"><i
                        class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>


            @php
            $asideArray = ['users', 'types', 'branches', 'features', 'rooms', 'reservations', 'reservationdetails']
            @endphp

            @foreach ($asideArray as $aside)
            @if (auth()->user()->hasPermission('read-'.$aside))
            <li><a href="{{ route('dashboard.'.$aside.'.index',) }}"><i
                        class="fa fa-list"></i><span>@lang('site.'.$aside)</span></a></li>
            @endif
            @endforeach

        </ul>

    </section>

</aside>