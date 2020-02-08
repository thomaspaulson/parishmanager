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
                        <% loop $Fields %>
                        <div class="large-5 columns">
                            $FieldHolder
                        </div>
                        <% end_loop %>


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
