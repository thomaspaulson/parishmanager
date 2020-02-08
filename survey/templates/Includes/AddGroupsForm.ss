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
						<div class="large-12 columns"> 
							<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
						<% loop ListGroups %>							
								<li><input type="checkbox" name="CommunityGroups[]" value="$ID" <% if $Top.InGroup($ID) %>checked="checked"<% end_if %> /> $Title </li>
						<% end_loop %>							
							</ul>
						</div>
					</div>
					
					<div class="row">	
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyMemberID')					
					
					<% if $Fields.fieldByName('ID')	%>
						$Fields.fieldByName('ID')						
					<% end_if %>
					
                    <% if $Actions %>
                        <div class="Actions">
                        	<div class="large-12 columns">
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
