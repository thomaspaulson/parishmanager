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

                    <div class="grid-x grid-padding-x">
                        <% loop $Fields %>
                        <div class="large-5 cell">
                            $FieldHolder
                        </div>
                        <% end_loop %>


                    <% if $Actions %>                        
                            <% loop $Actions %>
                                <div class="large-2 cell">
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
