<nav class="navbar navbar-static-top navbar-inverse mt-25">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>supplier/dashboard">Dashboard</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class=""><a href="<?php echo base_url(); ?>supplier/booking">Booking</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inventory <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">All</a></li>
                                    <li><a href="#">Availability</a></li>
                                    <li><a href="#">Availability</a></li>
                                    <li><a href="#">Min-Stay Through</a></li>
                                    <li><a href="#">Min-Stay Arrival</a></li>
                                    <li><a href="#">Max-Stay</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Close to Arrival</a></li>
                                    <li><a href="#">Close to Departure</a></li>
                                    <li><a href="#">Stop Sell</a></li>
                                    <li><a href="#">Close Out</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="<?php echo base_url(); ?>supplier/offers">Offers</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Website <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Credit Report</a></li>
                                    <li><a href="#">Daily Checkout Report</a></li>
                                    <li><a href="#">Booking Report</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">House Keeping Report</li>
                                    <li><a href="#">Channel Report</a></li>
                                    <li><a href="#">Extras Report</a></li>
                                    <li><a href="#">Meal Report</a></li>
                                    <li><a href="#">Occupancy Report</a></li>
                                    <li><a href="#">Debtors Report</a></li>
                                    <li><a href="#">In-House Report</a></li>
                                    <li><a href="#">Folio Report</a></li>
                                    <li><a href="#">immigration Report</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                          <li><a href="<?php echo base_url('supplier/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">