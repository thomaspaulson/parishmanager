
            <% if $Results %>
			
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Family</th>
                        <th>Contact Person</th>
                        <th>Contact No</th>
                        <th>Block/Unit/Family</th>
                        <th>House No</th>
                    </tr>
                    </thead>
                    <tbody>
                <% loop $Results %>
                    <tr>
                        <td>$ID</td>
                        <td>$Name<br>{$Address}, $Pincode</td>
                        <td>$MemberName</td>
                        <td>$ContactNo</td>
                        <td>{$BlockNo}/{$UnitNo}/{$FamilyNo}</td>
                        <td>$HouseNo</td>
                    </tr>
                <% end_loop %>
                    </tbody>
                </table>
            <% else %>
                <p>No records found</p>
            <% end_if %>
