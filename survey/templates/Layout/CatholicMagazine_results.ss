<div class="main">
    <div class="row">
        <div class="large-9 medium-9 columns" id="content">

           <h3>Search results</h3>

            $CatholicMagazineSearchForm

			<% if $PaginatedList %>
			<% include PaginationResult  Items=$PaginatedList %>
			<a href="{$Link(printlist)}?{$getUrlParameters}" target="_blank" title="Print"> Print <i class="fi-print"></i></a>
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
						<% loop $PaginatedList %>
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

