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
										<% with $Address %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>																																											
									</div>									
									<div class="large-4 cell">                                                                    
                                    <% with $HouseNo %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									
                                </div>
								<div class="grid-x grid-padding-x">
									<div class="large-3 cell">                                                                    											
									<% with $FamilyNo %>
										<label for="$ID">$Title</label>$Field
									<% end_with %>
									</div>
									<div class="large-3 cell">                                                                    											
									<% with $UnitNo %>
										<label for="$ID">$Title</label>$Field
									<% end_with %>
									</div>
									<div class="large-3 cell">                                                                    											
									<% with $UnitName %>
										<label for="$ID">$Title</label>$Field
									<% end_with %>
									</div>									
									<div class="large-3 cell">                                                                    											
									<% with $BlockNo %>
										<label for="$ID">$Title</label>$Field
									<% end_with %>
									</div>
									
								</div>
								
								<div class="grid-x grid-padding-x">											
									<div class="large-3 cell">
										<% with $Pincode %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>										
									<div class="large-3 cell">
										<% with $ContactNo %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>									
									
									<div class="large-3 cell">
										<% with $Email %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>
									<div class="large-3 cell">                                                                    											
									<% with $Aadhaar %>
										<label for="$ID">$Title</label>$Field
									<% end_with %>
									</div>
									
								</div>
								
								<div class="grid-x grid-padding-x">
									<div class="large-8 cell">
									<label>Check them to select</label>
                                    <% with $IsPanchayat %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>
                                    <% with $IsMunicipality %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>
                                    <% with $IsCorporation %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>									
									</div>																	
									<div class="large-4 cell">
									</div>	
								</div>

								<div class="grid-x grid-padding-x">											
									<div class="large-12 cell">
										<% with $Remark %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>										
									
								</div>

																
                            <% end_with %>		<%-- with $FieldMap --%>						
						
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
