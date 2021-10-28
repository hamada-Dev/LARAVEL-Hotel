<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="X" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name . ' ' . auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> @lang('site.statue')</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">


            <li><a href="{{ route('dashboard.home',) }}"><i
                        class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>


          
            @if (auth()->user()->hasPermission('read-types'))
            <li><a href="{{ route('dashboard.types.index',) }}"><i
                        class="fa fa-list"></i><span>@lang('site.types')</span></a></li>
            @endif

        </ul>

    </section>

</aside>