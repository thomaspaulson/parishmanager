                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
					<label><strong>Other Facilities at home</strong></label>
                        <div class="grid-x grid-padding-x">
                            <% with $FieldMap %>
                            <div class="large-10 cell">
                                    
								<div class="grid-x grid-padding-x">			
									<div class="large-4 cell">									
                                    <% with $WaterWell %>
                                         <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
									<div class="large-4 cell">									
                                    <% with $DrillWell %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
									<div class="large-4 cell">									
									
                                    <% with $WaterConnection %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
								</div>
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell">																		
                                    <% with $RainwaterStorage %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
									<div class="large-4 cell">									
                                    <% with $Biogas %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
									<div class="large-4 cell">									
																		
                                    <% with $Electricity %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
								</div>
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell">																		
                                    <% with $SolarEnergy %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>					
									</div>
								</div>	
                            </div>								
                            <% end_with %>

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
