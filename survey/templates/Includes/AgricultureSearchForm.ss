
    <% if $IncludeFormTag %>
        <form $AttributesHTML>
    <% end_if %>
        <fieldset>
            <% if $Legend %><legend>$Legend</legend><% end_if %>

            
                <% with $FieldMap %>
                
						<div class="grid-x grid-padding-x">
							<div class="large-12 cell">
							<label>Check them to select</label>
							
							<% with $Cocunut %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Produce %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Paddy %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>		
														
							<% with $Fruit %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Fish %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>		
														
							<% with $Cow %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>		
														
							<% with $Goat %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Chicken %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>		
														
							<% with $Duck %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>		
												
							<% with $Others %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							</div>																	
						</div>						
					
                <% end_with %>


                <% if $Actions %>
                	<div class="grid-x grid-padding-x">                    
                        <% loop $Actions %>							
                            <div class="large-4 cell last">
								<div class="Actions">
                                $addExtraClass('button')
								</div>
                            </div>
                        <% end_loop %>                    
                	</div>    
                <% end_if %>
     


        </fieldset>
    <% if $IncludeFormTag %>
        </form>
    <% end_if %>

