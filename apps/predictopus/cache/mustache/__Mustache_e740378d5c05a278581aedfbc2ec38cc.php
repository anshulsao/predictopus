<?php

class __Mustache_e740378d5c05a278581aedfbc2ec38cc extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        // 'game' section
        $value = $context->find('game');
        $buffer .= $this->section20838db800176c53dbfe8363d62d47d1($context, $indent, $value);

        return $buffer;
    }

    private function section5749c750acb0d7477dd5257d00cc6d53(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = 'active';
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
                $buffer .= 'active';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section4d72ffeb35cd4f741a603d55e01bb5ab(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#team1W}}active{{/team1W}}';
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
                // 'team1W' section
                $value = $context->find('team1W');
                $buffer .= $this->section5749c750acb0d7477dd5257d00cc6d53($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section51d7c9c652ced0161cb587bacd669266(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = 'checked';
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
                $buffer .= 'checked';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionCc75a1777c789f489a6bdd72b624a206(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#team1W}}checked{{/team1W}}';
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
                // 'team1W' section
                $value = $context->find('team1W');
                $buffer .= $this->section51d7c9c652ced0161cb587bacd669266($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section31c48e1cb8a8eb6247bce3b81faa8a49(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#draw}}active{{/draw}}';
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
                // 'draw' section
                $value = $context->find('draw');
                $buffer .= $this->section5749c750acb0d7477dd5257d00cc6d53($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section2723b9e76a0e477653b71a2e50a9d9a9(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#draw}}checked{{/draw}}';
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
                // 'draw' section
                $value = $context->find('draw');
                $buffer .= $this->section51d7c9c652ced0161cb587bacd669266($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionCc43733796e832c5876643431d7d30c4(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#team2W}}active{{/team2W}}';
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
                // 'team2W' section
                $value = $context->find('team2W');
                $buffer .= $this->section5749c750acb0d7477dd5257d00cc6d53($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section4a6323490b4b9f401e9268982695f9d3(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#team2W}}checked{{/team2W}}';
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
                // 'team2W' section
                $value = $context->find('team2W');
                $buffer .= $this->section51d7c9c652ced0161cb587bacd669266($context, $indent, $value);
                $context->pop();
            }
        }
    
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

    private function sectionF98a35931c6c91e2ebb65d5c03c7bb66(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = 'data-show-summary=\'1\'';
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
                $buffer .= 'data-show-summary=\'1\'';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section661ad12c682c9e6f73a3b10c4303e7d6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = 'Edit';
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
                $buffer .= 'Edit';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section20838db800176c53dbfe8363d62d47d1(Mustache_Context $context, $indent, $value)
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
            <label class="btn btn-default col-md-4 {{#p}}{{#team1W}}active{{/team1W}}{{/p}}">
                <input type="radio" name=\'winner\' data-val=\'{{{team1Name}}}\' data-id=\'1\' {{#p}}{{#team1W}}checked{{/team1W}}{{/p}}>Win</label>
            <label class="btn btn-default col-md-4 {{#p}}{{#draw}}active{{/draw}}{{/p}}">
                <input type="radio" name=\'winner\' data-val=\'draw\' data-id=\'0\' {{#p}}{{#draw}}checked{{/draw}}{{/p}}>Draw</label>
            <label class="btn btn-default col-md-4 {{#p}}{{#team2W}}active{{/team2W}}{{/p}}">
                <input type="radio" name=\'winner\' data-val=\'{{{team2Name}}}\' data-id=\'2\' {{#p}}{{#team2W}}checked{{/team2W}}{{/p}}>Win</label>
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
        <button type="button" id=\'pn-submit\' {{#p}}data-show-summary=\'1\'{{/p}} class="btn btn-primary btn-sm" data-gameid="{{id}}">{{^p}}Save{{/p}}{{#p}}Edit{{/p}} Prediction</button>
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
                $buffer .= $indent . '            <label class="btn btn-default col-md-4 ';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section4d72ffeb35cd4f741a603d55e01bb5ab($context, $indent, $value);
                $buffer .= '">
';
                $buffer .= $indent . '                <input type="radio" name=\'winner\' data-val=\'';
                $value = $this->resolveValue($context->find('team1Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '\' data-id=\'1\' ';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->sectionCc75a1777c789f489a6bdd72b624a206($context, $indent, $value);
                $buffer .= '>Win</label>
';
                $buffer .= $indent . '            <label class="btn btn-default col-md-4 ';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section31c48e1cb8a8eb6247bce3b81faa8a49($context, $indent, $value);
                $buffer .= '">
';
                $buffer .= $indent . '                <input type="radio" name=\'winner\' data-val=\'draw\' data-id=\'0\' ';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section2723b9e76a0e477653b71a2e50a9d9a9($context, $indent, $value);
                $buffer .= '>Draw</label>
';
                $buffer .= $indent . '            <label class="btn btn-default col-md-4 ';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->sectionCc43733796e832c5876643431d7d30c4($context, $indent, $value);
                $buffer .= '">
';
                $buffer .= $indent . '                <input type="radio" name=\'winner\' data-val=\'';
                $value = $this->resolveValue($context->find('team2Name'), $context, $indent);
                $buffer .= $value;
                $buffer .= '\' data-id=\'2\' ';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section4a6323490b4b9f401e9268982695f9d3($context, $indent, $value);
                $buffer .= '>Win</label>
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
                $buffer .= $indent . '        <button type="button" id=\'pn-submit\' ';
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->sectionF98a35931c6c91e2ebb65d5c03c7bb66($context, $indent, $value);
                $buffer .= ' class="btn btn-primary btn-sm" data-gameid="';
                $value = $this->resolveValue($context->find('id'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '">';
                // 'p' inverted section
                $value = $context->find('p');
                if (empty($value)) {
                    
                    $buffer .= 'Save';
                }
                // 'p' section
                $value = $context->find('p');
                $buffer .= $this->section661ad12c682c9e6f73a3b10c4303e7d6($context, $indent, $value);
                $buffer .= ' Prediction</button>
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
