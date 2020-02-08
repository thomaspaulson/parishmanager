
                <% if $Results %>
					
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
                            <% loop $Results %>
                            <tr>
                                <td>$ID</td>
                                <td>$Name<br>{$Address}, $Pincode</td>
                                <td><% if $Contact %>$Contact.Name<% end_if %></td>
                                <td><% if $Contact %>$Contact.Mobile<% end_if %></td>
                                <td>{$InPanchayat}/{$InMunicipality}/{$InCorporation}</td>
                                <td>$HouseNo</td>
                            </tr>
                            <% end_loop %>
                        </tbody>
                    </table>
                    
                <% else %>
                    <p>No records found</p>
                <% end_if %>
