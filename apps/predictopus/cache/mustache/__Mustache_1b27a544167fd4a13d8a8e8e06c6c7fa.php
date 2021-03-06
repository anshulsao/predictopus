<?php

class __Mustache_1b27a544167fd4a13d8a8e8e06c6c7fa extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        // 'game' section
        $value = $context->find('game');
        $buffer .= $this->sectionDd959a90729c258ef90db553030d538b($context, $indent, $value);

        return $buffer;
    }

    private function sectionDd959a90729c258ef90db553030d538b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
<h1 class=\'fx-title-gm pdh-15 bg mod-title\'>Predict results for Matchday 1 - 12 Jun 2014</h1>
<div class=\'bg-neg fnt-neg of-hid pd-15\'>
    <div class=\'col-md-6 text-mid pd-0\'>
        <img class=\'pn-badge\' src=\'/assets/img/badges/132px-Japan_national_team.png\'>
        <h2 class=\'fnt-h2\'>{{team1Name}}</h2>
    </div>
    <div class=\'col-md-6 text-mid pd-0\'>
        <div class=\'pn-versus fnt-h2\'>vs</div>
        <img class=\'pn-badge\' src=\'/assets/img/badges/140px-Nigeria_FA.svg.png\'>
        <h2 class=\'fnt-h2\'>{{team2Name}}</h2>
    </div>
    <div class=\'col-md-12 text-mid pn-tools\'>
        <div class="btn-group pn-toolrow" data-toggle="buttons">
            <label class="btn btn-default col-md-4">
                <input type="radio" name=\'winner\'>Win</label>
            <label class="btn btn-default col-md-4">
                <input type="radio" name=\'winner\'>Draw</label>
            <label class="btn btn-default col-md-4">
                <input type="radio" name=\'winner\'>Win</label>
        </div>
        <div class="input-group pn-toolrow">
            <input type="number" class="form-control text-mid" min="0" max="15" placeholder="Half time goals for Japan">
            <span class="input-group-addon">-</span>
            <input type="number" class="form-control text-mid" min="0" max="15" placeholder="Half time goals for Nigeria">
        </div>
        <div class="input-group pn-toolrow">
            <input type="number" class="form-control text-mid" min="0" max="15" placeholder="Full time goals for Japan">
            <span class="input-group-addon">-</span>
            <input type="number" class="form-control text-mid" min="0" max="15" placeholder="Full time goals for Japan">
        </div>
    </div>
    <div class=\'col-md-12 text-mid mg-vert-md\'>
        <button type="button" class="btn btn-primary btn-sm">Save Prediction</button>
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
                $buffer .= $indent . '<h1 class=\'fx-title-gm pdh-15 bg mod-title\'>Predict results for Matchday 1 - 12 Jun 2014</h1>
';
                $buffer .= $indent . '<div class=\'bg-neg fnt-neg of-hid pd-15\'>
';
                $buffer .= $indent . '    <div class=\'col-md-6 text-mid pd-0\'>
';
                $buffer .= $indent . '        <img class=\'pn-badge\' src=\'/assets/img/badges/132px-Japan_national_team.png\'>
';
                $buffer .= $indent . '        <h2 class=\'fnt-h2\'>';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '</h2>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '    <div class=\'col-md-6 text-mid pd-0\'>
';
                $buffer .= $indent . '        <div class=\'pn-versus fnt-h2\'>vs</div>
';
                $buffer .= $indent . '        <img class=\'pn-badge\' src=\'/assets/img/badges/140px-Nigeria_FA.svg.png\'>
';
                $buffer .= $indent . '        <h2 class=\'fnt-h2\'>';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
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
                $buffer .= $indent . '                <input type="radio" name=\'winner\'>Win</label>
';
                $buffer .= $indent . '            <label class="btn btn-default col-md-4">
';
                $buffer .= $indent . '                <input type="radio" name=\'winner\'>Draw</label>
';
                $buffer .= $indent . '            <label class="btn btn-default col-md-4">
';
                $buffer .= $indent . '                <input type="radio" name=\'winner\'>Win</label>
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '        <div class="input-group pn-toolrow">
';
                $buffer .= $indent . '            <input type="number" class="form-control text-mid" min="0" max="15" placeholder="Half time goals for Japan">
';
                $buffer .= $indent . '            <span class="input-group-addon">-</span>
';
                $buffer .= $indent . '            <input type="number" class="form-control text-mid" min="0" max="15" placeholder="Half time goals for Nigeria">
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '        <div class="input-group pn-toolrow">
';
                $buffer .= $indent . '            <input type="number" class="form-control text-mid" min="0" max="15" placeholder="Full time goals for Japan">
';
                $buffer .= $indent . '            <span class="input-group-addon">-</span>
';
                $buffer .= $indent . '            <input type="number" class="form-control text-mid" min="0" max="15" placeholder="Full time goals for Japan">
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '    <div class=\'col-md-12 text-mid mg-vert-md\'>
';
                $buffer .= $indent . '        <button type="button" class="btn btn-primary btn-sm">Save Prediction</button>
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
