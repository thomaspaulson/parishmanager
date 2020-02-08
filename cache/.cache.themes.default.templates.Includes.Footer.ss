<?php
$val .= '<footer class="footer">
    <div class="row">
        <div class="large-12 columns">
            Copyrights  ';

$val .= $scope->locally()->obj('Now', null, true)->XML_val('format', array('Y'), true);
$val .= ' &copy;  Diocese of Cochin
            <!--<br>Developed by <a href="' . (\Config::inst()->get('SSViewer', 'rewrite_hash_links')
	? \Convert::raw2att( preg_replace("/^(\\/)+/", "/", $_SERVER['REQUEST_URI'] ) )
	: "") . '#">thomas</a> -->
        </div>
    </div>
</footer>
';

