<?php

namespace Bachilli\RequestRules;

class RequestRule
{
    public function resolveRules(array $mainRules, array $otherRules) : array
    {
        $rules = [];

        foreach ($otherRules as $otherRule) {

            $rules = array_merge($rules, $otherRule->get());
        }

        foreach($mainRules as $label => $mainRule) {

            if($mainRule instanceof RuleEntity){
                $rules = array_merge($rules,$mainRule->get());
                continue;
            }

            $rules = array_merge($rules,[$label => $mainRule]);
        }

        return $rules;
    }

    public function merge($requestClass, string $fieldName, ?string $validations = null) : RuleEntity
    {
        return new RuleEntity(new $requestClass, $fieldName, $validations);
    }
}
