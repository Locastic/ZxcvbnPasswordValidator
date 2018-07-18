<?php

namespace Locastic\Component\ZxcvbnPasswordValidator\Tests\Validator;

use Locastic\Component\ZxcvbnPasswordValidator\Validator\Constraints\ZxcvbnPassword;
use Locastic\Component\ZxcvbnPasswordValidator\Validator\Constraints\ZxcvbnPasswordValidator;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class ZxcvbnPasswordValidatorTest extends ConstraintValidatorTestCase
{

    public function testNullIsValid()
    {
        $this->validator->validate(null, new ZxcvbnPassword(['minEntropy' => 70]));

        $this->assertNoViolation();
    }

    public function testEmptyIsValid()
    {
        $this->validator->validate('', new ZxcvbnPassword(['minEntropy' => 70]));

        $this->assertNoViolation();
    }
    /**
     * @expectedException \Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new ZxcvbnPassword(['minEntropy' => 70]));
    }


    public function testWeakPasswordsWillNotPass()
    {
        $constraint = new ZxcvbnPassword(['minEntropy' => 70]);
        $this->validator->validate('password', $constraint);

        $parameters = [
            '{{ min_entropy }}' => 70,
            '{{ current_entropy }}' => 0.0,
        ];

        $this->buildViolation('password_too_weak')
            ->setParameters($parameters)
            ->assertRaised();
    }

    public function testStrongPasswordsWillPass()
    {
        $constraint = new ZxcvbnPassword(['minEntropy' => 70]);
        $this->validator->validate('Ca@ see alpha Lorem Ipsum danlsdla', $constraint);

        $this->assertNoViolation();
    }

    protected function createValidator()
    {
        return new ZxcvbnPasswordValidator(new Translator('en'));
    }
}