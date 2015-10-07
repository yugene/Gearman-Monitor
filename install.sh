#!/usr/bin/env bash

pear config-set preferred_state alpha
pear install Net_Gearman
pear config-set preferred_state stable