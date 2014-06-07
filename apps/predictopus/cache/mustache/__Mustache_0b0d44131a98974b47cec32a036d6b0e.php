<?php

class __Mustache_0b0d44131a98974b47cec32a036d6b0e extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $value = $this->resolveValue($context->find('A'), $context, $indent);
        $buffer .= $indent . htmlspecialchars($value, 2, 'UTF-8');

        return $buffer;
    }
}
