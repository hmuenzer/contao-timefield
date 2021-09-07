<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @package timefield
 * @link    https://github.com/hmuenzer/contao-timefield
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Hmuenzer\TimeField;

use Contao\FormTextField;

class FormTimeField extends FormTextField
{

  /**
   * Template
   *
   * @var string
   */
  protected $strTemplate = 'form_timefield';

  /**
   * The CSS class prefix
   *
   * @var string
   */
  protected $strPrefix = 'widget widget-text widget-time';

  /**
   * Parse the template file and return it as string
   *
   * @param array $arrAttributes An optional attributes array
   *
   * @return string The template markup
   */

  public function parse($arrAttributes=null)
  {
    // do not add in back end
    if (TL_MODE == 'BE')
    {
      return parent::parse($arrAttributes);
    }

    $GLOBALS['TL_CSS'][] = 'bundles/hmuenzertimefield/assets/jquery.timepicker.min.css';
    $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/hmuenzertimefield/assets/jquery.timepicker.min.js';

    // Initialize the default config
    $arrConfig = array(
      'timeFormat'        => "H:i",
    );

    if ($this->minTime) {
      $arrConfig['minTime'] = \Date::parse("H:i", $this->minTime);
    }

    if ($this->maxTime) {
      $arrConfig['maxTime'] = \Date::parse("H:i", $this->maxTime);
    }

    if ($this->timeStep) {
      $arrConfig['step'] = $this->timeStep;
    }

    // HOOK: allow to customize the timepicker
    if (isset($GLOBALS['TL_HOOKS']['formTimeField']) && is_array($GLOBALS['TL_HOOKS']['formTimeField'])) {
      foreach ($GLOBALS['TL_HOOKS']['formTimeField'] as $callback) {
        $objCallback = (method_exists($callback[0], 'getInstance') ? call_user_func(array($callback[0], 'getInstance')) : new $callback[0]());
        $arrConfig = $objCallback->{$callback[1]}($arrConfig, $this);
      }
    }

    $strConfig = json_encode($arrConfig);

    $timefieldScript = <<<JS
<script>
jQuery(function($) {
  $("#ctrl_%s").timepicker(%s);
});
</script>
JS;

    $GLOBALS['TL_BODY'][] = sprintf($timefieldScript, $this->strId, $strConfig, $this->strId, $GLOBALS['objPage']->language);

    return parent::parse($arrAttributes);
  }

  public function validator($varInput)
  {
    $this->rgxp = 'time';
    $varInput = parent::validator($varInput);

    if ($varInput != '') {
      $inputTime = strtotime($varInput, 0);
      if ($this->minTime and $this->minTime > $inputTime) {
        $this->addError(sprintf($GLOBALS['TL_LANG']['ERR']['timefield_min'], \Date::parse("H:i", $this->minTime)));
      }
      if ($this->maxTime and $this->maxTime < $inputTime) {
        $this->addError(sprintf($GLOBALS['TL_LANG']['ERR']['timefield_max'], \Date::parse("H:i", $this->maxTime)));
      }
    }

    return $varInput;
  }

}
