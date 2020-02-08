                <% if $IncludeFormTag %>
                <form $AttributesHTML>
                <% end_if %>
                <% if $Message %>
                    <p id="{$FormName}_error" class="message $MessageType">$Message</p>
                <% else %>
                    <p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
                <% end_if %>

                <fieldset>
                    <% if $Legend %><legend>$Legend</legend><% end_if %>

                    <div class="row">
						<div class="large-10 columns">
							<div class="row">
                            <% with $FieldMap %>
                                <% with $Name %>
                                    <div class="large-4 columns">
                                        <label for="$ID">$Title</label> $Field
                                    </div>
                                <% end_with %>
							
                                <% with $BlockNo %>
                                    <div class="large-4 columns">
                                        <label for="$ID">$Title</label> $Field
                                    </div>
                                <% end_with %>
                                <% with $UnitNo %>
                                    <div class="large-4 columns">
                                        <label for="$ID">$Title</label> $Field
                                    </div>
                                <% end_with %>
                                
                            <% end_with %>
							</div>
						</div>


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
