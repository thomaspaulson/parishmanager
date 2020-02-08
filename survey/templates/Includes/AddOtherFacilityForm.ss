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
                    
					<% with $FieldMap %>
						<div class="row">
							<div class="large-12 columns">
							<label>Check them to select</label>
							<% with $WaterWell %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $DrillWell %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $WaterConnection %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							
							<% with $RainwaterStorage %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Biogas %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>												
											
							<% with $Electricity %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $SolarEnergy %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							</div>																	
						</div>
					
					<% end_with %>		<%-- with $FieldMap --%>						
						
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyID')					
					
					<% if $Fields.fieldByName('ID')	%>
						$Fields.fieldByName('ID')						
					<% end_if %>
					
					<div class="row">
                    <% if $Actions %>
                        <div class="Actions">
                        	<div class="large-12 columns">
                            <% loop $Actions %>
                                
									$addExtraClass('button')
                                
                            <% end_loop %>
                            </div>
                        </div>
                    <% end_if %>
                    </div>
                    </fieldset>
                <% if $IncludeFormTag %>
                </form>
                <% end_if %>
