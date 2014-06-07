<?php

class __Mustache_c956ee5156cb533c230283502bf5cab7 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '
';
        $buffer .= $indent . '<div class="container logo" >
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
