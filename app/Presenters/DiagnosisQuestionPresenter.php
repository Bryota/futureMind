<?php

namespace App\Presenters;

use Robbo\Presenter\Presenter;

class DiagnosisQuestionPresenter extends Presenter
{
    /**
     * get dignosis data type
     * 
     * @return string
     */
    public function diagnosisDataType(): string
    {
        $diagnosis_type = '';
        switch ($this->object->diagnosis_type) {
            case 0:
                $diagnosis_type =  'developmentvalue';
                break;
            case 1:
                $diagnosis_type =  'socialvalue';
                break;
            case 2:
                $diagnosis_type =  'stablevalue';
                break;
            case 3:
                $diagnosis_type =  'teammatevalue';
                break;
            case 4:
                $diagnosis_type =  'futurevalue';
                break;
            default:
                $diagnosis_type =  '';
        }
        return $diagnosis_type;
    }
}
