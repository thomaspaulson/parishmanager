                <% if $IncludeFormTag %>
                <form $AttributesHTML>
                <% end_if %>
                <% if $Message %>
                    <p id="{$FormName}_error" class="message $MessageType">$Message</p>
                <% else %>
                    <p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
                <% end_if %>

                <fieldset>
                    <% if $Legend %><legend>$Legend</legend><% end_if %>
                    
						
						<div class="row">
							<div class="large-6 columns">
							<div class="row">																
							<% with $FieldMap %>
								<div class="large-4 columns">
								<% with $Day %>
									<label for="$ID">$Title</label>$Field							
								<% end_with %>
								</div>
								<div class="large-4 columns">
								<% with $Month %>
									<label for="$ID">$Title</label>$Field							
								<% end_with %>
								</div>
								<div class="large-4 columns">
								<% with $Year %>
									<label for="$ID">$Title</label>$Field							
								<% end_with %>
								</div>
							<% end_with %>
							</div>
							</div>
							<div class="large-6 columns">
						<% if $Actions %>
							<div class="Actions">
								<% loop $Actions %>                                
									$addExtraClass('button')                                
								<% end_loop %>
							</div>
						<% end_if %>
								
							</div>	
						</div>
						

                    
                    </fieldset>
                <% if $IncludeFormTag %>
                </form>
                <% end_if %>
