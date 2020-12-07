#!/bin/bash

# -- Get the Build Type :
TYPE=$1

# -- Global Configurations:
stylesheet=/webroot/public/Assets/css/style.css;

# -- Make Sure We Delete and Re-Build Stylesheet:
rm $stylesheet;
touch $stylesheet;

# -- Run Style Parser:
bash run.sh parse-styles;

if [ "$TYPE" == "all" ]; then

  # -- Run Application Build Parser:
  bash run.sh build-app sync;

fi;
