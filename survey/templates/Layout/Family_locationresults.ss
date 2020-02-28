
    <div class="grid-x grid-padding-x">
        <div class="large-9 medium-9 cell  small-order-1 medium-order-2">
				<h3>Search results</h3>
				$LocationSearchForm
				
                <% if $PaginatedList %>
					<% include PaginationResult  Items=$PaginatedList %>
					<a href="{$Link(print-by-location)}?{$getUrlParameters}" target="_blank" title="Print"> Print <i class="fi-print"></i></a>
					|
					<a href="{$Link(export-to-csv)}?{$getUrlParameters}" target="_blank" title="Print"> export <i class="fi-download"></i></a>
					
                    <table>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Family</th>
                            <th>Contact Person</th>
                            <th>Contact No</th>
                            <th>Panchayat/Municipality/Corporation</th>
                            <th>House No</th>
                        </tr>
                        </thead>
                        <tbody>
                            <% loop $PaginatedList %>
                            <tr>
                                <td>$Counter</td>
                                <td>$Name<br>{$Address}, $Pincode</td>
                                <td>$MemberName</td>
                                <td>$ContactNo</td>
                                <td><% if $IsPanchayat %>Yes<% else %>No<% end_if %>/
									<% if $IsMunicipality %>Yes<% else %>No<% end_if %>/
									<% if $InCorporation %>Yes<% else %>No<% end_if %></td>
                                <td>$HouseNo</td>
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
                <% include FamilySideBar %>
        </div>
    </div>

