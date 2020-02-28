                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
							<label><strong>Media ie newspaper, magazine, ...</strong></label>
                        <div class="grid-x grid-padding-x">
                            <% with $FieldMap %>
							<div class="large-10 cell">                                    
									<div class="grid-x grid-padding-x">
										<div class="large-4 cell">	
										<% with $Newspaper %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
										<div class="large-4 cell">										
										<% with $Television %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>										
										<div class="large-4 cell">	
										<% with $Magazine %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
									</div>
									<div class="grid-x grid-padding-x">
										<div class="large-4 cell">										
										<% with $KidsMagazine %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>										
										<div class="large-4 cell">										
										<% with $Internet %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
										<div class="large-4 cell">																				
										<% with $CatholicMagazine %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
									</div>			

									<div class="grid-x grid-padding-x">
										<div class="large-4 cell">																				
										<% with $Computer %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
										<div class="large-8 cell">																				
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
