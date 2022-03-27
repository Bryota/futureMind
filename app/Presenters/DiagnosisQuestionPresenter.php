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
                $diagnosis_type =  '安定';
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

    /**
     * get dignosis text type
     * 
     * @return string
     */
    public function diagnosisTextType(): string
    {
        $diagnosis_type = '';
        switch ($this->object->diagnosis_type) {
            case 0:
                $diagnosis_type =  '成長意欲';
                break;
            case 1:
                $diagnosis_type =  '社会貢献';
                break;
            case 2:
                $diagnosis_type =  '安定';
                break;
            case 3:
                $diagnosis_type =  '仲間';
                break;
            case 4:
                $diagnosis_type =  '将来';
                break;
            default:
                $diagnosis_type =  '';
        }
        return $diagnosis_type;
    }
}
