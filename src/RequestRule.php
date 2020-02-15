<?php

namespace Bachilli\RequestRules;

use Illuminate\Foundation\Http\FormRequest;
use \Exception;

class RequestRule extends FormRequest
{
    protected $mainRules = [];

    protected $otherRules = [];

    protected $excludedList = [];

    protected $mergedRules = [];

    public function __construct()
    {
        $this->mainRules = $this->rules();
        $this->get();
    }

    protected function isInExcludedList($excluded)
    {

    }

    public function merge(RequestRule $requestClass, string $fieldName, ?string $fieldValidations = null) : void
    {
        $this->otherRules = array_push(
            $this->otherRules,
            [
                $requestClass,
                $fieldName,
                $fieldValidations
            ]);
    }

    public function get() : array
    {
        foreach ($this->otherRules as $otherRule) {
            foreach ($otherRule[0]->rules() as $ruleField => $ruleValidations) {
                $this->rules["{$otherRule[1]}.$ruleField"] = $ruleValidations;

                if (strpos($otherRule[1], '*') !== false && $otherRule[2]) {
                    $rules[str_replace('.*', '', $otherRule[1])] = $otherRule[2];
                }
            }
        }

        return $this->mainRules = $rules;
    }

    public function only(array $only) : void
    {
        foreach ($only as $item) {
            foreach ($this->rules() as $ruleField => $ruleValidation) {
                if ($item instanceof FormRequest && !$ruleField instanceof $item) {
                    array_push($this->excludedList, $ruleField);
                }

                if (!$item instanceof FormRequest && $item != $ruleField) {
                    array_push($this->excludedList, $ruleField);
                }
            }
        }
    }

    public function except(array $except)
    {
        foreach ($except as $item) {
            foreach ($this->rules() as $ruleField => $ruleValidation) {
                if ($item instanceof FormRequest && $ruleField instanceof $item) {
                    array_push($this->excludedList, $ruleField);
                }

                if (!$item instanceof FormRequest && $item === $ruleField) {
                    array_push($this->excludedList, $ruleField);
                }
            }
        }
    }
}
