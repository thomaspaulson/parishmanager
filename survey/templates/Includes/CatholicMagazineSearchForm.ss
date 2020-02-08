                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
					<label><strong>Catholic Magazine subscription, ...</strong></label>
                        <div class="row">
                            <% with $FieldMap %>
                                <div class="large-9 columns">
                                    <div class="row">
										<div class="large-4 columns">
										<% with $Jeevadeepthi %>
											 <label for="$ID">$Title</label> $Field
										<% end_with %>
										</div>
										<div class="large-4 columns">
										<% with $Jeevanaadam %>
											<label for="$ID">$Title</label> $Field
										<% end_with %>
										</div>
										<div class="large-4 columns">										
										<% with $Christain %>
											<label for="$ID">$Title</label> $Field
										<% end_with %>
										</div>
									</div>
									<div class="row">
										<div class="large-4 columns">										
										<% with $PreshithaKeralam %>
											<label for="$ID">$Title</label> $Field
										<% end_with %>
										</div>
										<div class="large-4 columns">																				
										<% with $Shalom %>
											<label for="$ID">$Title</label> $Field
										<% end_with %>
										</div>																
										<div class="large-4 columns">										
										<% with $Cherupushpam %>
											<label for="$ID">$Title</label> $Field
										<% end_with %>										
										</div>
									</div>
									<div class="row">
										<div class="large-4 columns">																				
										<% with $Others %>
											<label for="$ID">$Title</label> $Field
										<% end_with %>
										</div>
										<div class="large-8 columns ">
										<% with $ParishID %>									
												<label for="$ID">$Title</label> $Field									
										<% end_with %>
										</div>
									</div>	
								
								</div>
                            <% end_with %>

                            <% if $Actions %>
                                <div class="Actions">
                                    <% loop $Actions %>
                                        <div class="large-3 columns">
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
