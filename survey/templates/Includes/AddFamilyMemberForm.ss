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
									<div class="large-4 cell">                                                                    
                                    <% with $Name %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									
									<div class="large-4 cell"> 																																		
										<% with $Relation %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>

									<div class="large-4 cell"> 																																		
										<% with $Gender %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>									
									
                                </div>
								<div class="grid-x grid-padding-x">								
									<div class="large-12 cell">                                                                    
                                    <% with $MartialStatus %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
                                </div>
								<div class="grid-x grid-padding-x">
									<div class="large-4 cell"> 																																		
										<% with $Age %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>									
									<div class="large-4 cell"> 																																		
										<% with $DateOfBirth %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>
									<div class="large-4 cell"> 																																		
										<% with $DateOfMarriage %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>
									
                                </div>
                                
								<div class="grid-x grid-padding-x">									
									<div class="large-8 cell">
									<label>Check them to select</label>
                                    <% with $HoldsPassport %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>
                                    <% with $HoldsBankAccount %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>
                                    <% with $HoldsDrivingLicence %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>									
									</div>				
									<div class="large-4 cell">                                                                    
                                    <% with $BloodGroup %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
													
								</div>
                            <% end_with %>		<%-- with $FieldMap --%>						
					
					$Fields.fieldByName('FamilyID')
					$Fields.fieldByName('ParishID')	
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					
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
