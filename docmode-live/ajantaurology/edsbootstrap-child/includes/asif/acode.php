<?php
/**
 * @param $formName string
 * @param $fieldName string
 * @param $fieldValue string
 * @return bool
 */
function is_already_submitted($formName, $fieldName, $fieldValue) {
    require_once(ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php');
    $exp = new CFDBFormIterator();
    $atts = array();
    $atts['show'] = $fieldName;
    $atts['filter'] = "$fieldName=$fieldValue";
    $atts['unbuffered'] = 'true';
    $exp->export($formName, $atts);
    $found = false;
    while ($row = $exp->nextRow()) {
        $found = true;
    }
    return $found;
}

/**
 * @param $result WPCF7_Validation
 * @param $tag array
 * @return WPCF7_Validation
 */
function my_validate_email($result, $tag) {
    $formName = 'Scientific Survey'; // Change to name of the form containing this field
    $fieldName = 'your-email'; // Change to your form's unique field name
    $errorMessage = 'Survey has already been submitted'; // Change to your error message
    $name = $tag['name'];
    if ($name == $fieldName) {
        if (is_already_submitted($formName, $fieldName, $_POST[$name])) {
            $result->invalidate($tag, $errorMessage);
        }
    }
    return $result;
}

// use the next line if your field is a **required email** field on your form
add_filter('wpcf7_validate_email*', 'my_validate_email', 10, 2);
// use the next line if your field is an **email** field not required on your form
add_filter('wpcf7_validate_email', 'my_validate_email', 10, 2);

// use the next line if your field is a **required text** field
add_filter('wpcf7_validate_text*', 'my_validate_email', 10, 2);
// use the next line if your field is a **text** field field not required on your form 
add_filter('wpcf7_validate_text', 'my_validate_email', 10, 2);