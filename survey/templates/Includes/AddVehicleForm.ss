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
							<% with $Cycle %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							<% with $Bike %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							<% with $Autoriskaw %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							<% with $LightVehicle %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							<% with $HeavyCommercial %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							<% with $CountryBoat %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							<% with $Vallam %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							<% with $FishingBoat %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							<% with $TouristBoat %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>							
							<% with $Others %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							</div>																	
						</div>
					
						<div class="row">
							<div class="large-4 columns"> 																																		
							<% with $Specify %>
								<label for="$ID">$Title</label> $Field		
							<% end_with %>
							</div>									
							<div class="large-4 columns"> 																																		
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
