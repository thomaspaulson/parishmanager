
			<% if $Results %>
			
				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>										
						<th>Gender / DOB / Age</th>
						<th>Health</th>		
						<th>Family</th>
						<th>Unit / Contact</th>												
					</tr>
					</thead>
					<tbody>
						<% loop $Results %>
						<tr>
							<td>$Counter</td>
							<td>$Name<br></td>
							<td>{$Gender} / {$Top.FormatDate($DateOfBirth, 'd-m-Y')} / {$Top.Age($DateOfBirth, $Age)} yrs </td>													
							<td>
								<% if $Health %>$Health.Diseases<% end_if %>
								$OtherHealthInfo
							</td>
							<td>$FamilyName</td>
							<td>$UnitNo / $ContactNo</td>													
						</tr>
						<% end_loop %>
					</tbody>
				</table>
				
			<% else %>
				<p>No records found</p>
			<% end_if %>
			
