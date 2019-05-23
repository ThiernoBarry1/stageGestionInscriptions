<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ConfigurationFildsType extends AbstractType {
    /**
     * permet de configurer un champs.
     *      
     * @param [String] $label
     * @param [String] $placeholder
     * @param array $option
     * @return Array
     */
    
    protected function getConfiguration()
    {
      return ['required'=>false];
    }
    /**
    * Permet de remplir un tableau de nombres
    *@return Array
    */
    protected function getArrayDuration($debut,$fin)
    {
        $arrayDate = [$debut=>true];
        for($i= $debut+1 ;$i <= $fin;  $i++) {
          $arrayDate[] = false;
        }
        return $arrayDate;
    }
    /**
     * return le tableau de choix
     *
     * @param [Array] $array
     * @param boolean $isMultiple
     * @param boolean $isExpanded
     * @return Array
     */
    protected function getArrayChoice($array,$isMultiple=false,$isExpanded=true,$isRequired=false)
    {
     return [ 'choices'  => $array,
              'expanded' => $isExpanded,
              'multiple'=>  $isMultiple,
              'required'=> $isRequired,
           ]; 
    }
    
}