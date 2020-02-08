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
					
					<div class="row">
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
