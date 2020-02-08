                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>

                        <div class="row">
                            <% with $FieldMap %>
                                <% with $Pincode %>
                                    <div class="large-3	 columns">
                                        <label for="$ID">$Title</label> $Field
                                    </div>
                                <% end_with %>
                                <div class="large-7 columns">
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
                                <div class="Actions">
                                    <% loop $Actions %>
                                        <div class="large-2 columns">
                                            $addExtraClass('button')
                                        </div>
                                    <% end_loop %>
                                </div>
                            <% end_if %>

                        </div>
                    </fieldset>
                    <% if $IncludeFormTag %>
                    </form>
                    <% end_if %>
