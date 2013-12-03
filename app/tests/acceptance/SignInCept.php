<?php

$I = new WebGuy($scenario);

$I->amOnPage('/teardown_tests');
$I->amOnPage('/prepare_tests');

$I->wantTo('Check I cant access dashboard');
$I->amOnPage('/dashboard');
$I->see('You need to be signed in to go to the dashboard');

$I->wantTo('Register an account');
$I->amOnPage('/user/create');
$I->see('Create account','h3');

$f_email   = '.create_user #email';
$f_password = '.create_user #password';
$f_passwordconf = '.create_user #password_confirmation';

$I->wantTo('See validation errors for bad password');
$I->fillField($f_email,'rrrhys+mrtest@gmail.com');
$I->fillField($f_password,'a');
$I->fillField($f_passwordconf,'b');
$I->click('Register');
$I->see('The password must be at least 8 characters');

$I->wantTo('See validation errors for bad email');
$I->fillField($f_email,'rrrhys@com');
$I->fillField($f_password,'aaaaaaaa');
$I->fillField($f_passwordconf,'aaaaaaaa');
$I->click('Register');
$I->see('The email format is invalid');

$I->wantTo('See validation errors for mismatched password');
$I->fillField($f_email,'rrrhys+unique@gmail.com');
$I->fillField($f_password,'aaaaaaaa');
$I->fillField($f_passwordconf,'aaaaaaab');
$I->click('Register');
$I->see('The password confirmation does not match');

$password= substr(md5(rand()),0,10);

$I->wantTo('Really register now.');
$I->fillField($f_email,'rrrhys+tester@gmail.com');
$I->fillField($f_password,"IAmATester");
$I->fillField($f_passwordconf,"IAmATester");
$I->click('Register');

$I->see('Account created successfully!');

