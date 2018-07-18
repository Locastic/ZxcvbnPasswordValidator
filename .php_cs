<?php

return PhpCsFixer\Config::create()
    ->setRules(array(
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unreachable_default_argument_value' => false,
        'braces' => ['allow_single_line_closure' => true],
        'header_comment' => ['header' => $header],
        'heredoc_to_nowdoc' => false,
        'phpdoc_annotation_without_dot' => false,
        'yoda_style' => false
    ))
    ->setRiskyAllowed(true)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in([__DIR__.'/src', __DIR__.'/tests'])
    )
;

