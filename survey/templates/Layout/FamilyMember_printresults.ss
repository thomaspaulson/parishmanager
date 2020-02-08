
			<% if $Results %>

				<table>
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>Gender / DOB / Age</th>
						<th>Group(B) / Status / Marriage (Dt) </th>
						<th>Family</th>						
						<th>Unit / Contact</th>												
						</th>
					</thead>
					<tbody>
						<% loop $Results %>
						<tr>
							<td>$Counter</td>
							<td>$Name<br></td>
							<td>{$Top.Sex($Gender)} / {$Top.DOB($DateOfBirth, 'd-m-Y')} / {$Top.Age($DateOfBirth, $Age)} yrs</td>
							<td> $BloodGroup / $Top.MStatus($MartialStatus)  <% if $DateOfMarriage %>	/ $Top.DOB($DateOfMarriage, 'd-m-Y') <% end_if %></td>							
							<td>$FamilyName							
							</td>						
							<td>$UnitNo / $ContactNo</td>						
							<td>
								<a href="$Link(view)" data-reveal-id="myModal" data-reveal-ajax="true" title="View $Name"><i class="fi-page"></i></a>
							</td>
						</tr>
						<% end_loop %>
					</tbody>
				</table>
				
			<% else %>
				<p>No records found</p>
			<% end_if %>
			


