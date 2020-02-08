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
					
						<div class="row">
							<div class="large-4 columns"> 																																		
							<% with $Specify %>
								<label for="$ID">$Title</label> $Field		
							<% end_with %>
							</div>									
							<div class="large-4 columns"> 																																		
							</div>																		
						</div>                    
					<% end_with %>		<%-- with $FieldMap --%>						
						
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyID')					
					
					<% if $Fields.fieldByName('ID')	%>
						$Fields.fieldByName('ID')						
					<% end_if %>
					
					<div class="row">
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
