<?php

class __Mustache_6cef4f52f71253e4b3b885c54ab7afce extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '<h1 class=\'fx-title-gm pdh-15 bg mod-title\'>Predict results for Matchday 1 - 12 Jun 2014</h1>
';
        $buffer .= $indent . '<div class=\'bg-neg fnt-neg of-hid pd-15\'>
';
        $buffer .= $indent . '    <div class=\'col-md-6 text-mid pd-0\'>
';
        $buffer .= $indent . '        <img class=\'pn-badge\' src=\'/assets/img/badges/132px-Japan_national_team.png\'>
';
        $buffer .= $indent . '        <h2 class=\'fnt-h2\'>Japan</h2>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '    <div class=\'col-md-6 text-mid pd-0\'>
';
        $buffer .= $indent . '        <div class=\'pn-versus fnt-h2\'>vs</div>
';
        $buffer .= $indent . '        <img class=\'pn-badge\' src=\'/assets/img/badges/140px-Nigeria_FA.svg.png\'>
';
        $buffer .= $indent . '        <h2 class=\'fnt-h2\'>Nigeria</h2>
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
        $buffer .= $indent . '            <input type="number" class="form-control" min="0" max="15" placeholder="Half time goals for Japan">
';
        $buffer .= $indent . '            <span class="input-group-addon">-</span>
';
        $buffer .= $indent . '            <input type="number" class="form-control" min="0" max="15" placeholder="Half time goals for Nigeria">
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="input-group pn-toolrow">
';
        $buffer .= $indent . '            <input type="number" class="form-control" min="0" max="15" placeholder="Full time goals for Japan">
';
        $buffer .= $indent . '            <span class="input-group-addon">-</span>
';
        $buffer .= $indent . '            <input type="number" class="form-control" min="0" max="15" placeholder="Full time goals for Japan">
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
        $buffer .= $indent . '</div>';

        return $buffer;
    }
}
