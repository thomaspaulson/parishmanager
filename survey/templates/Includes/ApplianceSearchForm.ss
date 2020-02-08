                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
						<label><strong>Appliance owned</strong></label>
                        <div class="row">
                            <% with $FieldMap %>
							<div class="large-10 columns">
								<div class="row">
									<div class="large-4 columns">                                    										
                                    <% with $WashingMachine %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns">                                    																			
                                    <% with $AirConditioner %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns ">									
                                    <% with $MicrowaveOven %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>									
								</div>
								<div class="row">
									<div class="large-4 columns ">									
                                    <% with $CookingGas %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns ">									
                                    <% with $Fridge %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns ">									
                                    <% with $Others %>
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
