# Testing CiviCRM with Codeception

Sharing some examples (just one, for starters) of testing CiviCRM with Codeception.

## Things we might test

* Make a donation
* Make a donation with an added gift
* Join as a member
* Log in as demo user and check that membership was created
* Join as a member, have a Drupal user a/c created and check we're logged in
* Make a donation, add a gift amount, but don't enter a valid email address. When validation fails, check we didn't lose the additional gift.

## Other things to demo here

* Testing a site which is behind a basic auth prompt
* Using Cest and Cept tests
* Helpers
