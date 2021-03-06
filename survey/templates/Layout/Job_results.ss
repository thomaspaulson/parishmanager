    <div class="grid-x grid-padding-x">
        <div class="large-9 medium-9 cell  small-order-1 medium-order-2"> 
            <h3>Search results</h3>

            $JobSearchForm

			<% if $PaginatedList %>
			<% include PaginationResult  Items=$PaginatedList %>
			<% include Navigation %>			
				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>										
						<th>Gender / DOB / Age</th>
						<th>Job Title</th>
						<th>Family</th>
						<th>Unit / Contact</th>												
						
					</tr>
					</thead>
					<tbody>
						<% loop $PaginatedList %>
						<tr>
							<td>$ID</td>
							<td>$Name<br></td>
							<td>{$Gender} / {$Top.FormatDate($DateOfBirth, 'd-m-Y')} / {$Top.Age($DateOfBirth, $Age)} yrs </td>
							<td>
								$Title ($Top.JobType($Type))								
							</td>
							<td>$FamilyName</td>
							<td>$UnitNo / $ContactNo</td>						
							
						</tr>
						<% end_loop %>
					</tbody>
				</table>
				<% include Pagination Items=$PaginatedList %>
			<% else %>
				<p>No records found</p>
			<% end_if %>
			
       </div><!-- div id="content" -->
        <div class="large-3 medium-3 cell small-order-2 medium-order-1">
            <% include FamilyMemberSideBar %>
        </div>
    </div>
