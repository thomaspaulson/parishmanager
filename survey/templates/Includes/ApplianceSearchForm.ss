                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
						<label><strong>Appliance owned</strong></label>
                        <div class="grid-x grid-padding-x">
                            <% with $FieldMap %>
							<div class="large-10 cell">
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell">                                    										
                                    <% with $WashingMachine %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell">                                    																			
                                    <% with $AirConditioner %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell ">									
                                    <% with $MicrowaveOven %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>									
								</div>
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell ">									
                                    <% with $CookingGas %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell ">									
                                    <% with $Fridge %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell ">									
                                    <% with $Others %>
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
