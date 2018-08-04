
<div id="top-nav" class="skin-2 fixed">
    <div class="brand">

        <span> <img src="{!!asset('images/logo-main.png')!!}"></span>
        <span class="text-toggle"></span>
    </div><!-- /brand -->

    <ul class="nav-notification clearfix">

        <input name="_token" type="hidden" value="{{ csrf_token() }}" />


        <li class="profile dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <strong>{{ Auth::user()->user_code }}</strong>
                <span><i class="fa fa-chevron-down"></i></span>
            </a>
            <ul class="dropdown-menu">
                <li><a tabindex="-1" href="" class="main-link"><i class="fa fa-users fa-lg"></i>{{ Auth::user()->fname}} {{ Auth::user()->lname}}</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="{{ route('profile_user') }}" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" class="main-link logoutConfirm_open" href="{{ route('logout') }}"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
            </ul>
        </li>
    </ul>
        </li>



            </ul>
        </li>

    </ul>

</div><!-- /top-nav-->