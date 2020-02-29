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
						<div class="grid-x grid-padding-x">
							<% with $Type %>
								<div class="large-6 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							<% with $Location %>
								<div class="large-6 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
						</div>						
						
						<% end_with %>              

                    <% if $Actions %>
						<div class="grid-x grid-padding-x">
                            <div class="large-12 cell">
                            <% loop $Actions %>
                                <div class="Actions">
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
