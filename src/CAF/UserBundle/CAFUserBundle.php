<?php

namespace CAF\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CAFUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
