<?php

namespace Bachilli\RequestRules;

use Illuminate\Foundation\Http\FormRequest;

class RequestRule
{
    protected $otherRules = [];

    protected $excludedList = [];

    protected $mergedRules = [];

    public function resolveRules($mainRules, $otherRules)
    {
        $rules = $mainRules;

        foreach ($this->otherRules as $otherRule) {
            $ruleClass = new $otherRule[0];

            foreach ($ruleClass->rules() as $ruleField => $ruleValidations) {
                $rules["{$otherRule[1]}.$ruleField"] = $ruleValidations;

                if (strpos($otherRule[1], '*') !== false && $otherRule[2]) {
                    $rules[str_replace('.*', '', $otherRule[1])] = $otherRule[2];
                }
            }
        }

        return $rules;
    }

    public function merge($requestClass, ?string $fieldName, ?string $validations = null) : RuleEntity
    {
        return new RuleEntity($requestClass, $fieldName, $validations);
    }
}
