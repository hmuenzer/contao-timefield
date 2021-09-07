<?php

namespace Hmuenzer\TimeField\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Hmuenzer\TimeField\TimeFieldBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(TimeFieldBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
