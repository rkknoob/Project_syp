



<aside class="fixed skin-1">
    <div class="sidebar-inner scrollable-sidebars">




        <div class="main-menu">
            <ul>
                <li @if(Request::is('home'))  @else class="" @endif >
                    <a href="{{Route('home')}}">
								<span class="menu-icon">
									<i class="fa fa-home fa-lg"></i>
								</span>
                        <span class="text">
									Home
								</span>
                        <span class="menu-hover"></span>
                    </a>
                </li>


                <li class="active openable open">
                    <a href="#">
								<span class="menu-icon">
									<i class="fa fa-tag fa-lg"></i>
								</span>
                        <span class="text">
								Count Sheet รอบ 1
								</span>
                        <span class="badge badge-success bounceIn animation-delay5">2</span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ Request::is('count/borrow') ? 'active' : '' }}"><a href="{{Route('count.borrow')}}"><i class="fa fa-circle-o text-red"></i><span class="submenu-label">รับ รอบ 1</span></a></li>
                        <li class="{{ Request::is('count/receive') ? 'active' : '' }}"><a href="{{Route('count.reci')}}"><i class="fa fa-circle-o text-red"></i><span class="submenu-label">คืน รอบ 1</span></a></li>
                    </ul>
                </li>
                <li class="active openable open">
                    <a href="#">
								<span class="menu-icon">
									<i class="fa fa-tag fa-lg"></i>
								</span>
                        <span class="text">
								Count Sheet รอบ 1
								</span>
                        <span class="badge badge-success bounceIn animation-delay5">Insert Round 2</span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ Request::is('count/data') ? 'active' : '' }}"><a href="{{Route('count.data')}}"><i class="fa fa-circle-o text-red"></i><span class="submenu-label">เพิ่มข้อมูล</span></a></li>

                    </ul>
                </li>
                <li class="active openable">
                    <a href="#">
								<span class="menu-icon">
									<i class="fa fa-tag fa-lg"></i>
								</span>
                        <span class="text">
								Count Sheet รอบ 2
								</span>
                        <span class="badge badge-success bounceIn animation-delay5">2</span>
                        <span class="menu-hover"></span>
                    </a>
                    <ul class="submenu">
                        <li class="{{ Request::is('count/borrow2') ? 'active' : '' }}"><a href="{{Route('count.borrow2')}}"><i class="fa fa-circle-o text-red"></i><span class="submenu-label">รับ รอบ 2</span></a></li>
                        <li class="{{ Request::is('count/receive2') ? 'active' : '' }}"><a href="{{Route('count.reci2')}}"><i class="fa fa-circle-o text-red"></i><span class="submenu-label">คืน รอบ 2</span></a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /main-menu -->
    </div><!-- /sidebar-inner -->
</aside>