<div class="grid-x grid-padding-x">
    <div class="large-12 cell">
		<div class="panel">
		<% with Family %>		
			<h3>$Name</h3>
			<!--<a href="family/print-family/$ID" target="_blank" title="Print"> Print <i class="fi-print"></i></a>-->
			<a href="family/edit-family/$ID?&BackURL=$Top.RequestedURL" title="Edit $Name"><i class="fi-page-edit"></i> Edit</a>
			|
			<a href="$Top.GoBackURL" title="Go back"><i class="fi-page-edit"></i> Go back</a>
	        <div class="grid-x grid-padding-x">			
	            <div class="large-6 cell">
					$Address, $Pincode (pin) <br>
					House no: $HouseNo <br>
					Panchayat: $InPanchayat <br>
					Municipality: $InMunicipality <br>
					Corporation: $InCorporation <br>
					Remark: <br>
					$Remark

	            </div>
	            <div class="large-6 cell">
	            	Parish: $Parish.NameWithLocation <br>
					Block no: $BlockNo <br>
	                Unit no: $UnitNo <br>
					Family no: $FamilyNo<br>
					ContactNo: $ContactNo<br>
					Email: $Email<br>
					Aadhaar: $Aadhaar<br>


              </div>
       	</div>
        </div>
		<hr>
		
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
				<a name="members"></a> 
				<h4 class="subheader">Members</h4>
						<a href="members/add-member?FamilyID=$ID&BackURL=$Top.RequestedURL(#members)" title="Add member"><i class="fi-page-add"></i> Add member</a>
						<% if FamilyMembers %>
							<table>
							<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Gender</th>
								<th>DOB / Age</th>
								<th>Blood G / Status</th>
								<th>Relation</th>
								<th></th>
							</tr>
							</thead>
							<tbody>							
						<% loop FamilyMembers %>
							<tr>
								<td>$ID</td>
								<td>$Name</td>
								<td>{$Sex}</td>
								<td><% if $DateOfBirth %>$DateOfBirth.Format('d-m-Y') | $Age yrs <% else %> $Age years<% end_if %></td>
								<td>$BloodGroup / $MStatus</td>
								<td>$Relation</td>	
								<td>
								<a href="{$Link('view')}?&BackURL=$Top.RequestedURL(#members)" title="View $Name"><i class="fi-page"></i></a>
								| 
								<a href="{$Link('edit-member')}?&BackURL=$Top.RequestedURL(#members)" title="Edit $Name"><i class="fi-page-edit"></i></a>
								|
								<a href="{$Link('delete-member')}?&BackURL=$Top.RequestedURL(#members)" title="Delete $Name" onclick="return confirm('Are you sure?');"><i class="fi-page-delete"></i></a>							
								</td>														
							</tr>						
						<% end_loop %>
							</tbody>						
							</table>
						<% end_if %>
				<hr>
				
				<h4 class="subheader">Housing</h4>
						<a name="housing"></a> 		
						<h5 class="subheader">House</h5>
						<% if not $House %>
							<a href="house/add-house?FamilyID=$ID&BackURL=$Top.RequestedURL(#housing)"><i class="fi-page-add"></i> Add</a>
						<% else %>
						<% end_if %>				
						<% if $House %>						
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell">
								House: $House.Status<br>								
								Ration-Card Holder: $House.RationCardHolder<br>
								HouseType: $House.Type
							</div>			
						    <div class="large-6 cell">								
								Card Type: $House.CardType.UpperCase<br>
								Build Year: $House.BuildYear
							</div>
						</div>
							<% with $House %>
								<a href="house/edit-house/$ID?BackURL=$Top.RequestedURL(#housing)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>						
						<% end_if %>
						<a name="land"></a> 		
						<h5 class="subheader">Land</h5>
						<% if not $Land %>
							<a href="land/add-land?FamilyID=$ID&BackURL=$Top.RequestedURL(#land)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>
						<% if $Land %>						
				        <div class="grid-x grid-padding-x">
						    <div class="large-4 cell">
								HoldsLand: $Land.LandHolder							
							</div>
						    <div class="large-4 cell">
								Area: $Land.Area							
							</div>										
						    <div class="large-4 cell">
								Total Land: $Land.InCent cents
							</div>
						</div>
							<% with $Land %>
								<a href="land/edit-land/$ID?BackURL=$Top.RequestedURL(#land)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>					
						
						<% end_if %>
						<a name="shiftedfrom"></a> 		
						<h5 class="subheader">Shifted Form</h5>
						<% if not $ShiftedFrom %>
							<a href="shifted-from/add-shifted-from?FamilyID=$ID&BackURL=$Top.RequestedURL(#shiftedfrom)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>		
										
						<% if $ShiftedFrom %>												
				        <div class="grid-x grid-padding-x">
						    <div class="large-4 cell">
								Status : $ShiftedFrom.Shifted							
							</div>
						    <div class="large-4 cell">
								From Where: $ShiftedFrom.FromWhere							
							</div>										
						    <div class="large-4 cell">
								Reason: $ShiftedFrom.Reason
							</div>
						</div>
							<% with $ShiftedFrom %>
								<a href="shifted-from/edit-shifted-from/$ID?BackURL=$Top.RequestedURL(#shiftedfrom)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>					
							
                        <% end_if %>
				<hr>
				<h4 class="subheader">Occupation</h4>
						<a name="agriculture"></a> 		
						<h4 class="subheader">Agriculture</h4>
						<% if not $Agriculture %>
							<a href="agriculture/add-agriculture?FamilyID=$ID&BackURL=$Top.RequestedURL(#agriculture)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>								
						
						<% if $Agriculture %>
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell">
								<% if $Agriculture.Cocunut %>Cocunut, <% end_if %> 														
								<% if $Agriculture.Produce %>Produce, <% end_if %> 							
								<% if $Agriculture.Paddy %>Paddy, <% end_if %> 														
								<% if $Agriculture.Fruit %>Fruit <% end_if %> 															
							</div>
							
						    <div class="large-6 cell">
								<% if $Agriculture.Others %>others : $Agriculture.Specify<% end_if %> 
							</div>										
						</div>
							<% with $Agriculture %>
								<a href="agriculture/edit-agriculture/$ID?BackURL=$Top.RequestedURL(#agriculture)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>					
						
						<% end_if %>
						<a name="business"></a>
						<h4 class="subheader">Business</h4>
						<% if not $Business %>
							<a href="business/add-business?FamilyID=$ID&BackURL=$Top.RequestedURL(#business)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>											
						
						<% if $Business %>			
						<div class="grid-x grid-padding-x">	
						    <div class="large-6 cell">
								<% if $Business.Streetvendor %>Streetvendor, <% end_if %> 														
								<% if $Business.Unduvandi %>Unduvandi, <% end_if %> 							
								<% if $Business.Pettikada %>Pettikada, <% end_if %> 														
								<% if $Business.Shop %>Shop <% end_if %> 															
							</div>
							
						    <div class="large-6 cell">
								<% if $Business.Others %>others : $Business.Specify<% end_if %> 
							</div>										
						</div>	
							<% with $Business %>
								<a href="business/edit-business/$ID?BackURL=$Top.RequestedURL(#business)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>					
						
						<% end_if %>
				<hr>
				<h4 class="subheader">Monthly</h4>
						<a name="monthlyincome"></a>
						<h5 class="subheader">Monthly Income</h5>
						<% if not $MonthlyIncome %>
							<a href="monthlyincome/add-monthly-income?FamilyID=$ID&BackURL=$Top.RequestedURL(#monthlyincome)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>											
						
						<% if $MonthlyIncome %>
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell last">
								Total : $MonthlyIncome.Total							
							</div>																	
						</div>
							<% with $MonthlyIncome %>
								<a href="monthlyincome/edit-monthly-income/$ID?BackURL=$Top.RequestedURL(#monthlyincome)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>					
						
						<% end_if %>
						<a name="monthlyexpense"></a>
						<h5 class="subheader">Monthly Expense</h5>						
						<% if not $MonthlyExpense %>
							<a href="monthlyexpense/add-monthly-expense?FamilyID=$ID&BackURL=$Top.RequestedURL(#monthlyexpense)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>											

						<% if $MonthlyExpense %>
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell">
								Education : $MonthlyExpense.Education							
							</div>
						    <div class="large-6 cell">
								Medical : $MonthlyExpense.Medical							
							</div>										
							
						</div>	
						<div class="grid-x grid-padding-x">							
						    <div class="large-6 cell">
								Others : $MonthlyExpense.Others							
							</div>										
						    <div class="large-6 cell">
								Total : $MonthlyExpense.Total							
							</div>																	
						</div>
							<% with $MonthlyExpense %>
								<a href="monthlyexpense/edit-monthly-expense/$ID?BackURL=$Top.RequestedURL(#monthlyexpense)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>					
						
						<% end_if %>
						
				<hr>		
				<h4 class="subheader">Other Details</h4>
						<a name="vehicle"></a>
						<h5 class="subheader">Vehicle</h5>
						<% if not $Vehicle %>
							<a href="vehicle/add-vehicle?FamilyID=$ID&BackURL=$Top.RequestedURL(#vehicle)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																	

						<% if $Vehicle %>
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell">
								<% if $Vehicle.Cycle %>Cycle, <% end_if %> 														
								<% if $Vehicle.Bike %>Bike, <% end_if %> 							
								<% if $Vehicle.Autoriskaw %>Autoriskaw, <% end_if %> 														
								<% if $Vehicle.LightVehicle %>LightVehicle <% end_if %> 															
							</div>							
						    <div class="large-6 cell">
								<% if $Vehicle.Others %>others : $Vehicle.Specify<% end_if %> 
							</div>										
							
						</div>	    
   							<% with $Vehicle %>
								<a href="vehicle/edit-vehicle/$ID?BackURL=$Top.RequestedURL(#vehicle)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>					

						<% end_if %>
						
						
						<a name="appliance"></a>
						<h5 class="subheader">Appliance</h5>
						<% if not $Appliance %>
							<a href="appliance/add-appliance?FamilyID=$ID&BackURL=$Top.RequestedURL(#appliance)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																	
						
						<% if $Appliance %>						
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell">
								<% if $Appliance.WashingMachine %>WashingMachine, <% end_if %> 														
								<% if $Appliance.AirConditioner %>AirConditioner, <% end_if %> 							
								<% if $Appliance.MicrowaveOven %>MicrowaveOven, <% end_if %> 														
								<% if $Appliance.CookingGas %>CookingGas <% end_if %> 															
							</div>							
						    <div class="large-6 cell">
								<% if $Appliance.Others %>others : $Appliance.Specify<% end_if %> 
							</div>									
							
						</div>	    
   							<% with $Appliance %>
								<a href="appliance/edit-appliance/$ID?BackURL=$Top.RequestedURL(#appliance)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>							
						<% end_if %>
						
						<a name="otherfacility"></a>
						<h5 class="subheader">Other Facility</h5>
						
						<% if not $OtherFacility %>
							<a href="otherfacility/add-otherfacility?FamilyID=$ID&BackURL=$Top.RequestedURL(#otherfacility)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																	
						
						<% if $OtherFacility %>						
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell">
								<% if $OtherFacility.WaterWell %>WaterWell, <% end_if %> 														
								<% if $OtherFacility.DrillWell %>DrillWell, <% end_if %> 							
								<% if $OtherFacility.WaterConnection %>WaterConnection, <% end_if %> 														
								<% if $OtherFacility.RainwaterStorage %>RainwaterStorage <% end_if %> 															
							</div>							
						    <div class="large-6 cell">								
							</div>									
							
						</div>	    
   							<% with $OtherFacility %>
								<a href="otherfacility/edit-otherfacility/$ID?BackURL=$Top.RequestedURL(#otherfacility)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>							
						<% end_if %>

						
						<a name="media"></a>
						<h5 class="subheader">Media</h5>
						
						<% if not $Media %>
							<a href="media/add-media?FamilyID=$ID&BackURL=$Top.RequestedURL(#media)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																	
						
						<% if $Media %>						
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell">
								<% if $Media.Newspaper %>Newspaper, <% end_if %> 														
								<% if $Media.Television %>Television, <% end_if %> 							
								<% if $Media.Magazine %>Magazines, <% end_if %> 														
								<% if $Media.KidsMagazine %>KidsMagazine <% end_if %> 															
							</div>							
						    <div class="large-6 cell">
								<% if $Media.Others %>others : $Media.Specify<% end_if %> 								
							</div>
						</div>	    
   							<% with $Media %>
								<a href="media/edit-media/$ID?BackURL=$Top.RequestedURL(#media)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>							
						<% end_if %>
						

				<hr>
				<h4 class="subheader">Financial</h4>
						<a name="loan"></a>
						<h5 class="subheader">Loan</h5>
						<% if not $Loan %>
							<a href="loan/add-loan?FamilyID=$ID&BackURL=$Top.RequestedURL(#loan)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																							

						<% if $Loan %>
				        <div class="grid-x grid-padding-x">
						    <div class="large-12 cell">
								Has Loan : $Loan.OnLoan()							
							</div>										
						</div>				
   							<% with $Loan %>
								<a href="loan/edit-loan/$ID?BackURL=$Top.RequestedURL(#loan)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>							
									
						<% end_if %>
						<a name="saving"></a>
						<h5 class="subheader">Savings</h5>
						<% if not $Saving %>
							<a href="saving/add-saving?FamilyID=$ID&BackURL=$Top.RequestedURL(#saving)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																							
						
						<% if $Saving %>						
				        <div class="grid-x grid-padding-x">
						    <div class="large-6 cell">
								<% if $Saving.EducationFund %>EducationFund, <% end_if %> 														
								<% if $Saving.LifeInsurance %>LifeInsurance, <% end_if %> 							
								<% if $Saving.HealthInsurance %>HealthInsurance, <% end_if %> 														
								<% if $Saving.DeathFund %>DeathFund <% end_if %> 															
							</div>							
						    <div class="large-6 cell">
								<% if $Saving.Others %>others : $Saving.Specify<% end_if %> 								
							</div>
						</div>	    
   							<% with $Saving %>
								<a href="saving/edit-saving/$ID?BackURL=$Top.RequestedURL(#saving)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>							
						<% end_if %>
						
					
                </div>
			</div>	
		</div>
		<% end_with %>
		
    </div>
</div>
