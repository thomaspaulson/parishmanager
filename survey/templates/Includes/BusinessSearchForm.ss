
    <% if $IncludeFormTag %>
        <form $AttributesHTML>
    <% end_if %>
        <fieldset>
            <% if $Legend %><legend>$Legend</legend><% end_if %>

            
                <% with $FieldMap %>
						<div class="grid-x grid-padding-x">
							<div class="large-12 cell">
							<label>Check them to select</label>
							<% with $Streetvendor %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							<% with $Unduvandi %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							<% with $Pettikada %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							<% with $Shop %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							<% with $Trade %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							<% with $Industry %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							<% with $Selfemployed %>
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

