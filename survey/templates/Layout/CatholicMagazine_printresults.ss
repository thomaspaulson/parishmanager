

			<% if $Results %>
			
				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Family</th>
						<th>Contact Person</th>						
						<th>Block/Unit/Family</th>
						<th>Catholic Magazines</th>		
					</tr>
					</thead>
					<tbody>
						<% loop $Results %>
						<tr>
							<td>$ID</td>
							<td>$Name<br>{$Address}, $Pincode</td>
							<td><% if $Contact %>$Contact.Name<% end_if %>
							<% if $Contact %><br>$Contact.Mobile<% end_if %></td>							
							<td>{$BlockNo}/{$UnitNo}/{$FamilyNo}</td>							
							<td>
								<% if $CatholicMagazine %>
									$CatholicMagazine.Magazines 
								<% end_if %>
							</td>
						</tr>
						<% end_loop %>
					</tbody>
				</table>

			<% else %>
				<p>No records found</p>
			<% end_if %>
			
