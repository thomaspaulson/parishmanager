
    <% if $IncludeFormTag %>
        <form $AttributesHTML>
    <% end_if %>
        <fieldset>
            <% if $Legend %><legend>$Legend</legend><% end_if %>

            
                <% with $FieldMap %>
                
						<div class="row">
							<div class="large-12 columns">
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
                <div class="row">
                    <div class="Actions">
                        <% loop $Actions %>
                            <div class="large-4 columns last">
                                $addExtraClass('button')
                            </div>
                        <% end_loop %>
                    </div>
                </div>    
                <% end_if %>
     


        </fieldset>
    <% if $IncludeFormTag %>
        </form>
    <% end_if %>

