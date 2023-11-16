<?php

namespace App\Service;

use Cocur\Slugify\Slugify as cocurSlugify;

class Slugify {

    //-- function de slugify"
    public function slugify($stringToSlugify){

        $slugify = new CocurSlugify();
        return $slugify->slugify($stringToSlugify);

    }


}