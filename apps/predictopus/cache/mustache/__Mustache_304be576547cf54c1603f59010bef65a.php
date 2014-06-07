<?php

class __Mustache_304be576547cf54c1603f59010bef65a extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '
';
        $buffer .= $indent . '<ul>
';
        // 'fixtures' section
        $value = $context->find('fixtures');
        $buffer .= $this->sectionB0c06e455bcc8014f265f28b7f95eb6e($context, $indent, $value);
        $buffer .= $indent . '</ul>';

        return $buffer;
    }

    private function section2ab5a339e0eb0b8fccc953178811dea0(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = ' to {{dispEndDate}} ';
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
                $buffer .= ' to ';
                $value = $this->resolveValue($context->find('dispEndDate'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ' ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDdf3dea694efcbcc35a51c5784750b9a(Mustache_Context $context, $indent, $value)
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
                $buffer .= $indent . '            <li>
';
                $buffer .= $indent . '                <div>';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= ' (';
                $value = $this->resolveValue($context->find('team1Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ')</div>
';
                $buffer .= $indent . '                <div>';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= ' (';
                $value = $this->resolveValue($context->find('team2Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ')</div>
';
                $buffer .= $indent . '                <div>';
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
                $buffer .= $indent . '            </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB0c06e455bcc8014f265f28b7f95eb6e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <li class=\'fx-stage\'>
        <div class=\'fx-title-gm\'>{{title}} - {{dispStartDate}} {{#dispEndDate}} to {{dispEndDate}} {{/dispEndDate}}</h4>
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
                $buffer .= $indent . '    <li class=\'fx-stage\'>
';
                $buffer .= $indent . '        <div class=\'fx-title-gm\'>';
                $value = $this->resolveValue($context->find('title'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ' - ';
                $value = $this->resolveValue($context->find('dispStartDate'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ' ';
                // 'dispEndDate' section
                $value = $context->find('dispEndDate');
                $buffer .= $this->section2ab5a339e0eb0b8fccc953178811dea0($context, $indent, $value);
                $buffer .= '</h4>
';
                $buffer .= $indent . '        <ul>
';
                // 'games' section
                $value = $context->find('games');
                $buffer .= $this->sectionDdf3dea694efcbcc35a51c5784750b9a($context, $indent, $value);
                $buffer .= $indent . '        </ul>
';
                $buffer .= $indent . '
';
                $buffer .= $indent . '    </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
