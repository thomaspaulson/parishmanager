
			<% if $Results %>
				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Family</th>
						<th>Contact Person</th>						
						<th>Block/Unit/Family</th>
						<th>House</th>
						<th>Ration Card</th>
						<th>House Type</th>
					</tr>
					</thead>
					<tbody>
						<% loop $Results %>
						<tr>
							<td>$Counter</td>
							<td>$Name<br>{$Address}, $Pincode</td>
							<td>
								$MemberName, $ContactNo								
							</td>							
							<td>{$BlockNo}/{$UnitNo}/{$FamilyNo}</td>							
							<td>$Status </td>
							<td>
								<% if $HoldsRationCard %>Yes, $CardType.UpperCase<% else %> No<% end_if %>																
							</td>
							<td>
								$Type
							</td>							
						</tr>
						<% end_loop %>
					</tbody>
				</table>

			<% else %>
				<p>No records found</p>
			<% end_if %>
			
