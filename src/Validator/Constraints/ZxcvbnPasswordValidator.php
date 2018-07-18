<?php

namespace Locastic\Component\ZxcvbnPasswordValidator\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use ZxcvbnPhp\Zxcvbn;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Password strength Validation.
 * More info: https://blogs.dropbox.com/tech/2012/04/zxcvbn-realistic-password-strength-estimation/
 */
class ZxcvbnPasswordValidator extends ConstraintValidator
{

    private $translator;

    public function __construct(TranslatorInterface $translator = null)
    {
        // If translator is missing create a new translator.
        // With the 'en' locale and 'validators' domain.
        if (null === $translator) {
            $translator = new Translator('en');
            $translator->addLoader('xlf', new XliffFileLoader());
            $translator->addResource(
                'xlf',
                dirname(dirname(__DIR__)).'/Resources/translations/validators.en.xlf',
                'en',
                'validators'
            );
        }

        $this->translator = $translator;
    }

    public function validate($password, Constraint $constraint)
    {
        if (null === $password || '' === $password) {
            return;
        }

        if (!is_scalar($password) && !(is_object($password) && method_exists($password, '__toString'))) {
            throw new UnexpectedTypeException($password, 'string');
        }

        $zxcvbn = new Zxcvbn();
        $strength = $zxcvbn->passwordStrength($password);

        if ($strength['entropy'] < $constraint->minEntropy) {
            $parameters = [
                '{{ min_entropy }}' => $constraint->minEntropy,
                '{{ current_entropy }}' => $strength['entropy'],
            ];

            $this->context->buildViolation($constraint->message)
                ->setParameters($parameters)
                ->addViolation();
        }
    }
}