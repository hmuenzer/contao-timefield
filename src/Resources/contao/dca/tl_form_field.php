<?php

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['timefield'] = '{type_legend},type,name,label;{fconfig_legend},mandatory,placeholder,minTime,maxTime,timeStep;{expert_legend:hide},class,value,accesskey,tabindex;{template_legend:hide},customTpl;{invisible_legend:hide},invisible';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form_field']['fields']['minTime'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['minTime'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp' => 'time', 'tl_class' => 'clr w50'),
	'explanation'             => 'minTime',
	'sql'                     => "smallint(6) DEFAULT NULL"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['maxTime'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['maxTime'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp' => 'time', 'tl_class'=>'clr w50'),
	'explanation'             => 'maxTime',
	'sql'                     => "smallint(6) DEFAULT NULL"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['timeStep'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['timeStep'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('5', '10', '15', '20', '30'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_form_field']['timeStep_ref'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(3) NOT NULL default '15'"
);
