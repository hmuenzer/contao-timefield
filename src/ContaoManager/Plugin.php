<?php

namespace Hmuenzer\TimeFieldBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Hmuenzer\TimeFieldBundle\HmuenzerTimeFieldBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(HmuenzerTimeFieldBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
