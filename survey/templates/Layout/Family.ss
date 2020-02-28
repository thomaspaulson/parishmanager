    <div class="grid-x grid-padding-x">
        <div class="large-9 medium-9 cell  small-order-1 medium-order-2">         


            <ul class="tabs" data-tabs id="family-tabs">
                <li class="tabs-title is-active"><a href="#family" aria-selected="true">Family</a></li>
                <li class="tabs-title"><a data-tabs-target="housing" href="#housing">Housing</a></li>
                <li class="tabs-title"><a data-tabs-target="occupation" href="#occupation">Occupation</a></li>
                <li class="tabs-title"><a data-tabs-target="monthly" href="#monthly">Monthly</a></li>
                <li class="tabs-title"><a data-tabs-target="others" href="#others">Other Details</a></li>
                <li class="tabs-title"><a data-tabs-target="financial" href="#financial">Financial</a></li>

            </ul>   
            <div class="tabs-content" data-tabs-content="family-tabs">
                <div class="tabs-panel is-active" id="family">
                        <h5>Search</h5>                    
                        $ParishSearchForm	                    
                        $LocationSearchForm						

                </div>
                <div class="tabs-panel" id="housing">
                        $HouseSearchForm
                        $LandSearchForm
                        $ShiftedFromSearchForm                
                </div>
                <div class="tabs-panel" id="occupation">
                        $AgricultureSearchForm
                        $BusinessSearchForm

                </div>
                <div class="tabs-panel" id="monthly">
                        $MonthlyIncomeSearchForm
                        $MonthlyExpenseSearchForm
                
                </div>

                <div class="tabs-panel" id="others">
                        $VehicleSearchForm
                        $ApplianceSearchForm
                        $OtherFacilitySearchForm
                        $MediaSearchForm
                
                </div>

                <div class="tabs-panel" id="financial">
                        $LoanSearchForm
                        $SavingSearchForm
                
                </div>
            </div>        

        </div>
        <div class="large-3 medium-3 cell small-order-2 medium-order-1">
            <% include FamilySideBar %>
        </div>
    </div>


