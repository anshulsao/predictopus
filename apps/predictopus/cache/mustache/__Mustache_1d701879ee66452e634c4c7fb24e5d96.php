<?php

class __Mustache_1d701879ee66452e634c4c7fb24e5d96 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '
';
        $buffer .= $indent . '<div class="container">
';
        $buffer .= $indent . '    <a href="/"><img src="/assets/img/logo.png" class="logo">
';
        $buffer .= $indent . '        <span>Predictopus</span></a>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }
}
