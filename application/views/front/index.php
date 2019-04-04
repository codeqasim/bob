<div style="margin-top:-75px" ng-controller="Home" class="theme-hero-area theme-hero-area-primary">
            <div class="theme-hero-area-bg-wrap">
                <div class="theme-hero-area-bg ws-action" style="background-image:url(./assets/img/hero.png);" data-parallax="true"></div>
                <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
                <div class="theme-hero-area-inner-shadow theme-hero-area-inner-shadow-light"></div>
            </div>
            <div class="theme-hero-area-body">
                <div class="_pt-250 _pb-200 _pv-mob-50">
                    <div class="container">
                        <div class="theme-search-area-tabs">
                            <div class="theme-search-area-tabs-header _c-w _ta-mob-c">
                                <h1 class="theme-search-area-tabs-title">Start Your Jorney</h1>
                                <p class="theme-search-area-tabs-subtitle">Compare hundreds travel websites at once</p>
                            </div>
                            <div class="tabbable">
                                <ul class="nav nav-tabs nav-line nav-white nav-lg nav-mob-inline" role="tablist">
                                    <li class="" role="presentation">
                                        <a aria-controls="SearchAreaTabs-1" role="tab" data-toggle="tab" href="#SearchAreaTabs-1">Hotels</a>
                                    </li>
                                    <li class="active" role="presentation">
                                        <a aria-controls="SearchAreaTabs-3" role="tab" data-toggle="tab" href="#SearchAreaTabs-3">Flights</a>
                                    </li>
                                </ul>
                                <div class="tab-content _pt-20">
                                    <div class="tab-pane" id="SearchAreaTabs-1" role="tab-panel">
                                        <div class="theme-search-area theme-search-area-stacked">
                                            <div class="theme-search-area-form">
                                                <div class="row" data-gutter="none">
                                                    <div class="col-md-3 ">
                                                        <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                                            <div class="theme-search-area-section-inner">
                                                                <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                                                <input class="theme-search-area-section-input typeahead" type="text" placeholder="Hotel Location" data-provide="typeahead"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="row" data-gutter="none">
                                                            <div class="col-md-6 ">
                                                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                                                        <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                                                                        <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 ">
                                                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                                                        <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                                                                        <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="row" data-gutter="none">
                                                            <div class="col-md-6 ">
                                                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr quantity-selector" data-increment="Rooms">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-tag"></i>
                                                                        <input class="theme-search-area-section-input" value="1 Room" type="text"/>
                                                                        <div class="quantity-selector-box" id="HotelSearchRooms">
                                                                            <div class="quantity-selector-inner">
                                                                                <p class="quantity-selector-title">Rooms</p>
                                                                                <ul class="quantity-selector-controls">
                                                                                    <li class="quantity-selector-decrement">
                                                                                        <a href="#">&#45;</a>
                                                                                    </li>
                                                                                    <li class="quantity-selector-current">1</li>
                                                                                    <li class="quantity-selector-increment">
                                                                                        <a href="#">&#43;</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 ">
                                                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr quantity-selector" data-increment="Guests">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-people"></i>
                                                                        <input class="theme-search-area-section-input" value="2 Guests" type="text"/>
                                                                        <div class="quantity-selector-box" id="HotelSearchGuests">
                                                                            <div class="quantity-selector-inner">
                                                                                <p class="quantity-selector-title">Guests</p>
                                                                                <ul class="quantity-selector-controls">
                                                                                    <li class="quantity-selector-decrement">
                                                                                        <a href="#">&#45;</a>
                                                                                    </li>
                                                                                    <li class="quantity-selector-current">1</li>
                                                                                    <li class="quantity-selector-increment">
                                                                                        <a href="#">&#43;</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 ">
                                                        <button class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-search-area-options _mob-h theme-search-area-options-white theme-search-area-options-dot-primary-inverse clearfix">
                                                <div class="btn-group theme-search-area-options-list" data-toggle="buttons">
                                                    <label class="btn btn-primary active">
                                                        <input type="radio" name="hotel-options" id="hotel-option-1" checked/>Any
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="hotel-options" id="hotel-option-2"/>Business
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="hotel-options" id="hotel-option-3"/>Family
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="hotel-options" id="hotel-option-4"/>Luxury
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="hotel-options" id="hotel-option-5"/>Budget
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="hotel-options" id="hotel-option-6"/>Romantic
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane active" id="SearchAreaTabs-3" role="tab-panel">
                                        <div class="theme-search-area theme-search-area-stacked">
                                            <div class="theme-search-area-form">
                                                <div class="row" data-gutter="none">
                                                    <div class="col-md-5 ">
                                                        <div class="row" data-gutter="none">
                                                            <div class="col-md-6 ">
                                                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                                                         <input class="theme-search-area-section-input" type="text"  typeahead-on-select="setflyFrom($item)" ng-model="payload.flyFrom" typeahead="state.name for state in states | filter:$viewValue" ng-change="getStates('origin')"/>
                                                                        <!--nput ng-model="payload.flyFrom" class="theme-search-area-section-input typeahead" type="text" placeholder="Departure" data-provide="typeahead"/>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 ">
                                                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                                                        <input class="theme-search-area-section-input" type="text"  typeahead-on-select="setto($item)" ng-model="payload.to" typeahead="state.name for state in states | filter:$viewValue" ng-change="getStates('destination')"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="row" data-gutter="none">
                                                            <div class="col-md-4 ">
                                                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                                                        <input ng-model="payload.dateFrom" class="theme-search-area-section-input datePickerStart _mob-h" value="01/04/2019" type="text" placeholder="Check-in"/>
                                                                        <!--<input class="theme-search-area-section-input _desk-h mobile-picker" value="2019-04-01" type="date"/>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                                                        <input ng-model="payload.dateTo" class="theme-search-area-section-input datePickerEnd _mob-h" value="01/04/2019" type="text" placeholder="Check-out"/>
                                                                        <!--<input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-bg-white theme-search-area-section-no-border theme-search-area-section-mr quantity-selector" data-increment="Passengers">
                                                                    <div class="theme-search-area-section-inner">
                                                                        <i class="theme-search-area-section-icon lin lin-people"></i>
                                                                        <input ng-model="payload.adults" class="theme-search-area-section-input" value="1" type="text"/>
                                                                        <div class="quantity-selector-box" id="FlySearchPassengers">
                                                                            <div class="quantity-selector-inner">
                                                                                <p class="quantity-selector-title">Passengers</p>
                                                                                <ul class="quantity-selector-controls">
                                                                                    <li class="quantity-selector-decrement">
                                                                                        <a href="#">&#45;</a>
                                                                                    </li>
                                                                                    <li class="quantity-selector-current">1</li>
                                                                                    <li class="quantity-selector-increment">
                                                                                        <a href="#">&#43;</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 ">
                                                        <button ng-click="search()" class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-search-area-options theme-search-area-options-white theme-search-area-options-dot-primary-inverse clearfix">
                                                <div class="btn-group theme-search-area-options-list" data-toggle="buttons">
                                                    <label class="btn btn-primary active">
                                                        <input type="radio" name="flight-options" id="flight-option-1" checked/>Round Trip
                                                    </label>
                                                    <label class="btn btn-primary">
                                                        <input type="radio" name="flight-options" id="flight-option-2"/>One Way
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>