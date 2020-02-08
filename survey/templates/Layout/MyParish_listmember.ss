<div class="row main">
    <div class="large-12 columns">
        <h3>$Title	</h3>
        <div class="row main">
            <div class="large-6 columns">
				
						<a href="$Link('add-member')">Add new member</a>
						
						<% if Results %>
						<table>
							<thead>
								<tr>
									<th>ID</th><th>First Name</th><th></th>
								</tr>
							</thead>
							<tbody>
						<% loop Results %>
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


