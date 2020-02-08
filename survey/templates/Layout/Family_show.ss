<div class="row main">
    <div class="large-12 columns">
		<% with Family %>		
        <h3>$Name</h3>
		<a href="family/print-family/$ID" target="_blank" title="Print"> Print <i class="fi-print"></i></a>
        <div class="row">			
            <div class="large-6 columns">
				$Address, $Pincode <br>
				House no: $HouseNo <br>
				Panchayat: $InPanchayat <br>
				Municipality: $InMunicipality <br>
				Corporation: $InCorporation 

            </div>
            <div class="large-6 columns">
				Block no: $BlockNo <br>
                Unit no: $UnitNo <br>
				Unit no: $FamilyNo <br>
				Parish: $Parish.NameWithLocation
                </div>
            </div>
        </div>
		
        <div class="row">
            <div class="large-12 columns">
				<hr>			    
                <ul class="tabs" data-tab>                    
                    <li class="tab-title active"><a href="#members">Members</a></li>
					<li class="tab-title "><a href="#housing">Housing</a></li>
					<li class="tab-title "><a href="#occupation">Occupation</a></li>
					<li class="tab-title "><a href="#monthly">Monthly</a></li>
					<li class="tab-title "><a href="#others">Other Details</a></li>
					<li class="tab-title "><a href="#financial">Financial</a></li>
					<li class="tab-title "><a href="#contact">Contact</a></li>
                </ul>
                <div class="tabs-content">
                    <div class="content active" id="members">
						<h4 class="subheader">Members</h4>
						<% if FamilyMembers %>
							<table>
							<thead>
							<tr>
								<th width="2%">#</th>
								<th width="20%">Name</th>
								<th width="20%">Gender</th>
								<th width="20%">DOB / Age</th>
								<th width="20%">Blood Group / Martial Status</th>
								<th width="18%"></th>
							</tr>
							</thead>
							<tbody>							
						<% loop FamilyMembers %>
							<tr>
								<td>$ID</td>
								<td>$Name</td>
								<td>{$Sex}</td>
								<td>{$DateOfBirth.Format('d-m-Y')} / {$Age} yrs</td>
								<td>$BloodGroup / $MStatus</td>
								<td>$Relation</td>							
							</tr>						
						<% end_loop %>
							</tbody>						
							</table>
						<% end_if %>
						
                    </div>					
                    <div class="content" id="housing">
						<% if $House %>
						<h4 class="subheader">House</h4>
				        <div class="row">
						    <div class="large-6 columns">
								Status: $House.Status<br>								
								Ration-Card Holder: $House.RationCardHolder<br>
								HouseType: $House.HouseType
							</div>			
						    <div class="large-6 columns">
								Amount: $House.Amount<br>
								Card Type: $House.CardType.UpperCase<br>
								Build Year: $House.BuildYear
							</div>
						</div>
						<% end_if %>
						<% if $Land %>
						<h4 class="subheader">Land</h4>
				        <div class="row">
						    <div class="large-4 columns">
								HoldsLand: $Land.LandHolder							
							</div>
						    <div class="large-4 columns">
								Area: $Land.Area							
							</div>										
						    <div class="large-4 columns">
								Total Land: $Land.InCent cents
							</div>
						</div>
						<% end_if %>
						<% if $ShiftedFrom %>
						<h4 class="subheader">Shifted Form</h4>
				        <div class="row">
						    <div class="large-4 columns">
								Status : $ShiftedFrom.Shifted							
							</div>
						    <div class="large-4 columns">
								From Where: $ShiftedFrom.FromWhere							
							</div>										
						    <div class="large-4 columns">
								Reason: $ShiftedFrom.Reason
							</div>
						</div>	
                        <% end_if %>
                    </div>
                    <div class="content " id="occupation">
						<% if $Agriculture %>
						<h4 class="subheader">Agriculture</h4>
				        <div class="row">
						    <div class="large-6 columns">
								Type: $Agriculture.Type							
							</div>
						    <div class="large-6 columns">
								others : $Agriculture.Other							
							</div>										
						</div>
						<% end_if %>
						<% if $Business %>
						<h4 class="subheader">Business</h4>
				        <div class="row">
						    <div class="large-6 columns">
								Type: $Business.Type							
							</div>
						    <div class="large-6 columns">
								others : $Business.Other							
							</div>										
						</div>
						<% end_if %>
						
						
                    </div>
                    <div class="content " id="monthly">
						<% if $MonthlyIncome %>
						<h4 class="subheader">Monthly Income</h4>
				        <div class="row">
						    <div class="large-6 columns">
								Land: $MonthlyIncome.Land							
							</div>
						    <div class="large-6 columns">
								Job : $MonthlyIncome.Job							
							</div>
						</div>	
						<div class="row">							
						    <div class="large-6 columns">
								Others : $MonthlyIncome.Others							
							</div>										
						    <div class="large-6 columns">
								Total : $MonthlyIncome.Total							
							</div>																	
						</div>
						<% end_if %>
						<% if $MonthlyExpense %>
						<h4 class="subheader">Monthly Expense</h4>
				        <div class="row">
						    <div class="large-6 columns">
								Food: $MonthlyExpense.Food							
							</div>
						    <div class="large-6 columns">
								Education : $MonthlyExpense.Education							
							</div>
						</div>	
						<div class="row">							
						    <div class="large-6 columns">
								Medical : $MonthlyExpense.Medical							
							</div>										
						    <div class="large-6 columns">
								Mobile : $MonthlyExpense.Mobile							
							</div>																	
						</div>
						<div class="row">							
						    <div class="large-6 columns">
								Others : $MonthlyExpense.Others							
							</div>										
						    <div class="large-6 columns">
								Total : $MonthlyExpense.Total							
							</div>																	
						</div>
						<% end_if %>
                    </div>
                    <div class="content " id="others">
						<% if $Vehicle %>
						<h4 class="subheader">Vehicle</h4>
				        <div class="row">
						    <div class="large-4 columns">
								Has Cycle : $Vehicle.HasCycle							
							</div>
						    <div class="large-4 columns">
								Has Bike : $Vehicle.HasBike							
							</div>										
						    <div class="large-4 columns">
								Has Autoriskaw : $Vehicle.HasAutoriskaw							
							</div>
						</div>	
				        <div class="row">
						    <div class="large-4 columns">
								Has LightVehicle : $Vehicle.HasLightVehicle
							</div>
						    <div class="large-4 columns">
								Has HeavyCommercial : $Vehicle.HasHeavyCommercial						
							</div>										
						    <div class="large-4 columns">
								Has CountryBoat : $Vehicle.HasCountryBoat							
							</div>
						</div>	
				        <div class="row">
						    <div class="large-4 columns">
								Has Vallam : $Vehicle.HasVallam
							</div>
						    <div class="large-4 columns">
								Has FishingBoat : $Vehicle.HasFishingBoat					
							</div>										
						    <div class="large-4 columns">
								Has TouristBoat : $Vehicle.HasTouristBoat		
							</div>
						</div>	          
						<% end_if %>
						<% if $Appliance %>
						<h4 class="subheader">Appliance</h4>
				        <div class="row">
						    <div class="large-4 columns">
								Has Computer : $Appliance.HasOrNot('Computer')							
							</div>
						    <div class="large-4 columns">
								Has WashingMachine : $Appliance.HasOrNot('WashingMachine')							
							</div>										
						    <div class="large-4 columns">
								Has AirConditioner : $Appliance.HasOrNot('AirConditioner')							
							</div>
						</div>	
				        <div class="row">
						    <div class="large-4 columns">
								Has MicrowaveOven : $Appliance.HasOrNot('MicrowaveOven')		
							</div>
						    <div class="large-4 columns">
								Has CookingGas : $Appliance.HasOrNot('CookingGas')		
							</div>										
						    <div class="large-4 columns">
								Has Fridge : $Appliance.HasOrNot('Fridge')		
							</div>
						</div>
				        <div class="row">
						    <div class="large-4 columns">
								Has Other items: $Appliance.HasOrNot('Others')		
							</div>
						    <div class="large-8 columns last">
								Specify (if has other items) : $Appliance.Specify
							</div>										
						</div>	
						<% end_if %>
						<% if $OtherFacility %>
						<h4 class="subheader">Other Facility</h4>
				        <div class="row">
						    <div class="large-4 columns">
								Has WaterWell : $OtherFacility.HasOrNot('WaterWell')							
							</div>
						    <div class="large-4 columns">
								Has DrillWell : $OtherFacility.HasOrNot('DrillWell')							
							</div>										
						    <div class="large-4 columns">
								Has WaterConnection : $OtherFacility.HasOrNot('WaterConnection')							
							</div>
						</div>	
				        <div class="row">
						    <div class="large-4 columns">
								Has RainwaterStorage : $OtherFacility.HasOrNot('RainwaterStorage')		
							</div>
						    <div class="large-4 columns">
								Has Biogas : $OtherFacility.HasOrNot('Biogas')		
							</div>										
						    <div class="large-4 columns">
								Has Electricity : $OtherFacility.HasOrNot('Electricity')		
							</div>
						</div>
				        <div class="row">
						    <div class="large-4 columns">
								Has SolarEnergy: $OtherFacility.HasOrNot('SolarEnergy')		
							</div>
						    <div class="large-8 columns last">
								Has VegetableGarden: $OtherFacility.HasOrNot('VegetableGarden')		
							</div>										
						</div>	
						<% end_if %>
						<% if $Media %>
						<h4 class="subheader">Media</h4>
				        <div class="row">
						    <div class="large-6 columns">
								Has Newspaper : $Media.HasNewspaper()							
							</div>
						    <div class="large-6 columns">
								<% if $Media.Newspaper %> $Media.NewspaperCount papers, $Media.NewspaperNames <% end_if %>							
							</div>										
						</div>	
				        <div class="row">
						    <div class="large-6 columns">
								Has Magazine : $Media.HasOrNot('Magazine')							
							</div>
						    <div class="large-6 columns">
								Has Kids Magazine : $Media.HasOrNot('KidsMagazine')	
							</div>										
						</div>							
				        <div class="row">
						    <div class="large-6 columns">
								Has Television : $Media.HasOrNot('Television')							
							</div>
						    <div class="large-6 columns">
								Has Internet : $Media.HasOrNot('Internet')	
							</div>										
						</div>
				        <div class="row">
						    <div class="large-6 columns">
								Has Mobile : $Media.HasOrNot('Mobile')							
							</div>
						    <div class="large-6 columns">
								<% if $Media.Mobile %> $Media.MobileCount mobile <% end_if %>
							</div>										
						</div>												
						<% end_if %>
						<% if $CatholicMagazine %>
						<h4 class="subheader">Catholic Magazine </h4>
				        <div class="row">
						    <div class="large-4 columns">
								Has Jeevadeepthi : $CatholicMagazine.HasOrNot('Jeevadeepthi')							
							</div>
						    <div class="large-4 columns">
								Has Jeevanaadam : $CatholicMagazine.HasOrNot('Jeevanaadam')							
							</div>										
						    <div class="large-4 columns">
								Has Christain : $CatholicMagazine.HasOrNot('Christain')							
							</div>
						</div>	
				        <div class="row">
						    <div class="large-4 columns">
								Has Preshitha Keralam : $CatholicMagazine.HasOrNot('PreshithaKeralam')		
							</div>
						    <div class="large-4 columns">
								Has Shalom : $CatholicMagazine.HasOrNot('Shalom')		
							</div>										
						    <div class="large-4 columns">
								Has Cherupushpam : $CatholicMagazine.HasOrNot('Cherupushpam')		
							</div>
						</div>
				        <div class="row">
						    <div class="large-4 columns">
								Others : $CatholicMagazine.HasOrNot('Others')		
							</div>
						    <div class="large-8 columns last">
								Specify (if other items) : $CatholicMagazine.Specify
							</div>										
						</div>	
						<% end_if %>


                    </div>
                    <div class="content " id="financial">
						<% if $Loan %>
						<h4 class="subheader">Loan</h4>
				        <div class="row">
						    <div class="large-6 columns">
								Has Loan : $Loan.OnLoan()							
							</div>
						    <div class="large-6 columns">
								<% if $Loan.HasLoan %> Amount: $Loan.Amount <% end_if %>							
							</div>										
						</div>	
				        <div class="row">
						    <div class="large-6 columns">
								<% if $Loan.HasLoan %> From: $Loan.FromWhere <% end_if %>
							</div>
						    <div class="large-6 columns">
								<% if $Loan.HasLoan %> Reason: $Loan.Reason <% end_if %>
							</div>										
						</div>							
						<% end_if %>
						<% if $Saving %>
						<h4 class="subheader">Savings</h4>
				        <div class="row">
						    <div class="large-4 columns">
								Has EducationFund : $Saving.HasOrNot('EducationFund')							
							</div>
						    <div class="large-4 columns">
								Has LifeInsurance : $Saving.HasOrNot('LifeInsurance')							
							</div>										
						    <div class="large-4 columns">
								Has HealthInsurance : $Saving.HasOrNot('HealthInsurance')							
							</div>
						</div>	
				        <div class="row">
						    <div class="large-4 columns">
								Has DeathFund : $Saving.HasOrNot('DeathFund')		
							</div>
						    <div class="large-4 columns">
								Has MarriageFund : $Saving.HasOrNot('MarriageFund')		
							</div>										
						    <div class="large-4 columns">
								Has Mythri : $Saving.HasOrNot('Mythri')		
							</div>
						</div>
				        <div class="row">
						    <div class="large-4 columns">
								Has Chitty : $Saving.HasOrNot('Chitty')		
							</div>							
						    <div class="large-4 columns">
								Others : $Saving.HasOrNot('Others')		
							</div>
						    <div class="large-4 columns last">
								Specify (if others) : $Saving.Specify
							</div>										
						</div>	
						<% end_if %>
						
                    </div>
                    <div class="content " id="contact">
						<% if $Contact %>
						<h4 class="subheader">Contact</h4>
				        <div class="row">
						    <div class="large-4 columns">
								Name : $Contact.Name
							</div>
						    <div class="large-4 columns">
								Email : $Contact.Email
							</div>										
						    <div class="large-4 columns">
								Mobile : $Contact.Mobile
							</div>
						</div>
						<% end_if %>
                    </div>
					
                </div>
			</div>	
		</div>
		<% end_with %>
		
    </div>
</div>
<a class="close-reveal-modal" aria-label="Close">&#215;</a>

