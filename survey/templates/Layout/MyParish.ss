<div class="row main">
    <div class="large-12 columns">
        <h3>My Parish</h3>
        <div class="row main">
            <div class="large-6 columns">
                <h3>Parish</h3>
				<% if Updated %>
					<div data-alert class="alert-box success radius">
					$Updated
					<a href="#" class="close">&times;</a>
					</div>					
				<% end_if %>	
				$MyParish.Title<br>
				$MyParish.Address<br>
				<% if $MyParish.Landline %>Contact: $MyParish.Landline<br><% end_if %>
				<a href="$Link(edit)">edit </a>
            </div>
            <div class="large-6 columns">
                <h3>Recent members</h3>
				
                <div class="row">
                    <div class="large-12 columns ">
						<a href="$Link('add-member')">Add new member</a> | <a href="$Link('list-member')">List all members</a> <a>
						<% if RecentMembers %>
						<table>
							<thead>
								<tr>
									<th>ID</th><th>First Name</th><th></th>
								</tr>
							</thead>
							<tbody>
						<% loop RecentMembers %>
								<tr>
									<th>$ID</th>
									<th>$Name</th>
									<th>
										<a href="$Top.Link('edit-member')/$ID">edit</a> | 
										<a href="$Top.Link('delete-member')/$ID" onclick="return confirm('Are you sure?');">delete</a>
									</th>
								</tr>
						<% end_loop %>
							</tbody>
						</table>
						<% end_if %>
						
                    </div>
                </div>
				
            </div>
        </div>
    </div>
</div>


