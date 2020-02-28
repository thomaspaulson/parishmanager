
    <% if $IncludeFormTag %>
        <form $AttributesHTML>
    <% end_if %>
        <fieldset>
            <% if $Legend %><legend>$Legend</legend><% end_if %>

            <div class="grid-x grid-padding-x">
				<div class="large-10 cell">
                <% with $FieldMap %>
                        <div class="grid-x grid-padding-x">
                        <% with $HoldsLand %>
                            <div class="large-6 cell">
                                <label>Land Holder</label>
                                $Field 
                            </div>
                        <% end_with %>

                        <% with $Area %>
                            <div class="large-6 cell">
                                <label for="$ID">$Title</label> $Field
                            </div>
                        <% end_with %>

                        </div>
                <% end_with %>
                </div>                


                <% if $Actions %>                    
                    <% loop $Actions %>
                        <div class="large-2 cell ">
                            <div class="Actions">  
                                <label>&nbsp;</label>                          
                                $addExtraClass('button')
                            </div>
                        </div>
                    <% end_loop %>
                    
                <% end_if %>

            </div>


        </fieldset>
    <% if $IncludeFormTag %>
        </form>
    <% end_if %>

