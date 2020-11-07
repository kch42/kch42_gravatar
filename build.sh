#!/usr/bin/env bash

r7r-plugin-packer \
    --output=gravatar.rpk \
    --codefile=plugin.php \
    --classname=gravatar \
    --pluginname=gravatar \
    --author='Laria Carolin Chabowski <laria@laria.me>' \
    --versiontext="0.6.2" \
    --versioncount=4 \
    --api=5 \
    --shortdesc="This plugin allows you to display [Gravatars](http://de.gravatar.com)" \
    --helpfile=help.html \
    --licensefile=COPYING
