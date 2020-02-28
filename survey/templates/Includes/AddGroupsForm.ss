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
                                                
					<div class="grid-x grid-padding-x">
						<div class="large-12 cell"> 
							<div  class="grid-x grid-padding-x small-up-2 medium-up-4 large-up-4">
						<% loop ListGroups %>							
								<div class="cell"><input type="checkbox" name="CommunityGroups[]" value="$ID" <% if $Top.InGroup($ID) %>checked="checked"<% end_if %> /> $Title </div>
						<% end_loop %>							
							</div>
						</div>
					</div>
					
					<div class="grid-x grid-padding-x">	
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyMemberID')					
					
					<% if $Fields.fieldByName('ID')	%>
						$Fields.fieldByName('ID')						
					<% end_if %>
					
                    <% if $Actions %>
                        <div class="Actions">
                        	<div class="large-12 cell">
                            <% loop $Actions %>                                
									$addExtraClass('button')                                
                            <% end_loop %>
                            </div>
                        </div>
                    <% end_if %>
                    </div>
                    </fieldset>
                <% if $IncludeFormTag %>
                </form>
                <% end_if %>
