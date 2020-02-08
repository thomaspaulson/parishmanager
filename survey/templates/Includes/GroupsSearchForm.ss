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
                    
						<% with $FieldMap %>
						<div class="row">
							<% with $Group %>
								<div class="large-6 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							
							<div class="large-6 columns">
							</div>	
							
						
						</div>
						<% end_with %>              

                    <% if $Actions %>
						<div class="row">
                        <div class="Actions">
                            <% loop $Actions %>
                                <div class="large-12 columns">
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
