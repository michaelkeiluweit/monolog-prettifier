<!doctype html>
<html lang="en">
<head>

    <style type="text/css">
        @import url('[{$oViewConf->getModuleUrl('mke-monolog-prettifier','out/src/css/normalize.css')}]');
        @import url('[{$oViewConf->getModuleUrl('mke-monolog-prettifier','out/src/css/skeleton.css')}]');
        @import url('[{$oViewConf->getModuleUrl('mke-monolog-prettifier','out/src/css/custom.css')}]');
    </style>
    <script type="text/javascript" src="[{$oViewConf->getModuleUrl('mke-monolog-prettifier','out/src/js/holder.js')}]"></script>
</head>

<body>

<div class="container">

    <h2>Monolog Prettifier</h2>

    [{if $amount > 0}]
    [{foreach from=$entities item=entity}]
    <div class="item" style="border-color: #[{$oView->getColorByLogLevelName($entity->getLevel())}];">
        <div class="row">
            <div class="twelve columns">
                <h5>[{$entity->getLevel()}] - [{$entity->getDate()}]</h5>
                <h5>[{$entity->getMessage()}]</h5>
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <br>
                <pre>[{$entity->getContextFormatted()}]</pre>
            </div>
        </div>
    </div>
    [{/foreach}]
    [{else}]
    The error log is does not contain any monolog log entries.
    [{/if}]

</div>
</div>


</body>
</html>
