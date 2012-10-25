<?php

namespace Concurso\Menus4AllBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ConcursoMenus4AllBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
