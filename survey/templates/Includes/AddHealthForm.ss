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
							
							<% with $Blind %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Deaf %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Dumb %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>			
													
							<% with $OtherPhysicalDisability %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
														
							<% with $MentalDisability %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>		
														
							<% with $HearthDisease %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Diabetes %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>		
							
							<% with $Cancer %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>							
																				
							<% with $BloodPressure %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $Alcoholic %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							</div>																	
						</div>
					
						<div class="row">
							<div class="large-4 columns last">
							<% with $OtherDisease %>
								$Field<label for="$ID">$Title</label>
							<% end_with %>
							
							<% with $OtherHealthInfo %>
								<label for="$ID">$Title</label> $Field		
							<% end_with %>
							</div>									
						</div>                                                

                    <% end_with %>		<%-- with $FieldMap --%>						
						
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyMemberID')					
					
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
