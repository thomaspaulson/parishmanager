                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>

                        <div class="grid-x grid-padding-x">
                            <% with $FieldMap %>
                                <% with $Pincode %>
                                    <div class="large-3	 cell">
                                        <label for="$ID">$Title</label> $Field
                                    </div>
                                <% end_with %>
                                <div class="large-7 cell">
                                    <label>Check them to select</label>
                                    <% with $IsPanchayat %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>
                                    <% with $IsMunicipality %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>
                                    <% with $IsCorporation %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>
                                </div>
                            <% end_with %>

                            <% if $Actions %>                                
                                <% loop $Actions %>
                                    <div class="large-2 cell">
                                        <div class="Actions">
                                        <label>&nbsp;</label>
                                        $addExtraClass('button')
                                        </div>
                                    </div>
                                <% end_loop %>                                
                            <% end_if %>

                        </div>
                    </fieldset>
                    <% if $IncludeFormTag %>
                    </form>
                    <% end_if %>
