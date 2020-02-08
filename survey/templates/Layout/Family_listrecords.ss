<div class="main">
    <div class="row">
        <div class="large-9 medium-9 columns" id="content">

		<a href="{$Link(add-family)}?&BackURL=$RequestedURL" title="Add Family"><i class="fi-page-add"></i> Add Family</a>
            <% if $PaginatedList %>
			<%-- include PaginationResult  Items=$PaginatedList --%>
			
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Family</th>
                        <th>Contact Person</th>
                        <th>Contact No</th>
                        <th>Block/Unit/Family</th>
                        <th>House No</th>
						<th width="100"></th>
                    </tr>
                    </thead>
                    <tbody>
                <% loop $PaginatedList %>
                    <tr>
                        <td>$Counter</td>
                        <td>$Name<br>{$Address}, $Pincode</td>
                        <td>$MemberName</td>
                        <td>$ContactNo</td>
                        <td>{$BlockNo}/{$UnitNo}/{$FamilyNo}</td>
                        <td>$HouseNo</td>
						<td>
							<a href="family/view/$ID?&BackURL=$Top.RequestedURL" title="View $Name"><i class="fi-page"></i></a>
							| 
							<a href="family/edit-family/$ID?&BackURL=$Top.RequestedURL" title="Edit $Name"><i class="fi-page-edit"></i></a>
							|
							<a href="family/delete-family/$ID?&BackURL=$Top.RequestedURL" title="Delete $Name" onclick="return confirm('Are you sure?');"><i class="fi-page-delete"></i></a>
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
	            <h3>Family </h3>
	            $FamilySearchForm       
        </div>
    </div>
</div>

