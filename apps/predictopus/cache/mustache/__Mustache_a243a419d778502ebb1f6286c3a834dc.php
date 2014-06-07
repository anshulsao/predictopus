<?php

class __Mustache_a243a419d778502ebb1f6286c3a834dc extends Mustache_Template
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
        $buffer .= $this->section330792e21daade42995eb3e69105b44f($context, $indent, $value);
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

    private function section14ca870d519afbae02a53004b6826cda(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <li class=\'fx-game fnt-neg\'>
                <div class=\'col-md-1 fx-time\'>{{timeDisp}}</div>
                <div class=\'col-md-7 fx-teams\'>
                    <span class=\'col-md-6\'>
                        <i class=\'flag {{team1Code}}\'></i>
                        <span class=\'fx-tmname\'>{{{team1Name}}}</span>
                    </span>
                    <span class=\'col-md-6\'>
                        <i class=\'flag {{team2Code}}\'></i>
                        <span class=\'fx-tmname\'>{{{team2Name}}}</span>  
                    </span>
                </div>
                <div class=\'col-md-2 fx-venue\'>
                    <span>{{{groundTitle}}}</span>
                </div>
                <div class=\'col-md-2 fx-actions\'>
                    <button type="button" class="btn btn-info btn-xs">Predict Now!</button>
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
                $buffer .= $indent . '            <li class=\'fx-game fnt-neg\'>
';
                $buffer .= $indent . '                <div class=\'col-md-1 fx-time\'>';
                $value = $this->resolveValue($context->find('timeDisp'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</div>
';
                $buffer .= $indent . '                <div class=\'col-md-7 fx-teams\'>
';
                $buffer .= $indent . '                    <span class=\'col-md-6\'>
';
                $buffer .= $indent . '                        <i class=\'flag ';
                $value = $this->resolveValue($context->find('team1Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '\'></i>
';
                $buffer .= $indent . '                        <span class=\'fx-tmname\'>';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '</span>
';
                $buffer .= $indent . '                    </span>
';
                $buffer .= $indent . '                    <span class=\'col-md-6\'>
';
                $buffer .= $indent . '                        <i class=\'flag ';
                $value = $this->resolveValue($context->find('team2Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '\'></i>
';
                $buffer .= $indent . '                        <span class=\'fx-tmname\'>';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '</span>  
';
                $buffer .= $indent . '                    </span>
';
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '                <div class=\'col-md-2 fx-venue\'>
';
                $buffer .= $indent . '                    <span>';
                $value = $this->resolveValue($context->find('groundTitle'), $context, $indent);
                $buffer .= $value;
                $buffer .= '</span>
';
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '                <div class=\'col-md-2 fx-actions\'>
';
                $buffer .= $indent . '                    <button type="button" class="btn btn-info btn-xs">Predict Now!</button>
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

    private function section330792e21daade42995eb3e69105b44f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <li class=\'fx-stage\'>
        <div class=\'fx-title-gm pdh-15\'>{{title}} - {{dispStartDate}} {{#dispEndDate}} to {{dispEndDate}} {{/dispEndDate}}</div>
        <ul>
            {{#games}}
            <li class=\'fx-game fnt-neg\'>
                <div class=\'col-md-1 fx-time\'>{{timeDisp}}</div>
                <div class=\'col-md-7 fx-teams\'>
                    <span class=\'col-md-6\'>
                        <i class=\'flag {{team1Code}}\'></i>
                        <span class=\'fx-tmname\'>{{{team1Name}}}</span>
                    </span>
                    <span class=\'col-md-6\'>
                        <i class=\'flag {{team2Code}}\'></i>
                        <span class=\'fx-tmname\'>{{{team2Name}}}</span>  
                    </span>
                </div>
                <div class=\'col-md-2 fx-venue\'>
                    <span>{{{groundTitle}}}</span>
                </div>
                <div class=\'col-md-2 fx-actions\'>
                    <button type="button" class="btn btn-info btn-xs">Predict Now!</button>
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
                $buffer .= $this->section14ca870d519afbae02a53004b6826cda($context, $indent, $value);
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
