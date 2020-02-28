                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
							
							
                        <div class="grid-x grid-padding-x">
							<div class="large-10 cell">
								
                            <% with $FieldMap %>
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell">                                                                    
                                    <% with $EducationFund %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell">                                                                    
                                    <% with $LifeInsurance %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell">                                                                    
                                    <% with $HealthInsurance %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
								</div>
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell">                                                                    
                                    <% with $DeathFund %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell">                                                                    
                                    <% with $MarriageFund %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									
									<div class="large-4 cell"> 																																		
									<% with $KLM %>
											<label for="$ID">$Title</label> $Field		
									<% end_with %>
									</div>								
                                </div>

								<div class="grid-x grid-padding-x">
									<div class="large-4 cell">                                                                    
                                    <% with $Chitty %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell">                                                                    
                                    <% with $WIDs %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 cell">                                                                    
                                    <% with $Others %>
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
