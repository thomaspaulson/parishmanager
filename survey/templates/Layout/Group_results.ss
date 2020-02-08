<div class="main">
    <div class="row">
        <div class="large-9 medium-9 columns" id="content">

            <h3>Search results</h3>

            $GroupsSearchForm

			<% if $PaginatedList %>
			<% include PaginationResult  Items=$PaginatedList %>
			<% include Navigation %>			
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
						<% loop $PaginatedList %>
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
				<% include Pagination Items=$PaginatedList %>
			<% else %>
				<p>No records found</p>
			<% end_if %>
			
       </div><!-- div id="content" -->

        <div class="large-3 medium-3 columns" id="sidebar">            
		
                <% include FamilyMemberSideBar %>            
				
        </div>

    </div>
</div>

