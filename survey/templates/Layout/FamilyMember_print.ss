<% if FamilyMember %>		
		<% with FamilyMember %>
			<table>
				<thead>
				<tr>
					<th colspan="2"><h2>$Name</h2></th>
				</tr>
				</thead>
				<tbody>
				 <tr>
					<td>		
					$Family.Name <br>
					 $Parish.NameWithLocation <br>
					$Sex | $DateOfBirth.Format('d-m-Y') | $Age yrs <br>
					Status: $MStatus <br>
					<%-- Relation: $Relation <br> --%>
					</td>
					<td>
				Holds Passport: $HasOrNot('HoldsPassport') <br>
                Holds Bank Account: $HasOrNot('HoldsBankAccount') <br>
				Holds Driving Licence: $HasOrNot('HoldsDrivingLicence') <br>
				Blood Group: $BloodGroup
			</td>

		 </tr>			
		</tbody>
	</table>	


						<% if Educations %>
							<h4 class="subheader">Education</h4>						
							<table>
							<thead>
							<tr>
								<th>Course</th>
								<th>Status</th>
							</tr>
							</thead>
							<tbody>							
										
							<% loop Educations %>
							<tr>
								<td>$Course</td>
								<td>$PrintStatus</td>
							</tr>						
							
							<% end_loop %>
							</tbody>						
							</table>
						<% end_if %>
						
						
						<% if $Job %>
						<table>
							<thead>
							<tr>
								<th colspan="2"><h4 class="subheader">Job</h4></th>
							</tr>
							</thead>
							
							<tr>
								<td>
						
								Title: $Job.Title<br>								
								Company Name: $Job.CompanyName<br>
								Type: $Job.JobType<br>
								Location: $Job.JobLocation
								</td>
								<td>
								Has Pension: $Job.HasOrNot('Pension')<br>
								Has Saving Scheme: $Job.HasOrNot('SavingScheme')<br>
								Has ESI: $Job.HasOrNot('ESI')<br>
								Has PF: $Job.HasOrNot('PF')<br>
								Salary: $Job.MonthlySalary
								</td>
							</tr>
						</table>
						<% end_if %>
						
						
						<% if $Health %>
						<table>
							<thead>
							<tr>
								<th colspan="3"><h4 class="subheader">Health</h4></th>
							</tr>
							</thead>
							
							<tr>
								<td>						
								Blind: $Health.HasOrNot('Blind')
								</td>
								<td>								
								Deaf: $Health.HasOrNot('Deaf')
								</td>
								<td>
								Dumb: $Health.HasOrNot('Dumb')							
								</td>
							</tr>
							<tr>
						    <td>
								Other phsical-disability: $Health.HasOrNot('OtherPhsicalDisability')							
							</td>
						    <td>
								Learning disability: $Health.HasOrNot('LearningDisability')					
							</td>										
						    <td>
								Mental disability: $Health.HasOrNot('MentalDisability')							
							</td>
						</tr>
				        <tr>
						    <td>
								Hearth Disease: $Health.HasOrNot('HearthDisease')							
							</td>
						    <td>
								Diabetes: $Health.HasOrNot('Diabetes')							
							</td>										
						    <td>
								Cancer: $Health.HasOrNot('Cancer')							
							</td>
						</tr>
				        <tr>
						    <td>
								Blood pressure: $Health.HasOrNot('BloodPressure')							
							</td>
						    <td>
								Other disease: $Health.OtherDisease						
							</td>										
						    <td>
								Occupational disease: $Health.OccupationalDisease
							</td>
						</tr>
				        <tr>
						    <td>
								Alcoholic: $Health.HasOrNot('Alcoholic')							
							</td>
						    <td>
								Other Health-Info: $Health.OtherHealthInfo						
							</td>										
						    <td>
							</td>
						</td>
						</table>	
						<% end_if %>
						
						
						
                    

						
						<% if CommunityGroups %>
						
						<h4 class="subheader">Groups</h4>
				        <div>
							<% loop CommunityGroups %>
							<div>
								<div class="large-12 columns">
									$Title
								</div>
							</div>	
							<% end_loop %>							
							
						</div>
						<% end_if %>

					
		<% end_with %>
		
<% end_if %>		

