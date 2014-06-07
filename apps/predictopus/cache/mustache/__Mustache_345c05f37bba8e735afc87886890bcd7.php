<?php

class __Mustache_345c05f37bba8e735afc87886890bcd7 extends Mustache_Template
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
        $buffer .= $this->sectionAd4b8910ea37b6854016dda5ff521514($context, $indent, $value);
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

    private function sectionA85c848838fede9e7f1d3d435a0ba150(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = 'btn-success';
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
                $buffer .= 'btn-success';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC1b273c4579574e1483062cc50c8b441(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = 'Edit Prediction!';
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
                $buffer .= 'Edit Prediction!';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section56c606993712036be0b682f66b4ddddc(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <li class=\'fx-game fnt-neg bg-neg\'>
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
                <a class=\'col-md-2 fx-actions\' href=\'/game/{{id}}\'>
                    <button type="button" class="btn {{#p}}btn-success{{/p}} {{^p}}btn-info{{/p}} btn-xs">{{#p}}Edit Prediction!{{/p}}{{^p}}Predict Now!{{/p}}</button>
                </a>
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
                $buffer .= $indent . '            <li class=\'fx-game fnt-neg bg-neg\'>
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
                $buffer .= $indent . '                <a class=\'col-md-2 fx-actions\' href=\'/game/';
                $value = $this->resolveValue($context->find('id'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '\'>
';
                $buffer .= $indent . '                    <button type="button" class="btn ';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->sectionA85c848838fede9e7f1d3d435a0ba150($context, $indent, $value);
                $buffer .= ' ';
                // 'p' inverted section
                $value = $context->find('p');
                if (empty($value)) {
                    
                    $buffer .= 'btn-info';
                }
                $buffer .= ' btn-xs">';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->sectionC1b273c4579574e1483062cc50c8b441($context, $indent, $value);
                // 'p' inverted section
                $value = $context->find('p');
                if (empty($value)) {
                    
                    $buffer .= 'Predict Now!';
                }
                $buffer .= '</button>
';
                $buffer .= $indent . '                </a>
';
                $buffer .= $indent . '            </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionAd4b8910ea37b6854016dda5ff521514(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <li class=\'fx-stage\'>
        <div class=\'fx-title-gm pdh-15 bg mod-title\'>{{title}} - {{dispStartDate}} {{#dispEndDate}} to {{dispEndDate}} {{/dispEndDate}}</div>
        <ul>
            {{#games}}
            <li class=\'fx-game fnt-neg bg-neg\'>
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
                <a class=\'col-md-2 fx-actions\' href=\'/game/{{id}}\'>
                    <button type="button" class="btn {{#p}}btn-success{{/p}} {{^p}}btn-info{{/p}} btn-xs">{{#p}}Edit Prediction!{{/p}}{{^p}}Predict Now!{{/p}}</button>
                </a>
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
                $buffer .= $indent . '        <div class=\'fx-title-gm pdh-15 bg mod-title\'>';
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
                $buffer .= $this->section56c606993712036be0b682f66b4ddddc($context, $indent, $value);
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
