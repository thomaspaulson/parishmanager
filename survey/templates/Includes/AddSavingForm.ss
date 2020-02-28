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
						<div class="grid-x grid-padding-x ">
							<div class="large-12 cell">
							<label>Check them to select</label>
							<% with $EducationFund %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $LifeInsurance %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $HealthInsurance %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>		
														
							<% with $DeathFund %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $MarriageFund %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							
							<% with $KLM %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>									
							
							<% with $Chitty %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>

							<% with $WIDs %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Others %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							</div>																	
						</div>
					
						<div class="grid-x grid-padding-x ">
							<div class="large-4 cell"> 																																		
							<% with $Specify %>
								<label for="$ID">$Title</label> $Field		
							<% end_with %>
							</div>									
							<div class="large-4 cell"> 																																		
							</div>																		
						</div>                                                

                    <% end_with %>		<%-- with $FieldMap --%>						
						
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyID')										
					
					<% if $Fields.fieldByName('ID')	%>
						$Fields.fieldByName('ID')						
					<% end_if %>
					
                    <% if $Actions %>
                        <div class="grid-x grid-padding-x Actions">
                        	<div class="large-12 cell">
                            <% loop $Actions %>                                
									$addExtraClass('button')                                
                            <% end_loop %>
                            </div>
                        </div>
                    <% end_if %>
                    
                    </fieldset>
                <% if $IncludeFormTag %>
                </form>
                <% end_if %>
