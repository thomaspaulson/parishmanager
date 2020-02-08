<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 10:35 AM
 */

class MyLeftAndMainExtension extends LeftAndMainExtension {

    function onAfterInit() {
        CMSMenu::remove_menu_item('Help');
    }

}