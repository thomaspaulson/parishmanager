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
								<div class="row">
									<div class="large-4 columns">
									$Fields.fieldByName('Code[]')
									</div>
									<div class="large-4 columns">
										$Fields.fieldByName('Subject[]')									
									</div>
									<div class="large-4 columns">																	
										$Fields.fieldByName('Status[]')																		
									</div>									
                                </div>
					</div>
                    <div class="row">                            
								<div class="row">
									<div class="large-4 columns">
									$Fields.fieldByName('Code[]')
									</div>
									<div class="large-4 columns">
										$Fields.fieldByName('Subject[]')									
									</div>
									<div class="large-4 columns">																	
										$Fields.fieldByName('Status[]')																		
									</div>									
                                </div>
					</div>			
                    <div class="row">                            
								<div class="row">
									<div class="large-4 columns">
									$Fields.fieldByName('Code[]')
									</div>
									<div class="large-4 columns">
										$Fields.fieldByName('Subject[]')									
									</div>
									<div class="large-4 columns">																	
										$Fields.fieldByName('Status[]')																		
									</div>									
                                </div>
					</div>			
                    <div class="row">                            
								<div class="row">
									<div class="large-4 columns">
									$Fields.fieldByName('Code[]')
									</div>
									<div class="large-4 columns">
										$Fields.fieldByName('Subject[]')									
									</div>
									<div class="large-4 columns">																	
										$Fields.fieldByName('Status[]')																		
									</div>									
                                </div>
					</div>			
                    <div class="row">                            
								<div class="row">
									<div class="large-4 columns">
										$Fields.fieldByName('Code[]')
									</div>
									<div class="large-4 columns">
										$Fields.fieldByName('Subject[]')									
									</div>
									<div class="large-4 columns">																	
										$Fields.fieldByName('Status[]')																		
									</div>									
                                </div>
					</div>			
                    <div class="row">                            
								<div class="row">
									<div class="large-4 columns">
									$Fields.fieldByName('Code[]')
									</div>
									<div class="large-4 columns">
										$Fields.fieldByName('Subject[]')									
									</div>
									<div class="large-4 columns">																	
										$Fields.fieldByName('Status[]')																		
									</div>									
                                </div>
					</div>			
                    <div class="row">                            
								<div class="row">
									<div class="large-4 columns">
									$Fields.fieldByName('Code[]')
									</div>
									<div class="large-4 columns">
										$Fields.fieldByName('Subject[]')									
									</div>
									<div class="large-4 columns">																	
										$Fields.fieldByName('Status[]')																		
									</div>									
                                </div>
					</div>			
                    <div class="row">                            
								<div class="row">
									<div class="large-4 columns">
										$Fields.fieldByName('Code[]')
									</div>
									<div class="large-4 columns">
										$Fields.fieldByName('Subject[]')									
									</div>
									<div class="large-4 columns">																	
										$Fields.fieldByName('Status[]')																		
									</div>									
                                </div>
					</div>			

					
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyMemberID')					
						
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
