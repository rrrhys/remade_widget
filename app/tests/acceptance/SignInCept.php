<?php

$I = new WebGuy($scenario);
$I->wantTo('Check I cant access dashboard');
$I->amOnPage('/dashboard');
$I->see('You need to be signed in to go to the dashboard');

$I->wantTo('Register an account');
$I->amOnPage('/user/create');
$I->see('Create account','h3');

$I->fillField('.create_user #email','rrrhys+mrtest@gmail.com');
$I->fillField('.create_user #password','a');
$I->fillField('.create_user #password_confirmation','b');
$I->click('Register');
$I->see('The password must be at least 8 characters');
