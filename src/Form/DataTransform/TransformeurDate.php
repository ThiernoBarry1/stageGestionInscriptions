<?php
namespace App\Form\DataTransform;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TransformeurDate implements DataTransformerInterface{

    public function transform($date)
    {
      if($date === null){
        return '';
      }
      return $date->format('d/m/Y');
    }
    public function reverseTransform($frenchDate)
    {
       if($frenchDate === null)
       {
          throw new TransformationFailedException('le transformateur attend une date ');
       }
       $date = \Datetime::createFromFormat('d/m/Y',$frenchDate);
       if($date == false)
       {
        throw new TransformationFailedException('le format de la date n\'est pas bon');
       }
       return $date;
    }

}