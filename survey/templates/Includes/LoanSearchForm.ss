                    <% if $IncludeFormTag %>
                    <form $AttributesHTML>
                    <% end_if %>
                    <fieldset>
                        <% if $Legend %><legend>$Legend</legend><% end_if %>
							
							
                        <div class="grid-x grid-padding-x">
							<div class="large-10 cell">
								
                            <% with $FieldMap %>
								<div class="grid-x grid-padding-x">
									<div class="large-6 cell">                                                                    
										<% with $HasLoan %>
											<label for="$ID">$Title</label>$Field
										<% end_with %>
									</div>
									<div class="large-6 cell">
										<label>From</label>
										<% with $FromBank %>
											$Field<label for="$ID">$Title</label>
										<% end_with %>
										<% with $FromPrivateBank %>
											$Field<label for="$ID">$Title</label>
										<% end_with %>
										<% with $FromPerson %>
											$Field<label for="$ID">$Title</label>
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
