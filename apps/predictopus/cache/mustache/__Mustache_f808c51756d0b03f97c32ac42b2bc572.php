<?php

class __Mustache_f808c51756d0b03f97c32ac42b2bc572 extends Mustache_Template
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
        $buffer .= $this->section64f0966e0c0c71ce4a5677dfffcfb8e7($context, $indent, $value);
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

    private function section73d1ed3acbd08e58e28311206205ee66(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <li class=\'fx-game\'>
                <div class=\'col-md-1\'>{{timeDisp}}</div>
                <div class=\'col-md-4\'>
                    <div class=\'col-md-6\'>
                        <i class=\'flag {{team1Code}}\'></i>
                        <span>{{{team1Name}}}</span>
                    </div>
                    <div class=\'col-md-6\'>
                        <i class=\'flag {{team2Code}}\'></i>
                        <span>{{{team2Name}}}</span>  
                    </div>
                </div>
                <div class=\'col-sm-4\'>
                    <div>{{{groundFullTitle}}} - {{groundCapacity}}</div>
                </div>
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
                $buffer .= $indent . '            <li class=\'fx-game\'>
';
                $buffer .= $indent . '                <div class=\'col-md-1\'>';
                $value = $this->resolveValue($context->find('timeDisp'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</div>
';
                $buffer .= $indent . '                <div class=\'col-md-4\'>
';
                $buffer .= $indent . '                    <div class=\'col-md-6\'>
';
                $buffer .= $indent . '                        <i class=\'flag ';
                $value = $this->resolveValue($context->find('team1Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '\'></i>
';
                $buffer .= $indent . '                        <span>';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '</span>
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '                    <div class=\'col-md-6\'>
';
                $buffer .= $indent . '                        <i class=\'flag ';
                $value = $this->resolveValue($context->find('team2Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '\'></i>
';
                $buffer .= $indent . '                        <span>';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '</span>  
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '                <div class=\'col-sm-4\'>
';
                $buffer .= $indent . '                    <div>';
                $value = $this->resolveValue($context->find('groundFullTitle'), $context, $indent);
                $buffer .= $value;
                $buffer .= ' - ';
                $value = $this->resolveValue($context->find('groundCapacity'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</div>
';
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '            </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section64f0966e0c0c71ce4a5677dfffcfb8e7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <li class=\'fx-stage\'>
        <div class=\'fx-title-gm pdh-15\'>{{title}} - {{dispStartDate}} {{#dispEndDate}} to {{dispEndDate}} {{/dispEndDate}}</div>
        <ul>
            {{#games}}
            <li class=\'fx-game\'>
                <div class=\'col-md-1\'>{{timeDisp}}</div>
                <div class=\'col-md-4\'>
                    <div class=\'col-md-6\'>
                        <i class=\'flag {{team1Code}}\'></i>
                        <span>{{{team1Name}}}</span>
                    </div>
                    <div class=\'col-md-6\'>
                        <i class=\'flag {{team2Code}}\'></i>
                        <span>{{{team2Name}}}</span>  
                    </div>
                </div>
                <div class=\'col-sm-4\'>
                    <div>{{{groundFullTitle}}} - {{groundCapacity}}</div>
                </div>
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
                $buffer .= $indent . '        <div class=\'fx-title-gm pdh-15\'>';
                $value = $this->resolveValue($context->find('title'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ' - ';
                $value = $this->resolveValue($context->find('dispStartDate'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ' ';
                // 'dispEndDate' section
                $value = $context->find('dispEndDate');
                $buffer .= $this->section2ab5a339e0eb0b8fccc953178811dea0($context, $indent, $value);
                $buffer .= '</div>
';
                $buffer .= $indent . '        <ul>
';
                // 'games' section
                $value = $context->find('games');
                $buffer .= $this->section73d1ed3acbd08e58e28311206205ee66($context, $indent, $value);
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
