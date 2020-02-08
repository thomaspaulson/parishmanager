                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
							<label><strong>Media ie newspaper, magazine, ...</strong></label>
                        <div class="row">
                            <% with $FieldMap %>
							<div class="large-10 columns">                                    
									<div class="row">
										<div class="large-4 columns">	
										<% with $Newspaper %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
										<div class="large-4 columns">										
										<% with $Television %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>										
										<div class="large-4 columns">	
										<% with $Magazine %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
									</div>
									<div class="row">
										<div class="large-4 columns">										
										<% with $KidsMagazine %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>										
										<div class="large-4 columns">										
										<% with $Internet %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
										<div class="large-4 columns">																				
										<% with $CatholicMagazine %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
									</div>			

									<div class="row">
										<div class="large-4 columns">																				
										<% with $Computer %>
											<label for="$ID">$Title</label>$Field 
										<% end_with %>
										</div>
										<div class="large-8 columns">																				
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
