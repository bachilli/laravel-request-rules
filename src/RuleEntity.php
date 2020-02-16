<?php


namespace Bachilli\RequestRules;

use Illuminate\Foundation\Http\FormRequest;


class RuleEntity
{
    protected $rules = [];

    protected $excludeList = [];

    protected $fieldName = null;

    protected $validations = null;

    public function __construct(FormRequest $formRequest, $fieldName, $validations)
    {
        $this->rules = $formRequest->rules();
        $this->setFieldName($fieldName);
        $this->validations = $validations;
    }

    public function get()
    {
        $rules = [];

        foreach ($this->rules as $ruleField => $ruleValidations) {
            $rules["{$this->fieldName}.$ruleField"] = $ruleValidations;

            if ($this->validations) {
                $rules[$this->fieldName] = $this->validations;
            }
        }

        return $rules;
    }

    public function setFieldName(string $fieldName)
    {
        $this->fieldName = $fieldName;

        if (strpos($fieldName, '*') !== false) {
            $this->fieldName = str_replace('.*', '', $fieldName);
        }
    }

    public function only(array $only) : void
    {
        foreach ($only as $item) {
            foreach ($this->rules() as $ruleField => $ruleValidation) {
                if ($item instanceof FormRequest && !$ruleField instanceof $item) {
                    array_push($this->excludeList, $ruleField);
                }

                if (!$item instanceof FormRequest && $item != $ruleField) {
                    array_push($this->excludeList, $ruleField);
                }
            }
        }
    }

    public function except(array $except)
    {
        foreach ($except as $item) {
            foreach ($this->rules() as $ruleField => $ruleValidation) {
                if ($item instanceof FormRequest && $ruleField instanceof $item) {
                    array_push($this->excludeList, $ruleField);
                }

                if (!$item instanceof FormRequest && $item === $ruleField) {
                    array_push($this->excludeList, $ruleField);
                }
            }
        }
    }
}
