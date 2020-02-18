<?php

namespace Bachilli\RequestRules;

use Illuminate\Foundation\Http\FormRequest;

class RequestRule
{
    public function resolveRules(array $mainRules, array $otherRules) : array
    {
        $rules = [];

        foreach ($otherRules as $otherRule) {
            $rules = array_merge($rules, $otherRule);
        }

        return array_merge($mainRules, $rules);
    }

    public function merge($requestClass, string $fieldName, ?string $validations = null) : RuleEntity
    {
        return new RuleEntity(new $requestClass, $fieldName, $validations);
    }
}
