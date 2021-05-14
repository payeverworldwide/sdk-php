<?php

require_once str_replace(
    '/',
    DIRECTORY_SEPARATOR,
    __DIR__ . '/../../lib/Payever/ExternalIntegration/Core/Engine.php'
);

$gitlabTag = !empty($argv[1]) ? $argv[1] : 0;

if (version_compare(PEI_CORE_VERSION, $gitlabTag, '<=')) {
    echo 'Plugin version should be greater then latest tag' . PHP_EOL;
    exit(1);
}
$combinedVersion = sprintf(
    '%s.%s.%s',
    PEI_CORE_MAJOR_VERSION,
    PEI_CORE_MINOR_VERSION,
    PEI_CORE_RELEASE_VERSION
);
if (PEI_CORE_VERSION !== $combinedVersion) {
    echo 'Major and/or minor and/or release versions are incorrect' . PHP_EOL;
    exit(1);
}

echo 'Version to be released is ' . PEI_CORE_VERSION . PHP_EOL;
