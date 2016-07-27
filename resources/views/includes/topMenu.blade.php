<!-- Header -->
<section class="content">
<header class="top-head container-fluid" style=" background: #3f51b5;">
                <button type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>



                <!-- Search -->
    <!--             <form role="search" class="navbar-left app-search pull-left hidden-xs">
                   <input type="text" placeholder="Search..." class="form-control">
                   <a href="#"><i class="fa fa-search"></i></a>
                 </form>
      -->
                <!-- Left navbar -->



                <nav class=" navbar-default" role="navigation">

                    <ul class="nav navbar-nav hidden-xs">
                        <li style="font-size: large">
                            <a href="#" style="color: #ffffff;  padding: 3px 2px;">

                                <h4>
                                    {!! $title !!}<br>
                                </h4>

                                <h6 style="font-size:small;color: #96a588;">
                                    @include('includes.year')
                                </h6>
                                {{--<br> <p style="font-size: x-small">dfu</p>--}}
                            </a>
                        </li>
                    </ul>



                    <ul class="nav navbar-nav hidden-xs ">
                        <li id="centerNav" style="font-size: large">
                            <a href="#" style="color: #ffffff;padding-left: 6cm;">
                               @include('includes.date')
                            </a>
                        </li>
                    </ul>


                    {{--<ul class="nav navbar-nav hidden-xs ">--}}
                        {{--<li id="centerNav" style="font-size: large">--}}
                            {{--<a href="#" style="color: #ffffff">--}}
                                {{--@include('includes.year')--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}

                    <!-- Right navbar -->

                    <ul class="nav navbar-nav navbar-right top-menu top-right-menu">

                        {{--@include('includes.notificationMenu')--}}
                        {{--@include('includes.inboxMenu')--}}
                        @include('includes.profileMenu')

                    </ul>
                    <!-- End right navbar -->

                </nav>

            </header>


<!-- Header Ends -->

