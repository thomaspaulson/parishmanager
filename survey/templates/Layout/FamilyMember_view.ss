<div class="row main">
    <div class="large-12 columns">
		<div class="panel">
		
			<% with FamilyMember %>		
	        <h3>$Name</h3>
				<!--<a href="family/print-family/$ID" target="_blank" title="Print"> Print <i class="fi-print"></i></a>-->
				<a href="{$Link('edit-member')}?&BackURL=$Top.RequestedURL" title="Edit $Name"><i class="fi-page-edit"></i> Edit</a>
				|
				<a href="$Top.GoBackURL" title="Go back"><i class="fi-page-edit"></i> Go back</a>
			
	        <div class="row">			
	            <div class="large-6 columns">
					Family: $Family.Name ({$Family.UnitNo} unit / {$Family.ContactNo})<br>
					Parish $Parish.NameWithLocation <br>
					$Sex | <% if $DateOfBirth %>$DateOfBirth.Format('d-m-Y') | $Age yrs <% else %> $Age years<% end_if %><br>
					Status: $MStatus <br>
					Holds Passport: $HasOrNot('HoldsPassport') <br>
	                Holds Bank Account: $HasOrNot('HoldsBankAccount') <br>
					Holds Driving Licence: $HasOrNot('HoldsDrivingLicence') <br>
					Blood Group: $BloodGroup					<br>
					Relation to Gaurdian: $Relation <br> 	
	            </div>
	            <div class="large-6 columns">					
						<% if Relatives %>
							<table>
							<thead>
							<tr>								
								<th>Relative Name</th>
								<th>Gender</th>
								<th>Date of Birth/Age</th>
							</tr>
							</thead>
							<tbody>							
							<% loop Relatives %>
								<tr>
									<td>$Name ($Relation)</td>
									<td>$Sex</td>
									<td><% if $DateOfBirth %>$DateOfBirth.Format('d-m-Y') | $Age yrs <% else %> $Age years<% end_if %></td>
								</tr>						
							<% end_loop %>
							</tbody>						
							</table>
						<% end_if %>
					
	            </div>
				
				<div class="row">
					<div class="large-12 columns">
					</div>		
				</div>	
				
	        </div>	        
		</div><!-- div class="panel" -->
		<hr>

        <div class="row">
            <div class="large-12 columns">
					<a name="educations"></a>
					<h4 class="subheader">Educations</h4>			
					
						<%-- <a href="education/add-education?MemberID=$ID&BackURL=$Top.RequestedURL(#educations)" title="Add education"><i class="fi-page-add"></i> Add</a>
						| --%>
						<a href="education/bulkadd?MemberID=$ID&BackURL=$Top.RequestedURL(#educations)" title="Buld add education"><i class="fi-page-add"></i> Add</a>
						<% if Educations %>
							<table>
							<thead>
							<tr>								
								<th>Course</th>
								<th>Subject</th>
								<th>Status</th>
								<th></th>
							</tr>
							</thead>
							<tbody>							
						<% loop Educations %>
							<tr>
								<td>$Course</td>
								<td>$Subject</td>
								<td>{$PrintStatus}</td>
								<td>
								<a href="{$Link('edit-education')}?&BackURL=$Top.RequestedURL(#educations)" title="Edit"><i class="fi-page-edit"></i></a>
								|
								<a href="{$Link('delete-education')}?&BackURL=$Top.RequestedURL(#educations)" title="Delete" onclick="return confirm('Are you sure?');"><i class="fi-page-delete"></i></a>							
								</td>														
							</tr>						
						<% end_loop %>
							</tbody>						
							</table>
						<% end_if %>
					
						<hr>         
						<a name="health"></a>           
                    	<h4 class="subheader">Health</h4>
						<% if not $Health %>
							<a href="health/add-health?MemberID=$ID&BackURL=$Top.RequestedURL(#health)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																							
                    	
						<% if $Health %>						
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
						
   							<% with $Health %>
								<a href="health/edit-health/$ID?BackURL=$Top.RequestedURL(#health)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>							
						
						<% end_if %>						
						
						<hr>
						<a name="groups"></a>           
						<h4 class="subheader">Groups</h4>
						<% if not $CommunityGroups %>
							<a href="groups/add-groups?MemberID=$ID&BackURL=$Top.RequestedURL(#groups)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																							
						
						<% if CommunityGroups %>
				        <div class="row">
						    <div class="large-6 columns last">
						
							<h6><strong>Group Title</strong><h6>
							<% loop CommunityGroups %>
									$Title <br>
							<% end_loop %>
							
							</div>
						</div>   							
							<a href="groups/edit-groups?MemberID=$ID&BackURL=$Top.RequestedURL(#groups)"><i class="fi-page-edit"></i> Edit</a>
												
						<% end_if %>


                    	<hr>
                    	<a name="awards"></a>           
                    	<h4 class="subheader">Awards/Achievement</h4>
						<% if not $Achievement %>
							<a href="achievement/add-achievement?MemberID=$ID&BackURL=$Top.RequestedURL(#awards)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																							
						<% if $Achievement %>												
				        <div class="row">
						    <div class="large-12 columns">
								Title: $Achievement.Title, 	From where: $Achievement.FromWhere,	Year: $Achievement.Year<br>
							</div>
						</div>
   							<% with $Achievement %>
								<a href="achievement/edit-achievement/$ID?BackURL=$Top.RequestedURL(#awards)"><i class="fi-page-edit"></i> Edit</a>
								|
								<a href="{$Link('delete-achievement')}?&BackURL=$Top.RequestedURL(#awards)" title="Delete" onclick="return confirm('Are you sure?');"><i class="fi-page-delete"></i> Delete</a>		
							<% end_with %>							
						
						<% end_if %>

                    	<hr>
                    	<a name="job"></a>           
                    	<h4 class="subheader">Job</h4>
						<% if not $Job %>
							<a href="job/add-job?MemberID=$ID&BackURL=$Top.RequestedURL(#job)"><i class="fi-page-add"></i> Add</a>
						<% end_if %>																							
                    	
						<% if $Job %>						
				        <div class="row">
						    <div class="large-6 columns">
								Title: $Job.Title<br>																
								Type: $Job.JobType<br>
								Location: $Job.JobLocation
							</div>			
						    <div class="large-6 columns">
							</div>
						</div>
   							<% with $Job %>
								<a href="job/edit-job/$ID?BackURL=$Top.RequestedURL(#job)"><i class="fi-page-edit"></i> Edit</a>
							<% end_with %>							
						
						<% end_if %>              

					
					
                </div>
			</div>	
		</div>
		<% end_with %>
		
    </div>
</div>
<a class="close-reveal-modal" aria-label="Close">&#215;</a>

