<?php
$I = new WebGuy($scenario);

$I->wantTo('sign in now.');
$I->amOnPage('/');
$I->fillField('.signin #email','rrrhys+tester@gmail.com');
$I->fillField('.signin #password','IAmATester');
$I->click('.btn[value="Sign in"]');
$I->canSee('Login successful!');
$I->wantTo('load the widget');
$I->amOnPage('/dashboard');
$I->canSee('Widget Code:');

$api_url = $I->grabTextFrom('.widget_code');
$I->amOnPage($api_url);
$I->dontSee('Whoops');


$I->amOnPage('/teardown_tests');
