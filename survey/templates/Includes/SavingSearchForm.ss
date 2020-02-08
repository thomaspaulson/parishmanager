                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
							
							
                        <div class="row">
							<div class="large-10 columns">
								
                            <% with $FieldMap %>
								<div class="row">
									<div class="large-4 columns">                                                                    
                                    <% with $EducationFund %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns">                                                                    
                                    <% with $LifeInsurance %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns">                                                                    
                                    <% with $HealthInsurance %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
								</div>
								<div class="row">
									<div class="large-4 columns">                                                                    
                                    <% with $DeathFund %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns">                                                                    
                                    <% with $MarriageFund %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									
									<div class="large-4 columns"> 																																		
									<% with $KLM %>
											<label for="$ID">$Title</label> $Field		
									<% end_with %>
									</div>								
                                </div>

								<div class="row">
									<div class="large-4 columns">                                                                    
                                    <% with $Chitty %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns">                                                                    
                                    <% with $WIDs %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns">                                                                    
                                    <% with $Others %>
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
