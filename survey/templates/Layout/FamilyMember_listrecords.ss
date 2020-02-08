<div class="main">
    <div class="row">
        <div class="large-9 medium-9 columns" id="content">            

			<% if $PaginatedList %>
			<% include PaginationResult  Items=$PaginatedList %>			
				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Family</th>						
						<th>Gender / DOB / Age</th>
						<th>Blood G / Status</th>		
						<th></th>
					<tr>	
					</thead>
					<tbody>
						<% loop $PaginatedList %>
						<tr>
							<td>$ID</td>
							<td>$Name<br></td>
							<td>$FamilyName</td>							
							<td>{$Top.Sex($Gender)}  / {$Top.DOB($DateOfBirth, 'd-m-Y')} / {$Top.Age($DateOfBirth, $Age)} yrs</td>							
							<td>
								$BloodGroup / $Top.MStatus($MartialStatus)
							</td>
							<td>
								<a href="members/view/$ID?&BackURL=$Top.RequestedURL" title="View $Name"><i class="fi-page"></i></a>
								| 
								<a href="members/edit-member/$ID?&BackURL=$Top.RequestedURL" title="Edit $Name"><i class="fi-page-edit"></i></a>
								|
								<a href="members/delete-member/$ID?&BackURL=$Top.RequestedURL" title="Delete $Name" onclick="return confirm('Are you sure?');"><i class="fi-page-delete"></i></a>							
								
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
		        <h3>Family Member</h3>
	            $FamilyMemberLiteSearchForm                      
				
        </div>

    </div>
</div>

