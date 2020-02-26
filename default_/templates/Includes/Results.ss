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
            </th>
        </thead>
        <tbody>
            <% loop $Results %>
            <tr>
                <td>$ID</td>
                <td>$Name<br>{$Address}, $Pincode</td>
                <td><% if $Contact %>$Contact.Name<% end_if %></td>
                <td><% if $Contact %>$Contact.Mobile<% end_if %></td>
                <td>{$BlockNo}/{$UnitNo}/{$FamilyNo}</td>
                <td>$HouseNo</td>
            </tr>
            <% end_loop %>
        </tbody>
    </table>
    <% include Pagination Items=$Results %>
<% else %>
    <p>No records found</p>
<% end_if %>
