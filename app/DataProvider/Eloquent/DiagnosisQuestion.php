<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\DiagnosisQuestionPresenter;
use Robbo\Presenter\PresentableInterface;

class DiagnosisQuestion extends Model implements PresentableInterface
{
    /**
     * get dignosis data type
     * 
     * @return \App\Presenters\DiagnosisQuestionPresenter;
     */
    public function getPresenter()
    {
        return new DiagnosisQuestionPresenter($this);
    }
}
