import sys
import os

if len(sys.argv) <= 1:
    sys.exit("no arguments")

for i, f in enumerate(sys.argv):
    if i == 0:
        continue

    os.system('scp -r ' + f + ' noverish@noverish.me:/home/noverish/node-project/noverish/')
