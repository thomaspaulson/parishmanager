<div class="main">
    <div class="row">
        <div class="large-9 medium-9 columns" id="content">

            <h3>Search results</h3>

            $LoanSearchForm

			<% if $PaginatedList %>
			<% include PaginationResult  Items=$PaginatedList %>
			<% include Navigation %>

				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Family</th>
						<th>Contact Person</th>						
						<th>Block/Unit/Family</th>
						<th></th>		
					</tr>
					</thead>
					<tbody>
						<% loop $PaginatedList %>
						<tr>
							<td>$Counter</td>
							<td>$Name<br>{$Address}, $Pincode</td>
							<td>$MemberName, $ContactNo	</td>
							<td>{$BlockNo}/{$UnitNo}/{$FamilyNo}</td>							
							<td>
								<% if $HasLoan %>$Reason<% end_if %>
							</td>
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
		
                <% include FamilySideBar %>            
				
        </div>

    </div>
</div>

