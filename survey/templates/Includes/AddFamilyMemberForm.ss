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
                            <% with $FieldMap %>
								<div class="row">
									<div class="large-4 columns">                                                                    
                                    <% with $Name %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									
									<div class="large-4 columns"> 																																		
										<% with $Relation %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>

									<div class="large-4 columns"> 																																		
										<% with $Gender %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>									
									
                                </div>
								<div class="row">								
									<div class="large-12 columns">                                                                    
                                    <% with $MartialStatus %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
                                </div>
								<div class="row">
									<div class="large-4 columns"> 																																		
										<% with $Age %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>									
									<div class="large-4 columns"> 																																		
										<% with $DateOfBirth %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>
									<div class="large-4 columns"> 																																		
										<% with $DateOfMarriage %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>
									
                                </div>
                                
								<div class="row">									
									<div class="large-8 columns">
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
									<div class="large-4 columns">                                                                    
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
