#!/bin/bash

SCRIPT=$(readlink -f $0)
SCRIPTPATH=`dirname $SCRIPT`
$SCRIPTPATH/install-dependencies.sh
$SCRIPTPATH/install-magento.sh
$SCRIPTPATH/install-sample-data.sh
