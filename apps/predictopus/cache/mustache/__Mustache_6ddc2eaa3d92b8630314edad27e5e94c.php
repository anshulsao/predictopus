<?php

class __Mustache_6ddc2eaa3d92b8630314edad27e5e94c extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="container">
';
        $buffer .= $indent . '    <div class="navbar-header">
';
        $buffer .= $indent . '        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-7">
';
        $buffer .= $indent . '            <span class="sr-only">Toggle navigation</span>
';
        $buffer .= $indent . '            <span class="icon-bar"></span>
';
        $buffer .= $indent . '            <span class="icon-bar"></span>
';
        $buffer .= $indent . '            <span class="icon-bar"></span>
';
        $buffer .= $indent . '        </button>
';
        $buffer .= $indent . '        <a class="navbar-brand" href="/">
';
        $buffer .= $indent . '            <div class="logo" >
';
        $buffer .= $indent . '                <img src="/assets/img/logo.png">
';
        $buffer .= $indent . '                <span>Predictopus</span>
';
        $buffer .= $indent . '            </div></a>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-7">
';
        $buffer .= $indent . '        <ul class="nav navbar-nav">
';
        $buffer .= $indent . '            <li class="active"><a href="#">Predictome</a></li>
';
        $buffer .= $indent . '            <li><a href="#">World Cup</a></li>
';
        $buffer .= $indent . '            <li><a href="#">Leader Boards</a></li>
';
        $buffer .= $indent . '        </ul>        
';
        $buffer .= $indent . '        <ul class="nav navbar-nav navbar-right">
';
        // 'loggedIn' section
        $value = $context->find('loggedIn');
        $buffer .= $this->section7d2d12e9103f1d8cc0a0a71d6a5ddad3($context, $indent, $value);
        // 'loggedIn' inverted section
        $value = $context->find('loggedIn');
        if (empty($value)) {
            
            $buffer .= $indent . '            <li class="dropdown">
';
            $buffer .= $indent . '                <a href="" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
';
            $buffer .= $indent . '                <ul class="dropdown-menu">
';
            $buffer .= $indent . '                    <li><a href="#" id=\'lgn-fb\'><b class="fb-icon-29px"></b>Facebook</a></li>
';
            $buffer .= $indent . '                    <!--li class="divider"></li>
';
            $buffer .= $indent . '                    <li><a href="#">Google</a></li-->
';
            $buffer .= $indent . '                </ul>
';
            $buffer .= $indent . '            </li>
';
        }
        $buffer .= $indent . '        </ul>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section7d2d12e9103f1d8cc0a0a71d6a5ddad3(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <li>
                <a href="" class="dropdown-toggle lgn-pp-cont" data-toggle="dropdown">
                    <img src=\'{{profilePic}}\' class=\'lgn-profile-pic\'>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a>Hi {{name}} </a></li>
                    <li class="divider"></li>
                    <li><a href="" id=\'sign-out\'>Sign out</a></li>
                    <!--li class="divider"></li>
                    <li><a href="#">Google</a></li-->
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
                $buffer .= $indent . '            <li>
';
                $buffer .= $indent . '                <a href="" class="dropdown-toggle lgn-pp-cont" data-toggle="dropdown">
';
                $buffer .= $indent . '                    <img src=\'';
                $value = $this->resolveValue($context->find('profilePic'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= '\' class=\'lgn-profile-pic\'>
';
                $buffer .= $indent . '                    <b class="caret"></b>
';
                $buffer .= $indent . '                </a>
';
                $buffer .= $indent . '                <ul class="dropdown-menu">
';
                $buffer .= $indent . '                    <li><a>Hi ';
                $value = $this->resolveValue($context->find('name'), $context, $indent);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= ' </a></li>
';
                $buffer .= $indent . '                    <li class="divider"></li>
';
                $buffer .= $indent . '                    <li><a href="" id=\'sign-out\'>Sign out</a></li>
';
                $buffer .= $indent . '                    <!--li class="divider"></li>
';
                $buffer .= $indent . '                    <li><a href="#">Google</a></li-->
';
                $buffer .= $indent . '                </ul>
';
                $buffer .= $indent . '            </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }
}
