<div class="row main">
    <div class="large-12 columns">
		<% with FamilyMember %>		
        <h3>$Name</h3>
		<a href="members/print-member/$ID" target="_blank" title="Print"> Print <i class="fi-print"></i></a>
        <div class="row">			
            <div class="large-6 columns">
				$Family.Name <br>
				 $Parish.NameWithLocation <br>
				$Sex | $DateOfBirth.Format('d-m-Y') | $Age yrs <br>
				Status: $MStatus <br>
				<%-- Relation: $Relation <br> --%>

            </div>
            <div class="large-6 columns">
				Holds Passport: $HasOrNot('HoldsPassport') <br>
                Holds Bank Account: $HasOrNot('HoldsBankAccount') <br>
				Holds Driving Licence: $HasOrNot('HoldsDrivingLicence') <br>
				Blood Group: $BloodGroup
                </div>
            </div>
        </div>
		
        <div class="row">
            <div class="large-12 columns">
				<hr>			    
                <ul class="tabs" data-tab>                    
                    <li class="tab-title active"><a href="#education">Education</a></li>
					<li class="tab-title "><a href="#job">Job</a></li>
					<li class="tab-title "><a href="#health">Health</a></li>
					<li class="tab-title "><a href="#groups">Groups</a></li>
                </ul>
                <div class="tabs-content">
                    <div class="content active" id="education">
						<h4 class="subheader">Education</h4>
						<% if Educations %>
				        <div class="row">
						    <div class="large-6 columns last">
						
							<div class="row">
								<div class="large-6 columns">
									<strong>Course</strong>
								</div>	
								<div class="large-6 columns">
									<strong>Status</strong>
								</div>
							</div>	
							<% loop Educations %>
							<div class="row">
								<div class="large-6 columns">
									$Course
								</div>
								<div class="large-6 columns">
									{$PrintStatus}
								</div>
							</div>	
							<% end_loop %>
							
							</div>
						</div>
						<% end_if %>
						
                    </div>					
                    <div class="content" id="job">
						<% if $Job %>
						<h4 class="subheader">Job</h4>
				        <div class="row">
						    <div class="large-6 columns">
								Title: $Job.Title<br>								
								Company Name: $Job.CompanyName<br>
								Type: $Job.JobType<br>
								Location: $Job.JobLocation
							</div>			
						    <div class="large-6 columns">
								Has Pension: $Job.HasOrNot('Pension')<br>
								Has Saving Scheme: $Job.HasOrNot('SavingScheme')<br>
								Has ESI: $Job.HasOrNot('ESI')<br>
								Has PF: $Job.HasOrNot('PF')<br>
								Salary: $Job.MonthlySalary
							</div>
						</div>
						<% end_if %>
                    </div>
                    <div class="content " id="health">
						
						<% if $Health %>
						<h4 class="subheader">Health</h4>
				        <div class="row">
						    <div class="large-4 columns">
								Blind: $Health.HasOrNot('Blind')							
							</div>
						    <div class="large-4 columns">
								Deaf: $Health.HasOrNot('Deaf')							
							</div>										
						    <div class="large-4 columns">
								Dumb: $Health.HasOrNot('Dumb')							
							</div>
						</div>
				        <div class="row">
						    <div class="large-4 columns">
								Other phsical-disability: $Health.HasOrNot('OtherPhsicalDisability')							
							</div>
						    <div class="large-4 columns">
								Learning disability: $Health.HasOrNot('LearningDisability')					
							</div>										
						    <div class="large-4 columns">
								Mental disability: $Health.HasOrNot('MentalDisability')							
							</div>
						</div>
				        <div class="row">
						    <div class="large-4 columns">
								Hearth Disease: $Health.HasOrNot('HearthDisease')							
							</div>
						    <div class="large-4 columns">
								Diabetes: $Health.HasOrNot('Diabetes')							
							</div>										
						    <div class="large-4 columns">
								Cancer: $Health.HasOrNot('Cancer')							
							</div>
						</div>
				        <div class="row">
						    <div class="large-4 columns">
								Blood pressure: $Health.HasOrNot('BloodPressure')							
							</div>
						    <div class="large-4 columns">
								Other disease: $Health.OtherDisease						
							</div>										
						    <div class="large-4 columns">
								Occupational disease: $Health.OccupationalDisease
							</div>
						</div>
				        <div class="row">
						    <div class="large-4 columns">
								Alcoholic: $Health.HasOrNot('Alcoholic')							
							</div>
						    <div class="large-4 columns">
								Other Health-Info: $Health.OtherHealthInfo						
							</div>										
						    <div class="large-4 columns">
							</div>
						</div>
						
						<% end_if %>
						
						
						
                    </div>
                    <div class="content " id="groups">

						<h4 class="subheader">Groups</h4>
						<% if CommunityGroups %>
				        <div class="row">
						    <div class="large-6 columns last">
						
							<div class="row">
								<div class="large-12 columns">
									<strong>Group Title</strong>
								</div>	
							</div>	
							<% loop CommunityGroups %>
							<div class="row">
								<div class="large-12 columns">
									$Title
								</div>
							</div>	
							<% end_loop %>
							
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

