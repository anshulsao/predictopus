<?php

class __Mustache_6e5b069b847ac6690d7c7b0d08cea174 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '<div class=\'\'>
';
        $buffer .= $indent . '    <ul>
';
        $buffer .= $indent . '        <li>';
        $value = $this->resolveValue($context->find('title'), $context, $indent);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '</li>
';
        $buffer .= $indent . '    </ul>
';
        $buffer .= $indent . '</div>';

        return $buffer;
    }
}
