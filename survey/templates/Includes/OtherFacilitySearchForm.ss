                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
					<label><strong>Other Facilities at home</strong></label>
                        <div class="row">
                            <% with $FieldMap %>
                            <div class="large-10 columns">
                                    
								<div class="row">			
									<div class="large-4 columns">									
                                    <% with $WaterWell %>
                                         <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
									<div class="large-4 columns">									
                                    <% with $DrillWell %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
									<div class="large-4 columns">									
									
                                    <% with $WaterConnection %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
								</div>
								<div class="row">
									<div class="large-4 columns">																		
                                    <% with $RainwaterStorage %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
									<div class="large-4 columns">									
                                    <% with $Biogas %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
									<div class="large-4 columns">									
																		
                                    <% with $Electricity %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>
									</div>
								</div>
								<div class="row">
									<div class="large-4 columns">																		
                                    <% with $SolarEnergy %>
                                        <label for="$ID">$Title</label>$Field 
                                    <% end_with %>					
									</div>
								</div>	
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
