<?php
switch ($modx->event->name) {
    case 'OnDocFormPrerender':
        $field = 'modx-snippet-snippet';
        $panel = '';
        break;
    case 'OnTempFormPrerender':
        $field = 'modx-template-content';
        $panel = 'modx-panel-template';
        break;
    case 'OnChunkFormPrerender':
        $field = 'modx-chunk-snippet';
        $panel = 'modx-panel-chunk';
        break;
    default:
        return;
}
if (!empty($field)) {
    $modx->controller->addLexiconTopic('core:chunk');
    $modx->controller->addLexiconTopic('core:snippet');
    $modx->controller->addLexiconTopic('tagelementplugin:default');
    $jsUrl = $modx->getOption('tagelementplugin_assets_url', null, $modx->getOption('assets_url') . 'components/tagelementplugin/').'js/mgr/';
    /** @var modManagerController */
    $modx->controller->addLastJavascript($jsUrl.'tagelementplugin.js');
    $modx->controller->addLastJavascript($jsUrl.'dialogs.js');
    $usingFenon = $modx->getOption('pdotools_fenom_parser',null,false) ? 'true' : 'false';
    $_html = "<script type=\"text/javascript\">\n";
    $_html .= "\tvar tagElPlugin_config = {\n";
    $_html .= "\t\tpanel : '{$panel}',\n" ;
    $_html .= "\t\tfield : '{$field}',\n" ;
    $_html .= "\t\tusing_fenom : {$usingFenon},\n" ;
    $_html .= "\t\teditor : '".$modx->getOption('which_element_editor')."',\n" ;
    $_html .= "\t\tconnector_url : '". $modx->getOption('tagelementplugin_assets_url', null, $modx->getOption('assets_url') . "components/tagelementplugin/")."connector.php'\n";
    $_html .= "\t};\n";
    $_html .= "</script>";
    $modx->controller->addHtml($_html);
}