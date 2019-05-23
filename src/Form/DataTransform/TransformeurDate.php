<?php
namespace App\Form\DataTransform;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TransformeurDate implements DataTransformerInterface{
   /**
    * permet de transformer une date au format français.
    *
    * @param Date $date
    * @return Date
    */
    public function transform($date)
    {
      if($date === null){
        return '';
      }
      return $date->format('d/m/Y');
    }
    /**
     * transform une date au format dateTime
     *
     * @param Date $frenchDate
     * @return Date
     */
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