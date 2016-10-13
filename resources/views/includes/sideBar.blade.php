 <!-- Aside Start-->
<aside class="left-panel"  style=" background: #1e285d;">

            <!-- brand -->
            <div class="logo" style=" background: #1e285d;">
                <a href="#" class="logo-expanded">
                    <i class="fa fa-child"  style="color: #ffffff"></i>
                    <span href="{!!route('dashboard')!!}"   style="color: #ffffff;font-family: cursive;" class="nav-label">{!! Config::get('customConfig.names.siteName')!!}</span>

                </a>
            </div>
            <!-- / brand -->


            <!-- Navbar Start -->
            <nav class="navigation">
                <ul class="list-unstyled">

                     {{--<li class="{!! Menu::areActiveURLs(['dashboard', 'change-password']) !!}"><a href="#"><i class="ion-flask"></i> <span class="nav-label">Dashboard</span></a>--}}
                        {{--<ul class="list-unstyled">--}}

                            {{--<li class="{!! Menu::isActiveURL('dashboard') !!}">--}}
                                {{--<a href="{!!  URL::to( 'dashboard') !!}">Dashboard</a>--}}
                            {{--</li>--}}

                            {{--<li class="{!! Menu::isActiveURL('change-password') !!}">--}}
                                {{--<a href="{!!  URL::to( 'change-password') !!}">Password Change</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}




                    <li class="has-submenu"><a href="{!! Menu::areActiveRoutes(['userList']) !!}"><i class="ion-compose"></i> <span class="nav-label">User</span></a>
                        <ul class="list-unstyled">
                            <li><a href="{!! URL::route( 'userList') !!}">User List</a></li>
                            {{--<li><a href="#">Form Validation</a></li>--}}

                        </ul>
                    </li>


                    {{--<li class="has-submenu"><a href="#"><i class="ion-grid"></i> <span class="nav-label">Data Tables</span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="#">Basic Tables</a></li>--}}
                            {{--<li><a href="#">Data Table</a></li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}


                    {{--<li class="has-submenu"><a href="#"><i class="ion-stats-bars"></i> <span class="nav-label">Charts</span><span class="badge bg-purple">1</span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="#">chart</a></li>--}}
                            {{--<li><a href="#">Morris</a></li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}


                    {{--<li class="has-submenu"><a href="#"><i class="ion-email"></i> <span class="nav-label">Mail</span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="#">Inbox</a></li>--}}
                            {{--<li><a href="#">Compose Mail</a></li>--}}
                            {{--<li><a href="#">View Mail</a></li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}


                    {{--<li class="has-submenu"><a href="#"><i class="ion-location"></i> <span class="nav-label">Maps</span></a>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="gmap.html"> Google Map</a></li>--}}
                            {{--<li><a href="vector-map.html"> Vector Map</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}

                </ul>
            </nav>



</aside>
        <!-- Aside Ends-->



