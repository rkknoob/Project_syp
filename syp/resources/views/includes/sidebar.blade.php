
<aside class="fixed skin-1">
    <div class="sidebar-inner scrollable-sidebars">

        <div class="main-menu">
            <ul>
                <li @if(Request::is('home')) class="active" @else class="" @endif >
                    <a href="{{Route('home')}}">
								<span class="menu-icon">
									<i class="fa fa-home fa-lg"></i>
								</span>
                        <span class="text">
									 <b>หน้าหลัก </b>
								</span>
                        <span class="menu-hover"></span>
                    </a>
                </li>

                <li @if(Request::is('admin/categorie.mainpage')) class="active" @else class="" @endif >
                    <a href="{{Route('admin/categorie.mainpage')}}">
								<span class="menu-icon">
									<i class="fa fa-link"></i>
								</span>
                        <span class="text">
                            <b>จัดการหมวดหมู่เอกสาร</b>
								</span>
                        <span class="menu-hover"></span>
                    </a>

                </li>

                <li @if(Request::is('admin/categorie/document'))  @else class="" @endif >
                    <a href="{{Route('admin/categorie/document.maindoc')}}">
								<span class="menu-icon">
                                    <i class="fa fa-link" aria-hidden="true"></i>
								</span>
                        <span class="text">
                                   <b> จัดการเอกสาร </b>
								</span>
                        <span class="menu-hover"></span>
                    </a>
                </li>




            </ul>

        </div><!-- /main-menu -->
    </div><!-- /sidebar-inner -->
</aside>