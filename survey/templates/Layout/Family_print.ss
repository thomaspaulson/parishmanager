<% if $Family %>
	<% with Family %>		
	<table>
		<thead>
		<tr>
			<th colspan="2"><h2>$Name</h2></th>
		</tr>
		</thead>
		<tbody>
		 <tr>
			<td>		
					$Address, $Pincode <br>
					House no: $HouseNo <br>
					Panchayat: $InPanchayat <br>
					Municipality: $InMunicipality <br>
					Corporation: $InCorporation 
			</td>
			<td>
					Block no: $BlockNo <br>
					Unit no: $UnitNo <br>
					Unit no: $FamilyNo <br>
					Parish: $Parish.NameWithLocation
			</td>
		 </tr>			
		</tbody>
	</table>	

		
		<% if FamilyMembers %>
		
		<h4 class="subheader">Members</h4>
			<table>
			<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Gender</th>
				<th>DOB / Age</th>
				<th>Blood Group / Martial Status</th>
				<th></th>
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
		
		<% if $House %>
		
		<table>
			<thead>
			<tr>
				<th colspan="2"><h4 class="subheader">House</h4></th>
			</tr>
			</thead>
			
			<tr>
				<td>
				<div class="large-6 columns">
					Status: $House.Status<br>								
					Ration-Card Holder: $House.RationCardHolder<br>
					HouseType: $House.HouseType
				</div>
				</td>
				<td>
				<div class="large-6 columns">
				Amount: $House.Amount<br>
				Card Type: $House.CardType.UpperCase<br>
				Build Year: $House.BuildYear
				</div>
				</td>
			</tr>
		</table>
		<% end_if %>
		
		<% if $Land %>
		
		<table>
			<thead>
			<tr>
				<th colspan="3"><h4 class="subheader">Land</h4></th>
			</tr>
			</thead>
			
			<tr>
				<td>
				<div class="large-4 columns">
					HoldsLand: $Land.LandHolder							
				</div>
				</td>
				<td>
				<div class="large-4 columns">
					Area: $Land.Area							
				</div>
				</td>
				<td>
				<div class="large-4 columns">
					Total Land: $Land.InCent cents
				</div>
				</td>
			</tr>
		</table>	
		<% end_if %>
		
		<% if $ShiftedFrom %>						
		<table>
			<thead>
			<tr>
				<th colspan="2"><h4 class="subheader">Shifted Form</h4></th>
			</tr>
			</thead>
			
			<tr>
				<td>							
				<div class="large-4 columns">
					Status : $ShiftedFrom.Shifted							
				</div>
				</td>
				<td>
				<div class="large-4 columns">
					From Where: $ShiftedFrom.FromWhere							
				</div>
				</td>
				<td>
				<div class="large-4 columns">
					Reason: $ShiftedFrom.Reason
				</div>
				</td>
			</tr>
		</table>	
		<% end_if %>

		<% if $Agriculture %>
		<table>						
			<thead>
			<tr>
				<th colspan="2"><h4 class="subheader">Agriculture</h4></th>
			</tr>
			</thead>
			<tr>
				<td>																				
					<div class="large-6 columns">
						Type: $Agriculture.Type							
					</div>
				</td>
				<td>
					<div class="large-6 columns">
						others : $Agriculture.Other							
					</div>
				</td>	
			</tr>
		</table>
		<% end_if %>
		
		<% if $Business %>						
		<table>						
			<thead>
			<tr>
				<th colspan="2"><h4 class="subheader">Business</h4></th>
			</tr>
			</thead>
			<tr>
				<td>								
					<div class="large-6 columns">
						Type: $Business.Type							
					</div>
				</td>
				<td>
					<div class="large-6 columns">
						if others : $Business.Other							
					</div>
				</td>									
			</tr>		
		</table>
		<% end_if %>

			<% if $MonthlyIncome %>
			
			<table>						
				<thead>
				<tr>
					<th colspan="2"><h4 class="subheader">Monthly Income</h4></th>
				</tr>
				</thead>
				<tr>
					<td>								
						<div class="large-6 columns">
							Land: $MonthlyIncome.Land							
						</div>
					</td>
					<td>
						<div class="large-6 columns">
							Job : $MonthlyIncome.Job							
						</div>
					</td>
				</tr>	
				<tr>
					<td>								
						<div class="large-6 columns">
							Others : $MonthlyIncome.Others							
						</div>
					</td>
					<td>
						<div class="large-6 columns">
							Total : $MonthlyIncome.Total							
						</div>																	
					</td>
				</tr>
			</table>
			<% end_if %>
			<% if $MonthlyExpense %>
			
			<table>						
				<thead>
				<tr>
					<th colspan="2"><h4 class="subheader">Monthly Expense</h4></th>
				</tr>
				</thead>
				<tr>
					<td>																						
						<div class="large-6 columns">
							Food: $MonthlyExpense.Food							
						</div>
					</td>
					<td>																							
						<div class="large-6 columns">
							Education : $MonthlyExpense.Education							
						</div>
					</td>																							
				</tr>
				<tr>
					<td>
						<div class="large-6 columns">
							Medical : $MonthlyExpense.Medical							
						</div>
					</td>
					<td>
						<div class="large-6 columns">
							
							Mobile : $MonthlyExpense.Mobile							
						</div>																	
					</td>
				</tr>
				<tr>
					<td>
						<div class="large-6 columns">
							Others : $MonthlyExpense.Others							
						</div>
					</td>
					<td>
						<div class="large-6 columns">
							Total : $MonthlyExpense.Total							
						</div>																	
					</td>
				</tr>
			</table>
			<% end_if %>
			
						<% if $Vehicle %>
						
						<table>						
							<thead>
							<tr>
								<th colspan="3"><h4 class="subheader">Vehicle</h4></th>
							</tr>
							</thead>
					
							<tr>
								<td>
									Has Cycle : $Vehicle.HasCycle							
								</td>
								<td>
									Has Bike : $Vehicle.HasBike							
								</td>										
								<td>
									Has Autoriskaw : $Vehicle.HasAutoriskaw							
								</td>
							</tr>	
							<tr>
								<td>
									Has LightVehicle : $Vehicle.HasLightVehicle
								</td>
								<td>
									Has HeavyCommercial : $Vehicle.HasHeavyCommercial						
								</td>										
								<td>
									Has CountryBoat : $Vehicle.HasCountryBoat							
								</td>
							</tr>	
							<tr>
								<td>
									Has Vallam : $Vehicle.HasVallam
								</td>
								<td>
									Has FishingBoat : $Vehicle.HasFishingBoat					
								</td>										
								<td>
									Has TouristBoat : $Vehicle.HasTouristBoat		
								</td>
							</tr>	
						</table>	          
						<% end_if %>
						<% if $Appliance %>
						
						<table>						
							<thead>
							<tr>
								<th colspan="3"><h4 class="subheader">Appliance</h4></th>
							</tr>
							</thead>
						
				        <tr>
						    <td>
								Has Computer : $Appliance.HasOrNot('Computer')							
							</td>
						    <td>
								Has WashingMachine : $Appliance.HasOrNot('WashingMachine')							
							</td>										
						    <td>
								Has AirConditioner : $Appliance.HasOrNot('AirConditioner')							
							</td>
						</tr>	
				        <tr>
						    <td>
								Has MicrowaveOven : $Appliance.HasOrNot('MicrowaveOven')		
							</td>
						    <td>
								Has CookingGas : $Appliance.HasOrNot('CookingGas')		
							</td>										
						    <td>
								Has Fridge : $Appliance.HasOrNot('Fridge')		
							</td>
						</tr>
				        <tr>
						    <td>
								Has Other items: $Appliance.HasOrNot('Others')		
							</td>
						    <td colspan="2">
								Specify (if has other items) : $Appliance.Specify
							</td>										
						</tr>
						</table>
						<% end_if %>
						<% if $OtherFacility %>
						
						<table>						
							<thead>
							<tr>
								<th colspan="3"><h4 class="subheader">Other Facility</h4></th>
							</tr>
							</thead>						
				        <tr>
						    <td>
								Has WaterWell : $OtherFacility.HasOrNot('WaterWell')							
							</td>
						    <td>
								Has DrillWell : $OtherFacility.HasOrNot('DrillWell')							
							</td>										
						    <td>
								Has WaterConnection : $OtherFacility.HasOrNot('WaterConnection')							
							</td>
						</tr>	
				        <tr>
						    <td>
								Has RainwaterStorage : $OtherFacility.HasOrNot('RainwaterStorage')		
							</td>
						    <td>
								Has Biogas : $OtherFacility.HasOrNot('Biogas')		
							</td>										
						    <td>
								Has Electricity : $OtherFacility.HasOrNot('Electricity')		
							</td>
						</tr>
				        <tr>
						    <td>
								Has SolarEnergy: $OtherFacility.HasOrNot('SolarEnergy')		
							</td>
						    <td colspan="2">
								Has VegetableGarden: $OtherFacility.HasOrNot('VegetableGarden')		
							</td>>
						</tr>
						</table>
						<% end_if %>
						
						<% if $Media %>						
						<table>						
							<thead>
							<tr>
								<th colspan="2"><h4 class="subheader">Media</h4></th>
							</tr>
							</thead>												
				        <tr>
						    <td>
								Has Newspaper : $Media.HasNewspaper()							
							</td>
						    <td>
								<% if $Media.Newspaper %> $Media.NewspaperCount papers, $Media.NewspaperNames <% end_if %>							
							</td>							
						</tr>	
				        <tr>
						    <td>
								Has Magazine : $Media.HasOrNot('Magazine')							
							</td>
						    <td>
								Has Kids Magazine : $Media.HasOrNot('KidsMagazine')	
							</td>										
						</tr>							
				        <tr>
						    <td>
								Has Television : $Media.HasOrNot('Television')							
							</td>
						    <td>
								Has Internet : $Media.HasOrNot('Internet')	
							</td>										
						</tr>
				        <tr>
						    <td>
								Has Mobile : $Media.HasOrNot('Mobile')							
							</td>
						    <td>
								<% if $Media.Mobile %> $Media.MobileCount mobile <% end_if %>
							</td>										
						</tr>
						</table>
						<% end_if %>
						<% if $CatholicMagazine %>
						
						<table>						
							<thead>
							<tr>
								<th colspan="3"><h4 class="subheader">Catholic Magazine </h4></th>
							</tr>
							</thead>												
						
				        <tr>
						    <td>
								Has Jeevadeepthi : $CatholicMagazine.HasOrNot('Jeevadeepthi')							
							</td>
						    <td>
								Has Jeevanaadam : $CatholicMagazine.HasOrNot('Jeevanaadam')							
							</td>										
						    <td>
								Has Christain : $CatholicMagazine.HasOrNot('Christain')							
							</td>
						</tr>	
				        <tr>
						    <td>
								Has Preshitha Keralam : $CatholicMagazine.HasOrNot('PreshithaKeralam')		
							</td>
						    <td>
								Has Shalom : $CatholicMagazine.HasOrNot('Shalom')		
							</td>										
						    <td>
								Has Cherupushpam : $CatholicMagazine.HasOrNot('Cherupushpam')		
							</td>
						</tr>
				        <tr>
						    <td>
								Others : $CatholicMagazine.HasOrNot('Others')		
							</td>
						    <td colspan="2">
								Specify (if other items) : $CatholicMagazine.Specify
							</td>										
						</tr>
						</table>
						<% end_if %>

						<% if $Loan %>
						
						<table>						
							<thead>
							<tr>
								<th colspan="2"><h4 class="subheader"> Loan </h4></th>
							</tr>
							</thead>												
						
				        <tr>
						    <td>
								Has Loan : $Loan.OnLoan()							
							</td>
						    <td>
								<% if $Loan.HasLoan %> Amount: $Loan.Amount <% end_if %>							
							</td>										
						</tr>	
				        <tr>
						    <td>
								<% if $Loan.HasLoan %> From: $Loan.FromWhere <% end_if %>
							</td>
						    <td>
								<% if $Loan.HasLoan %> Reason: $Loan.Reason <% end_if %>
							</td>										
						</tr>
						</table>
						<% end_if %>
						
						<% if $Saving %>						
						<table>						
							<thead>
							<tr>
								<th colspan="3"><h4 class="subheader"> Savings </h4></th>
							</tr>
							</thead>												
												
				        <tr>
						    <td>
								Has EducationFund : $Saving.HasOrNot('EducationFund')							
							</td>
						    <td>
								Has LifeInsurance : $Saving.HasOrNot('LifeInsurance')							
							</td>										
						    <td>
								Has HealthInsurance : $Saving.HasOrNot('HealthInsurance')							
							</td>
						</tr>	
				        <tr>
						    <td>
								Has DeathFund : $Saving.HasOrNot('DeathFund')		
							</td>
						    <td>
								Has MarriageFund : $Saving.HasOrNot('MarriageFund')		
							</td>										
						    <td>
								Has Mythri : $Saving.HasOrNot('Mythri')		
							</td>
						</tr>
				        <tr>
						    <td>
								Has Chitty : $Saving.HasOrNot('Chitty')		
							</td>							
						    <td>
								Others : $Saving.HasOrNot('Others')		
							</td>
						    <td>
								Specify (if others) : $Saving.Specify
							</td>										
						</td>
						</table>
						<% end_if %>
						
						<% if $Contact %>						
						<table>						
							<thead>
							<tr>
								<th colspan="3"><h4 class="subheader"> Contact </h4></th>
							</tr>
							</thead>												
						
				        <tr>
						    <td>
								Name : $Contact.Name
							</td>
						    <td>
								Email : $Contact.Email
							</td>										
						    <td>
								Mobile : $Contact.Mobile
							</td>
						</tr>
						</table>
						<% end_if %>
	 
	<% end_with %>
		
<% end_if %>
