<div class="main">
    <div class="row">
        <div class="large-9 medium-9 columns" id="content">

            <h3>Search results</h3>

            $HouseSearchForm

			<% if $PaginatedList %>
			<% include PaginationResult  Items=$PaginatedList %>
			<a href="{$Link(printlist)}?{$getUrlParameters}" target="_blank" title="Print"> Print <i class="fi-print"></i></a>
			|
			<a href="{$Link(export-to-csv)}?{$getUrlParameters}" target="_blank" title="Export"> export <i class="fi-download"></i></a>
			
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
						<% loop $PaginatedList %>
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

