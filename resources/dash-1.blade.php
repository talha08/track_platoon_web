<!--
@extends('layouts.default')
@section('content')

        <!-- Page Content Start -->
<!-- ================== -->


<div class="page-title">
    <h3 class="title">Portlets</h3>
</div>

<div class="row">






    User Statistics start

    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-primary">
                <h3 class="portlet-title">
                    <i class="fa fa-users" aria-hidden="true"></i>
                   User Statistics
                </h3>
                <div class="portlet-widgets">
                    <a href="javascript:;" data-toggle="reload"><i class="fa fa-refresh"></i></a>
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
                    <span class="divider"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bg-primary" class="panel-collapse collapse in">
                <div class="portlet-body">

                    <!-- Internal panel Start -->

                    <div class="row">

                        <div class="col-lg-6 col-sm-8">
                            <div class="widget-panel widget-style-2 white-bg">
                                <i class="ion-eye text-pink"></i>
                                <h2 class="m-0 counter">50</h2>
                                <div>Daily Visits</div>
                            </div>
                            <div class="widget-panel widget-style-2 white-bg">
                                <i class="ion-eye text-pink"></i>
                                <h2 class="m-0 counter">50</h2>
                                <div>Daily Visits</div>
                            </div>
                        </div>



                        <div class="col-lg-3 col-sm-8">
                            <div class="widget-panel widget-style-2 white-bg">
                                <i class="ion-eye text-pink"></i>
                                <h2 class="m-0 counter">50</h2>
                                <div>Daily Visits</div>
                            </div>
                            <div class="widget-panel widget-style-2 white-bg">
                                <i class="ion-eye text-pink"></i>
                                <h2 class="m-0 counter">50</h2>
                                <div>Daily Visits</div>
                            </div>
                        </div>


                        <div class="col-lg-3 col-sm-8">
                            <div class="widget-panel widget-style-2 white-bg">
                                <i class="ion-eye text-pink"></i>
                                <h2 class="m-0 counter">50</h2>
                                <div>Daily Visits</div>
                            </div>
                            <div class="widget-panel widget-style-2 white-bg">
                                <i class="ion-eye text-pink"></i>
                                <h2 class="m-0 counter">50</h2>
                                <div>Daily Visits</div>
                            </div>
                        </div>


                    </div>
                    <!-- Internal panel end -->

                </div>
            </div>
        </div>
    </div>

    User Statistics end





    Monthly Statistics start

    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-primary">
                <h3 class="portlet-title">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    Monthly Statistics
                </h3>
                <div class="portlet-widgets">
                    <a href="javascript:;" data-toggle="reload"><i class="fa fa-refresh"></i></a>
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
                    <span class="divider"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bg-primary" class="panel-collapse collapse in">
                <div class="portlet-body">

                    <div class="row">

                        <!-- Internal panel Start -->


                        <div class="col-lg-12">
                            <div class="portlet"><!-- /primary heading -->
                                <div class="portlet-heading">
                                    <h3 class="portlet-title text-dark text-uppercase">
                                        Yearly Sales Report
                                    </h3>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i class="fa fa-refresh"></i></a>
                                        <span class="divider"></span>
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                        <span class="divider"></span>
                                        <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="portlet2" class="panel-collapse collapse in">
                                    <div class="portlet-body">
                                        <div id="morris-area-example" style="height: 320px;"></div>
                                        <div class="row text-center m-t-30 m-b-30">
                                            <div class="col-sm-3 col-xs-6">
                                                <h4>$ 126</h4>
                                                <small class="text-muted"> Today's Sales</small>
                                            </div>
                                            <div class="col-sm-3 col-xs-6">
                                                <h4>$ 967</h4>
                                                <small class="text-muted">This Week's Sales</small>
                                            </div>
                                            <div class="col-sm-3 col-xs-6">
                                                <h4>$ 4500</h4>
                                                <small class="text-muted">This Month's Sales</small>
                                            </div>
                                            <div class="col-sm-3 col-xs-6">
                                                <h4>$ 87,000</h4>
                                                <small class="text-muted">This Year's Sales</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /Portlet -->

                        <!-- Internal panel end -->
                    </div>

                </div>
            </div>
        </div>
    </div>


    Monthly Statistic end







































    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-primary">
                <h3 class="portlet-title">
                    Primary Heading
                </h3>
                <div class="portlet-widgets">
                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
                    <span class="divider"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bg-primary" class="panel-collapse collapse in">
                <div class="portlet-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
                </div>
            </div>
        </div>
    </div>




    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-primary">
                <h3 class="portlet-title">
                    Purple Heading
                </h3>
                <div class="portlet-widgets">
                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-purple"><i class="ion-minus-round"></i></a>
                    <span class="divider"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bg-purple" class="panel-collapse collapse in">
                <div class="portlet-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
                </div>
            </div>
        </div>
    </div>

</div> <!-- End row -->



@endsection





@section('script')
        <!-- js placed at the end of the document so the pages load faster -->

    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/chat/moment-2.2.1.js"></script>

    <!-- Counter-up -->
    <script src="js/waypoints.min.js" type="text/javascript"></script>
    <script src="js/jquery.counterup.min.js" type="text/javascript"></script>

    <!-- EASY PIE CHART JS -->
    <script src="assets/easypie-chart/easypiechart.min.js"></script>
    <script src="assets/easypie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/easypie-chart/example.js"></script>


    <!--C3 Chart-->
    <script src="assets/c3-chart/d3.v3.min.js"></script>
    <script src="assets/c3-chart/c3.js"></script>

    <!--Morris Chart-->
    <script src="assets/morris/morris.min.js"></script>
    <script src="assets/morris/raphael.min.js"></script>

    <!-- sparkline -->
    <script src="assets/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="assets/sparkline-chart/chart-sparkline.js" type="text/javascript"></script>

    <!-- sweet alerts -->
    <script src="assets/sweet-alert/sweet-alert.min.js"></script>
    <script src="assets/sweet-alert/sweet-alert.init.js"></script>


    <!-- Chat -->
    <script src="js/jquery.chat.js"></script>
    <!-- Dashboard -->
    <script src="js/jquery.dashboard.js"></script>

    <!-- Todo -->
    <script src="js/jquery.todo.js"></script>


    <script type="text/javascript">
          /* ==============================================
                Counter Up
            =============================================== */
        jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 100,
                time: 1200
            });
        });
    </script>


@endsection
