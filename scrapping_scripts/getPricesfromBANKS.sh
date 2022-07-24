#!/bin/bash
### set -vx

export NODE_PATH=/usr/share/npm/node_modules/lib/node_modules/ 

cd /home/run_tasks/projects/dolar-turista  
node BANK_base.js bank.js 
