<?php

namespace App\Macros;

/**
 *
 */
class SearchMacros
{
    public function search()
    {
      return function($attribute, $searchTerm){
        return $this->where($attribute,  'LIKE', "%{$searchTerm}%");
      };
    }
}
