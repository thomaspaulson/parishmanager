                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
							<label><strong>Owns any vehicle mentioned below</strong></label>
							
                        <div class="row">
							<div class="large-10 columns">
								
                            <% with $FieldMap %>
								<div class="row">
									<div class="large-4 columns">                                                                    
                                    <% with $Cycle %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns"> 
                                    <% with $Bike %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns"> 									
                                    <% with $Autoriskaw %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
								</div>
								<div class="row">
									<div class="large-4 columns"> 									
                                    <% with $LightVehicle %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns"> 																		
                                    <% with $HeavyCommercial %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns"> 																		
									
                                    <% with $CountryBoat %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
								</div>
								<div class="row">								
									<div class="large-4 columns"> 							
                                    <% with $Vallam %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns"> 																		
									
                                    <% with $FishingBoat %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns"> 																		
									
                                    <% with $TouristBoat %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>																	
									</div>
								</div>
                            <% end_with %>
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
