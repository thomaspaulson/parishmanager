<div class="main">
    <div class="row">
        <div class="large-9 medium-9 columns" id="content">

            <h2>Search results</h2>

            $FamilyMemberSearchForm

			<% if $PaginatedList %>
			<% include PaginationResult  Items=$PaginatedList %>
			<% include Navigation %>			
				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Gender / DOB / Age</th>						
						<th>Group(B) / Status / Marriage (Dt)</th>
						<th>Family</th>
						<th>Unit / Contact</th>												
						</th>
					<tr>	
					</thead>
					<tbody>
						<% loop $PaginatedList %>
						<tr>
							<td>$Counter</td>
							<td>$Name<br></td>
							<td>{$Top.Sex($Gender)} / {$Top.DOB($DateOfBirth, 'd-m-Y')} / {$Top.Age($DateOfBirth, $Age)} yrs</td>
							<td> $BloodGroup / $Top.MStatus($MartialStatus)  <% if $DateOfMarriage %>	/ $Top.DOB($DateOfMarriage, 'd-m-Y') <% end_if %>	</td>							
							<td>$FamilyName							
							</td>						
							<td>$UnitNo / $ContactNo</td>						
							<td>
								<a href="members/view/$ID" data-reveal-id="myModal" data-reveal-ajax="true" title="View $Name"><i class="fi-page"></i></a>
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
		
                <% include FamilyMemberSideBar %>            
				
        </div>

    </div>
</div>

