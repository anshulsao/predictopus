<?php

class __Mustache_078d466acb90c6e6201ad0363ad0e73b extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '
';
        $buffer .= $indent . '<div class="container" class="logo">
';
        $buffer .= $indent . '    <a href="/"><img src="/assets/img/logo.png">
';
        $buffer .= $indent . '        <span>Predictopus</span></a>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }
}
