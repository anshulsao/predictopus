<?php

class __Mustache_5ca1b0fe41f24c2b069f166dd9b50997 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class=\'\'>
';
        $buffer .= $indent . '    <ul>
';
        // 'fixtures' section
        $value = $context->find('fixtures');
        $buffer .= $this->sectionB12a95f52872c7857fd2a322240928f8($context, $indent, $value);
        $buffer .= $indent . '    </ul>
';
        $buffer .= $indent . '</div>';

        return $buffer;
    }

    private function sectionA7f77e05df6da6db2912c5251990be58(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <li>
                    <div>{{{team1Name}}} ({{team1Code}})</div>
                    <div>{{{team2Name}}} ({{team2Code}})</div>
                    <div>{{timeDisp}} - {{{groundFullTitle}}} - {{groundCapacity}}</div>
                </li>
                ';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                $buffer .= $indent . '                <li>
';
                $buffer .= $indent . '                    <div>';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= ' (';
                $value = $this->resolveValue($context->find('team1Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ')</div>
';
                $buffer .= $indent . '                    <div>';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= ' (';
                $value = $this->resolveValue($context->find('team2Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ')</div>
';
                $buffer .= $indent . '                    <div>';
                $value = $this->resolveValue($context->find('timeDisp'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ' - ';
                $value = $this->resolveValue($context->find('groundFullTitle'), $context, $indent);
                $buffer .= $value;
                $buffer .= ' - ';
                $value = $this->resolveValue($context->find('groundCapacity'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</div>
';
                $buffer .= $indent . '                </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB12a95f52872c7857fd2a322240928f8(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <li>
            <h4>{{title}}</h4>
            <ul>
                {{#games}}
                <li>
                    <div>{{{team1Name}}} ({{team1Code}})</div>
                    <div>{{{team2Name}}} ({{team2Code}})</div>
                    <div>{{timeDisp}} - {{{groundFullTitle}}} - {{groundCapacity}}</div>
                </li>
                {{/games}}
            </ul>
        
        </li>
        ';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                $buffer .= $indent . '        <li>
';
                $buffer .= $indent . '            <h4>';
                $value = $this->resolveValue($context->find('title'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</h4>
';
                $buffer .= $indent . '            <ul>
';
                // 'games' section
                $value = $context->find('games');
                $buffer .= $this->sectionA7f77e05df6da6db2912c5251990be58($context, $indent, $value);
                $buffer .= $indent . '            </ul>
';
                $buffer .= $indent . '        
';
                $buffer .= $indent . '        </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
