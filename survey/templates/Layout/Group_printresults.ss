

			<% if $Results %>
			
				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>											
						<th>Gender / DOB / Age</th>
						<th>Groups</th>		
						<th>Family</th>
						<th>Unit / Contact</th>												
					</tr>
					</thead>
					<tbody>
						<% loop $Results %>
						<tr>
							<td>$ID</td>
							<td>$Name<br></td>							
							<td>{$Sex} / {$DateOfBirth.Format('d-m-Y')} / {$Age} yrs</td>							
							<td>
								<% loop CommunityGroups %>
									$Title <% if not Last %>,<% end_if %>
								<% end_loop %>
							</td>
							<td><% if $Family %>$Family.Name<% end_if %></td>
							<td><% if $Family %> $Family.UnitNo / $Family.ContactNo<% end_if %></td>						
							
						</tr>
						<% end_loop %>
					</tbody>
				</table>
				
			<% else %>
				<p>No records found</p>
			<% end_if %>
			
       