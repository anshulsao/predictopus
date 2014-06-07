<!DOCTYPE html>
<html <?php echo $htmlAttribs ?>>
    <head>
        <?php require dirname(__FILE__) . '/commonhead.php' ?>
    </head>
    <body class="<?php echo $bodyClasses ?>">
        <div class="asa-content">            
            <nav id="header" class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation"> <?php echo $header ?> </nav>
            <div id='superlead' class='asa-full'><?php
                echo $getMarkup($slots, 'superlead');
                ?></div>
            <div id='content' class='container asa-main'>
                <div id='leadslot1' class='row'><?php
                    echo $getMarkup($slots, 'leadslot1');
                    ?></div>
                <div id='leadslot2' class='row'><?php
                    echo $getMarkup($slots, 'leadslot2');
                    ?></div>
                <div id='leadslot3' class='row'><?php
                    echo $getMarkup($slots, 'leadslot3');
                    ?></div>
                <div id='leadslot3' class='row'><?php
                    echo $getMarkup($slots, 'leadslot4');
                    ?></div>
                <div class='row'>
                    <div id='left' class='col-md-8 col-sm-8 asa-left-8'>
                        <div id='lslot1' class='row'><?php
                            echo $getMarkup($slots, 'lslot1');
                            ?></div>
                        <div id='lslot2' class='row'><?php
                            echo $getMarkup($slots, 'lslot2');
                            ?></div>
                        <div id='lslot3' class='row'><?php
                            echo $getMarkup($slots, 'lslot3');
                            ?></div>
                        <div id='lslot4' class='row'><?php
                            echo $getMarkup($slots, 'lslot4');
                            ?></div>
                        <div id='lslot5' class='row'><?php
                            echo $getMarkup($slots, 'lslot5');
                            ?></div>
                    </div>
                    <div id='right' class='col-md-4 asa-right-4 col-sm-4 hidden-xs hidden-portrait'>
                        <div>                           
                            <div id='rslot1' class='rrow'><?php
                                echo $getMarkup($slots, 'rslot1');
                                ?></div>
                            <div id='rslot2' class='rrow'><?php
                                echo $getMarkup($slots, 'rslot2');
                                ?></div>
                            <div id='rslot3' class='rrow'><?php
                                echo $getMarkup($slots, 'rslot3');
                                ?></div>                          
                            <div id='rslot4' class='rrow'><?php
                                echo $getMarkup($slots, 'rslot4');
                                ?></div>
                            <div id='rslot5' class='rrow'><?php
                                echo $getMarkup($slots, 'rslot5');
                                ?></div>
                            <div id='footer' class='rrow'><?php
                                echo $footer;
                                ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require dirname(__FILE__) . '/commonbottom.php' ?>
    </body>
</html>
