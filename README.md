# ZxcvbnPasswordValidator
Realistic Symfony password strength validator based on Dropbox's zxcvbn project. 


<h1 align="center">
    <a href="https://packagist.org/packages/locastic/zxcvbn-password-validator" title="License" target="_blank">
        <img src="https://img.shields.io/packagist/l/locastic/zxcvbn-password-validator.svg" />
    </a>
    <a href="https://packagist.org/packages/locastic/zxcvbn-password-validator" title="Version" target="_blank">
        <img src="https://img.shields.io/packagist/v/Locastic/zxcvbn-password-validator.svg" />
    </a>
    <a href="https://travis-ci.org/Locastic/ZxcvbnPasswordValidator" title="Build status" target="_blank">
        <img src="https://img.shields.io/travis/Locastic/ZxcvbnPasswordValidator/master.svg" />
    </a>
    <a href="https://scrutinizer-ci.com/g/Locastic/ZxcvbnPasswordValidator/" title="Scrutinizer" target="_blank">
        <img src="https://img.shields.io/scrutinizer/g/Locastic/ZxcvbnPasswordValidator.svg" />
    </a>
    <a href="https://packagist.org/packages/locastic/zxcvbn-password-validator" title="Total Downloads" target="_blank">
        <img src="https://poser.pugx.org/locastic/zxcvbn-password-validator/downloads" />
    </a>
</h1>

## Overview

Zxcvbn-PHP is a password strength estimator using pattern matching and minimum entropy calculation. 
Zxcvbn-PHP is based on the Javascript zxcvbn project from Dropbox and @lowe. "zxcvbn" is bad password, just like 
"qwerty" and "123456".

More info [here](https://blogs.dropbox.com/tech/2012/04/zxcvbn-realistic-password-strength-estimation/).

>zxcvbn attempts to give sound password advice through pattern matching and conservative entropy calculations. 
It finds 10k common passwords, common American names and surnames, common English words, and common patterns like dates, 
repeats (aaa), sequences (abcd), and QWERTY patterns.

This validator is based on library: [Zxcvbn-PHP](https://github.com/bjeavons/zxcvbn-php) 


## Installation
 
 ```
 composer require locastic/zxcvbn-password-validator
 ```
 
 ## Options
 
 You can use the `Locastic\Component\ZxcvbnPasswordValidator\Validator\Constraints\ZxcvbnPasswordValidator`
 constraint with the following options.
 
 |     Option      |   Type   |                                       Description                                       |
 | --------------- | -------- | --------------------------------------------------------------------------------------- |
 | message         | `string` | The validation message (default: `password_too_weak`)                                   |
 | minEntropy      | `float`  | Desired minimal entropy value (password strength                                        |
 
 ## Annotations
 
 If you are using annotations for validation, include the constraints namespace:
 
 ```php
 use Locastic\Component\ZxcvbnPasswordValidator\Validator\Constraints as LocasticPassword;
 ```
 
 and then add the ZxcvbnPasswordValidator constraint to the relevant field:
 
 ```php
 /**
  * @LocasticPassword\ZxcvbnPasswordValidator(minEntropy=50)
  */
 protected $password;
 ```
 
 ## YAML
  ```yaml
  App\Entity\User:
      properties:
          password:
              - Locastic\Component\ZxcvbnPasswordValidator\Validator\Constraints\ZxcvbnPasswordValidator:
                   minEntropy: 50
   ```
  
  ## Support
  
  Need help at your project? Write us an email on info@locastic.com
 
