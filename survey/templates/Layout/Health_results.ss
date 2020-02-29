    <div class="grid-x grid-padding-x">
        <div class="large-9 medium-9 cell  small-order-1 medium-order-2"> 
            <h3>Search results</h3>

            $HealthSearchForm

			<% if $PaginatedList %>
			<% include PaginationResult  Items=$PaginatedList %>
			<% include Navigation %>

				<table>
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Gender / DOB / Age</th>
						<th>Health (other)</th>
						<th>Family</th>
						<th>Unit / Contact</th>												
						
					</tr>
					</thead>
					<tbody>
						<% loop $PaginatedList %>
						<tr>
							<td>$Counter</td>
							<td>$Name<br></td>
							<td>{$Gender} / {$Top.FormatDate($DateOfBirth, 'd-m-Y')} / {$Top.Age($DateOfBirth, $Age)} yrs </td>													
							<td>								
								<% if $Blind %>Blind, <% end_if %>
								<% if $Deaf %>Deaf, <% end_if %>
								<% if $Dumb %>Dumb, <% end_if %>
								<% if $OtherPhysicalDisability %>OtherPhysicalDisability. <% end_if %>
								<% if $MentalDisability %>Mental Disability, <% end_if %>
								<% if $HearthDisease %>Heart Disease, <% end_if %>								
								<% if $Diabetes %>Diabetes,<% end_if %>
								<% if $Cancer %>Cancer, <% end_if %>
								<% if $BloodPressure %>Blood Pressure,<% end_if %>
								<% if $Alcoholic %>Alcoholic,<% end_if %>
								<% if $OtherDisease %>OtherDisease, $OtherHealthInfo<% end_if %>					

								
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


