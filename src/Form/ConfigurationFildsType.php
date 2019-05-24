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
     * return le tableau de choix
     *
     * @param [Array] $array
     * @param boolean $isMultiple
     * @param boolean $isExpanded
     * @return Array
     */
    protected function getArrayChoice($array,$isMultiple=false,$isExpanded=true,$isRequired=true)
    {
     return [ 'choices'  => $array,
              'expanded' => $isExpanded,
              'multiple'=>  $isMultiple,
              'required'=> $isRequired,
           ]; 
    }
    
}