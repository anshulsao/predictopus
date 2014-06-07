<?php

class __Mustache_cf0075bc1083db39b8a67a504d312329 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        // 'game' section
        $value = $context->find('game');
        $buffer .= $this->section56c317d58d89e422a9a16f3f40bbc0b2($context, $indent, $value);

        return $buffer;
    }

    private function section5a3d07ce0d465c6cede399468c7dcf7a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{hScore1}}';
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
                $value = $this->resolveValue($context->find('hScore1'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6a6411dd23bc58873cb4fd972951398e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#prediction}}{{hScore1}}{{/prediction}}';
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
                // 'prediction' section
                $value = $context->find('prediction');
                $buffer .= $this->section5a3d07ce0d465c6cede399468c7dcf7a($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3b5a01232c2fa2d6f35120e2ad1d81ef(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{hScore2}}';
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
                $value = $this->resolveValue($context->find('hScore2'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section548b6172fc470a6d3e615f8fb974f98e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#prediction}}{{hScore2}}{{/prediction}}';
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
                // 'prediction' section
                $value = $context->find('prediction');
                $buffer .= $this->section3b5a01232c2fa2d6f35120e2ad1d81ef($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBdd00605a5eca70c980c3aff5ca9ca88(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{fScore1}}';
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
                $value = $this->resolveValue($context->find('fScore1'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6742bc289bec2a2472f42ba11acd928c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#prediction}}{{fScore1}}{{/prediction}}';
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
                // 'prediction' section
                $value = $context->find('prediction');
                $buffer .= $this->sectionBdd00605a5eca70c980c3aff5ca9ca88($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section571d5a5e368075200dc869385268cbc1(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{fScore2}}';
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
                $value = $this->resolveValue($context->find('fScore2'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8becc6fe47bb70366f96eaf36f8394c8(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#prediction}}{{fScore2}}{{/prediction}}';
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
                // 'prediction' section
                $value = $context->find('prediction');
                $buffer .= $this->section571d5a5e368075200dc869385268cbc1($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section56c317d58d89e422a9a16f3f40bbc0b2(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
<h1 class=\'fx-title-gm pdh-15 bg mod-title\'>Predict results - {{date}} - {{{team1Name}}} vs {{{team2Name}}}</h1>
<div class=\'bg-neg fnt-neg of-hid pd-15\'>
    <div class=\'col-md-6 text-mid pd-0\'>
        <img class=\'pn-badge\' src=\'/assets/img/badges/{{team1Code}}.png\'>
        <h2 class=\'fnt-h2\'>{{{team1Name}}}</h2>
    </div>
    <div class=\'col-md-6 text-mid pd-0\'>
        <div class=\'pn-versus fnt-h2\'>vs</div>
        <img class=\'pn-badge\' src=\'/assets/img/badges/{{team2Code}}.png\'>
        <h2 class=\'fnt-h2\'>{{{team2Name}}}</h2>
    </div>
    <div class=\'col-md-12 text-mid pn-tools\'>
        <div class="btn-group pn-toolrow" data-toggle="buttons">
            <label class="btn btn-default col-md-4">
                <input type="radio" name=\'winner\' data-val=\'{{{team1Name}}}\' data-id=\'1\'>Win</label>
            <label class="btn btn-default col-md-4">
                <input type="radio" name=\'winner\' data-val=\'draw\' data-id=\'0\'>Draw</label>
            <label class="btn btn-default col-md-4">
                <input type="radio" name=\'winner\' data-val=\'{{{team2Name}}}\' data-id=\'2\'>Win</label>
        </div>      
        <div class="input-group pn-toolrow">
            <input id=\'hScore1\' type="number" value="{{#p}}{{#prediction}}{{hScore1}}{{/prediction}}{{/p}}" class="form-control text-mid" min="0" max="15" placeholder="Half time goals for {{{team1Name}}}">
            <span class="input-group-addon">-</span>
            <input id=\'hScore2\' type="number" value="{{#p}}{{#prediction}}{{hScore2}}{{/prediction}}{{/p}}" class="form-control text-mid" min="0" max="15" placeholder="Half time goals for {{{team2Name}}}">
        </div>
        <div class="input-group pn-toolrow">
            <input id=\'fScore1\' type="number" value="{{#p}}{{#prediction}}{{fScore1}}{{/prediction}}{{/p}}" class="form-control text-mid" min="0" max="15" placeholder="Full time goals for {{{team1Name}}}">
            <span class="input-group-addon">-</span>
            <input id=\'fScore2\' type="number" value="{{#p}}{{#prediction}}{{fScore2}}{{/prediction}}{{/p}}" class="form-control text-mid" min="0" max="15" placeholder="Full time goals for {{{team2Name}}}">
        </div>
        <div class="alert alert-danger hidden pn-toolrow" id=\'pn-errorDiv\'></div>
        <div class="alert alert-info hidden pn-toolrow" id=\'pn-infoDiv\'></div>
    </div>
    <div class=\'col-md-12 text-mid\'>
        <button type="button" id=\'pn-submit\' class="btn btn-primary btn-sm" data-gameid="{{id}}">Save Prediction</button>
        <button type="button" class="btn btn-default btn-sm ">Cancel</button>
    </div>
</div>
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
                $buffer .= $indent . '<h1 class=\'fx-title-gm pdh-15 bg mod-title\'>Predict results - ';
                $value = $this->resolveValue($context->find('date'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ' - ';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= ' vs ';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '</h1>
';
                $buffer .= $indent . '<div class=\'bg-neg fnt-neg of-hid pd-15\'>
';
                $buffer .= $indent . '    <div class=\'col-md-6 text-mid pd-0\'>
';
                $buffer .= $indent . '        <img class=\'pn-badge\' src=\'/assets/img/badges/';
                $value = $this->resolveValue($context->find('team1Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '.png\'>
';
                $buffer .= $indent . '        <h2 class=\'fnt-h2\'>';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '</h2>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '    <div class=\'col-md-6 text-mid pd-0\'>
';
                $buffer .= $indent . '        <div class=\'pn-versus fnt-h2\'>vs</div>
';
                $buffer .= $indent . '        <img class=\'pn-badge\' src=\'/assets/img/badges/';
                $value = $this->resolveValue($context->find('team2Code'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '.png\'>
';
                $buffer .= $indent . '        <h2 class=\'fnt-h2\'>';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '</h2>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '    <div class=\'col-md-12 text-mid pn-tools\'>
';
                $buffer .= $indent . '        <div class="btn-group pn-toolrow" data-toggle="buttons">
';
                $buffer .= $indent . '            <label class="btn btn-default col-md-4">
';
                $buffer .= $indent . '                <input type="radio" name=\'winner\' data-val=\'';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '\' data-id=\'1\'>Win</label>
';
                $buffer .= $indent . '            <label class="btn btn-default col-md-4">
';
                $buffer .= $indent . '                <input type="radio" name=\'winner\' data-val=\'draw\' data-id=\'0\'>Draw</label>
';
                $buffer .= $indent . '            <label class="btn btn-default col-md-4">
';
                $buffer .= $indent . '                <input type="radio" name=\'winner\' data-val=\'';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '\' data-id=\'2\'>Win</label>
';
                $buffer .= $indent . '        </div>      
';
                $buffer .= $indent . '        <div class="input-group pn-toolrow">
';
                $buffer .= $indent . '            <input id=\'hScore1\' type="number" value="';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section6a6411dd23bc58873cb4fd972951398e($context, $indent, $value);
                $buffer .= '" class="form-control text-mid" min="0" max="15" placeholder="Half time goals for ';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '">
';
                $buffer .= $indent . '            <span class="input-group-addon">-</span>
';
                $buffer .= $indent . '            <input id=\'hScore2\' type="number" value="';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section548b6172fc470a6d3e615f8fb974f98e($context, $indent, $value);
                $buffer .= '" class="form-control text-mid" min="0" max="15" placeholder="Half time goals for ';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '">
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '        <div class="input-group pn-toolrow">
';
                $buffer .= $indent . '            <input id=\'fScore1\' type="number" value="';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section6742bc289bec2a2472f42ba11acd928c($context, $indent, $value);
                $buffer .= '" class="form-control text-mid" min="0" max="15" placeholder="Full time goals for ';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '">
';
                $buffer .= $indent . '            <span class="input-group-addon">-</span>
';
                $buffer .= $indent . '            <input id=\'fScore2\' type="number" value="';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section8becc6fe47bb70366f96eaf36f8394c8($context, $indent, $value);
                $buffer .= '" class="form-control text-mid" min="0" max="15" placeholder="Full time goals for ';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '">
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '        <div class="alert alert-danger hidden pn-toolrow" id=\'pn-errorDiv\'></div>
';
                $buffer .= $indent . '        <div class="alert alert-info hidden pn-toolrow" id=\'pn-infoDiv\'></div>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '    <div class=\'col-md-12 text-mid\'>
';
                $buffer .= $indent . '        <button type="button" id=\'pn-submit\' class="btn btn-primary btn-sm" data-gameid="';
                $value = $this->resolveValue($context->find('id'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '">Save Prediction</button>
';
                $buffer .= $indent . '        <button type="button" class="btn btn-default btn-sm ">Cancel</button>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '</div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
