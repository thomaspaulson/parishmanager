	
    <% if $IncludeFormTag %>
        <form $AttributesHTML>
    <% end_if %>
        <fieldset>
            <% if $Legend %><legend>$Legend</legend><% end_if %>

            <div class="row">
				<div class="large-10  columns">
                <% with $FieldMap %>
					<div class="row">
                    <% with $Status %>
                        <div class="large-6 columns">
                            <label for="$ID">$Title</label> $Field
                        </div>
                    <% end_with %>
                    <% with $HoldsRationCard %>
                        <div class="large-6 columns">
                            <label>Ration card holder</label>
                             $Field 
                        </div>
                    <% end_with %>
                    </div>
                    <div class="row">
                    <% with $CardType %>
                        <div class="large-6 columns">
                            <label for="$ID">$Title</label> $Field
                        </div>
                    <% end_with %>
                    <% with $Type %>                        
                        <div class="large-6 columns">
                            <label for="$ID">$Title</label> $Field
                        </div>
                    <% end_with %>
					</div>
                <% end_with %>
                
				</div>
                <% if $Actions %>
                    <div class="Actions">
                        <% loop $Actions %>
                            <div class="large-2 columns">
                                $addExtraClass('button')
                            </div>
                        <% end_loop %>
                    </div>
                <% end_if %>

            </div>
        </fieldset>
    <% if $IncludeFormTag %>
        </form>
    <% end_if %>

