                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
							<label><strong>Owns any vehicle mentioned below</strong></label>
							
                        <div class="grid-x grid-padding-x">
							<div class="large-10 cell">
								
                            <% with $FieldMap %>
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell">                                                                    
                                    <% with $Cycle %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell"> 
                                    <% with $Bike %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell"> 									
                                    <% with $Autoriskaw %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
								</div>
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell"> 									
                                    <% with $LightVehicle %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell"> 																		
                                    <% with $HeavyCommercial %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell"> 																		
									
                                    <% with $CountryBoat %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
								</div>
								<div class="grid-x grid-padding-x">								
									<div class="large-4 cell"> 							
                                    <% with $Vallam %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell"> 																		
									
                                    <% with $FishingBoat %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell"> 																		
									
                                    <% with $TouristBoat %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>																	
									</div>
								</div>
                            <% end_with %>
							</div>
							
                            <% if $Actions %>                                
                                    <div class="large-2 cell">
                                    <% loop $Actions %>
                                            <div class="Actions">                                                
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
