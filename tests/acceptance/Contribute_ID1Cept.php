<?php
// I HAVE COMMENTED THIS DO NOT PORT ON ALL THE LINES I DO NOT EXPECT TO BE RE-USABLE ON THE NEW FORMS
/**
 * @group Contribution
 */
$scenario->group('donate');

$I = new AcceptanceTester($scenario);
$I->wantTo('make a $1 "Friend" donation on contribution page 3');
// DO NOT PORT - URL WILL CHANGE
$I->amOnPage('/civicrm/contribute/transact?reset=1&id=1&action=preview');

// Check the page content is expected.
$I->see('Test-drive Your Contribution Page');
$I->see('Do you love CiviCRM? Do you use CiviCRM? Then please support CiviCRM');

// Set up some values which we'll check for later.
// This probably wants to be moved to helpers for making CiviCRM contact details.
$my_first_name = substr(basename(__FILE__), 0, -4);
$my_last_name = 'Test';
$my_email = 'test.' . time() . '@example.org';
$my_login = 'test.' . time();
$my_password = '1234';
$my_phone = time();
$my_postcode = '0900';
$my_street_address = '123 Test Street';
$my_city = 'Testville';
// $my_state = '1000'; // Alabama
$my_creditcard = '5123456789012346';
$my_cvv = 123;
$my_exp_mm = 11;
$my_exp_yyyy = date('Y') + 2;

// Field labels are currently wriggling with QuickForm IDs.
// To make tests work before and after Big Swap, we're going
// to need to add sane selectors beforehand.
//
// IMO this is defined as:
// - Don't expose DB IDs (eg email-5, city-1, country/state IDs)
// - Use .classes not #ids (don't assume CiviCRM is only form on page)
// - ... add your rules here?
// DO NOT PORT - LETS NOT RECREATE THIS CLUMSINESS IN THE BRAVE NEW WORLD. IF POSSIBLE WE SHOULD FOLLOW schema.org
$I->fillField('#email-5', $my_email);

// CMS / login details
//$I->fillField('#cms_name', $my_login);
//$I->fillField('#cms_pass', $my_password);
//$I->fillField('#cms_confirm_pass', $my_password);

// Contact details
//$I->fillField('#first_name', $my_first_name);
//$I->fillField('#last_name', $my_last_name);
//$I->fillField('#phone-1-1', $my_phone);
//$I->fillField('#postal_code-1', $my_postcode);

// Complete CC fields
$I->fillField(['name' => 'credit_card_number'], $my_creditcard);
// DO NOT PORT - LETS NOT RECREATE THIS CLUMSINESS IN THE BRAVE NEW WORLD
$I->selectOption(['name' => 'credit_card_exp_date[M]'], $my_exp_mm);
// DO NOT PORT - LETS NOT RECREATE THIS CLUMSINESS IN THE BRAVE NEW WORLD
$I->selectOption(['name' => 'credit_card_exp_date[Y]'], $my_exp_yyyy);
$I->fillField(['name' => 'cvv2'], $my_cvv);

// Contact details
$I->fillField('#billing_first_name', $my_first_name);
$I->fillField('#billing_last_name', $my_last_name);
// DO NOT PORT - LETS NOT RECREATE THIS CLUMSINESS IN THE BRAVE NEW WORLD
$I->fillField('#billing_street_address-5', $my_street_address);
// DO NOT PORT - LETS NOT RECREATE THIS CLUMSINESS IN THE BRAVE NEW WORLD
$I->fillField('#billing_city-5', $my_city);
// DO NOT PORT - LETS NOT RECREATE THIS CLUMSINESS IN THE BRAVE NEW WORLD
$I->fillField('#billing_postal_code-5', $my_postcode);
// Click visible Select2 element instead of using <select> tag.
// DO NOT PORT - LETS NOT RECREATE THIS CLUMSINESS IN THE BRAVE NEW WORLD
$I->click('.billing_state_province_id-5-section .select2-container a');
// $I->wait(40
// DO NOT PORT - LETS NOT RECREATE THIS CLUMSINESS IN THE BRAVE NEW WORLD
$I->click('#select2-result-label-58');
// $I->selectOption('#billing_state_province_id-5', '1000');

// Click the button (by ID) to submit form.
// DO NOT PORT - NOT RELEVANT TO NEW FORM STRUCTURE
$I->click('#_qf_Main_upload-bottom');

// Don't forget to test your validation here.
//
// You can add tests which intentionally fail validation,
// then resubmit with the failed values corrected. This
// checks your validation works, and that your forms don't
// break / set unexpected defaults when users resubmit.

// Check expected information on screen.
$I->see('Please verify the information below carefully.');

// Check the expected item is selected.
$I->see('Total Amount: $ 10.00 - Booster');

// Check the user gets to confirm their details.
$I->see($my_first_name . ' ' . $my_last_name);
$I->see($my_email);

// Confirm payment
// DO NOT PORT - NOT RELEVANT TO NEW FORM STRUCTURE
$I->click('#_qf_Confirm_next-top');

// DO NOT PORT - THIS IS PART OF THE MULTIPAGE STRUCTURE AND WILL BE SUBSTANTIVELY CHANGED
$I->see('Your transaction has been processed successfully.');
// DO NOT PORT - THIS IS PART OF THE MULTIPAGE STRUCTURE AND WILL BE SUBSTANTIVELY CHANGED
$I->see('Thank you for your support. Your contribution will help us build even better tools.');
