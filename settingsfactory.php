<?php

include('renderelements.php');

$allUserMeta = array();
$allBlogMeta = array();
$allMetaBoxes = array();


/**
 * Register meta field -- if no $selectionType set, defaults to text field
 * @param  string   $displayName    Name of field shown to user
 * @param  string   $fieldName      field name for database
 * @param  string   $whoFor         either 'user', or 'blog'
 * @param  integer  $groupId        categorize entries into groups
 * @param  array    $optionsArray   array of options if selection type is not null
 * @param  string   $selectionType  Must be 'dropdown', 'radio', 'checkboxes'; if left blank, defaults to text field
 * @return void
 */
function registerMeta($displayName, $fieldName, $whoFor, $groupId = 1, $optionsArray = null, $selectionType = null) {
    global $allUserMeta;
    global $allBlogMeta;
    if ($whoFor == 'user') {
        array_push($allUserMeta, array($displayName, $fieldName, $groupId, $optionsArray, $selectionType));
    } elseif ($whoFor == 'blog') {
        array_push($allBlogMeta, array($displayName, $fieldName, $groupId, $optionsArray, $selectionType));
    }

}

// TODO -- maybe change the order so optional parameters come last

/**
 * Render These Settings
 * @param  string   $displayName    [description]
 * @param  string   $fieldName      [description]
 * @param  mixed    $dbValue        current value stored in a databse (string or array)
 * @param  array    $optionsArray   OPTIONAL -- array containing options for user
 * @param  string   $selectionType  can be 'dropdown', 'radio', or 'checkboxes'
 * @param  string   $whichMeta      can be 'user', 'blog'
 * @return void
 */
function renderTheseSettings($displayName, $fieldName, $dbValue, $optionsArray, $selectionType, $whichMeta){
    echo '<div class="form-group">';

        echo '<label class="control-label col-sm-3" for="name">'.$displayName.'</label>';

        echo '<div class="col-sm-9">';

        switch ($selectionType) {
            case null:
                echo '<input type="text"  class="form-control" name="'.$fieldName.'" value="'.$dbValue.'">';
                break;
            case 'dropdown':
                renderDropdown($optionsArray, $fieldName, $whichMeta);
                break;
            case 'radio':
                renderRadioButtons($optionsArray, $fieldName, $whichMeta);
                break;
            case 'checkboxes':
                renderCheckboxes($optionsArray, $fieldName, $whichMeta);
                break;
        }

        echo '</div>';

    echo '</div>';
}



/**
 * Render a particular group of settings
 *
 * Separates into groups
 * @param  string   $groupDisplayName   Group name to display
 * @param  string   $groupDivId         Div id for jQuery to grab (not needed yet)
 * @param  string   $groupNumber        Render out only user meta for this group number
 * @param  string   $whichMeta          Can be 'blog' or 'user'
 * @return void
 */
function displayMetaSettingsGroup($groupDisplayName, $groupDivId, $groupNumber, $whichMeta) {

    $theUserMeta = array();

    if ($whichMeta == 'blog') {
        global $allBlogMeta;
        global $blogSettings;
        $theUserMeta = $allBlogMeta;
        $metaSettings = $blogSettings;
    } elseif ($whichMeta == 'user'){
        global $allUserMeta;
        global $userSettings;
        $theUserMeta = $allUserMeta;
        $metaSettings = $userSettings;
    }

    metaboxPrefix($groupDisplayName, $groupDivId);


    // cycle through all the registered meta
    foreach ($theUserMeta as $key => $value) {
        if ($value[2] == $groupNumber) {
            if (isset($metaSettings[$value[1]])){
                renderTheseSettings($value[0], $value[1], $metaSettings[$value[1]], $value[3], $value[4], $whichMeta);
            } else {
                renderTheseSettings($value[0], $value[1], '', $value[3], $value[4], $whichMeta);
            }
        }
    }

    metaboxSuffix();

}


/**
 * CODE FOR METABOXES
 */

// Register meta boxes
// stores all that was registered into an array for later retrieval
function registerMetaBox($displayName, $uniqueId, $functionToCall, $order = 5) {
    global $allMetaBoxes;
    array_push($allMetaBoxes, array($displayName, $uniqueId, $functionToCall, $order));
}


// output metabox HTML
function displayAllMetaBoxes(){

    global $allMetaBoxes;

    // custom sort the metaboxes according to their order (4th element in array)
    function compareOrder($a, $b) {
        return $a['3'] - $b['3'];
    }
    usort($allMetaBoxes, 'compareOrder');

    foreach ($allMetaBoxes as $key => $value) {
        metaboxPrefix($allMetaBoxes[$key][0],$allMetaBoxes[$key][1]);
        // execute the function registered with its metabox
        $allMetaBoxes[$key][2]($allMetaBoxes[$key][1]);
        metaboxSuffix();
    }

}

// metabox top HTML
function metaboxPrefix($displayName, $uniqueId) {
    echo '<div class="panel panel-default" id="' . $uniqueId . '">';
    //echo '<label for="' . $uniqueId . '">' . $displayName. '</label><br>';
    echo '<div class="panel-heading">' . $displayName;
    // toggle icon div
    //echo '<div class="pull-right"><a href="#'. $uniqueId .'Panel" data-toggle="collapse" class="text-right btn btn-xs">&#x25BE;</a></div>';

    echo '<div class="pull-right"><span class="arrow-toggle" data-toggle="collapse" data-target="#'. $uniqueId .'Panel" id="collapseP"><span class="icon-arrow-down"><btn class="btn btn-default btn-circle">&uarr;</button></span><span class="icon-arrow-up"><btn class="btn btn-default btn-circle">&darr;</button></span></span></div>';

    echo '</div>';
    echo '<div id="'.$uniqueId.'Panel" class="panel-collapse collapse in">';
    echo '<div class="panel-body">';
}

// metabox bottom HTML
function metaboxSuffix() {
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

?>
