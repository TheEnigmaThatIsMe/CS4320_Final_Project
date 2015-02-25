p
ssh-dss
AAAAB3NzaC1kc3MAAACBAJ9g0o9yqrsMw+4LjVnpxf0S58u9lafiK1QvcQBZDzK6GV9lDZRUO2SAC8z/B+pcQmrzTET/7Nh6gaBEiHIZwXsbUcc/zL1myuJUs4HKeDTZ8a5893nRZHX/gkNB2FfdHs8jVIESpx0qNx3t9AwC4sWacvPbKMPGvSxAh5DygklpAAAAFQDkFMSyDxhASz7xaytD78GevafRNQAAAIB5kSK/gBR0tZMyY5TBG7BaIIVrwF5r2RqH+/J8ySaSNNDugZSOjmXJuiFWPkQsqVW11o1v0BLBtrh9J98ktRnORQcSag+Dpg4QHvFhSKH+GZekyFI8cq8aXKFNIgDbqL5TBqW3DHGsDjw1QJNlnvmx6KaRAtOM5B/NqotfsE3LRgAAAIBPZC+CBiL3i890PmVhLVNPYcgOADN0nWB2nP/pNBIS9KYliLpl5foRtOab1nuIzZ9uokxhe0XcEMhDLztwj4f2/1uY4NkTOejsFKGdBXQRgKe90XUYVwABAyoRn7jN++vj/38siKO2IgFal8ShNH8+i2S93p/pu9Gd3OGNC1h8RA==cs4320f14grp3@babbage.cs.missouri.edu


This is the public SSH key.

Click on your name in codeforge on the top left side of the page. Then click
on Update Account. Copy and paste the key above into the Add a public key box
then click update account.


Group babbage account: cs4320f14grp3

Password: K1:aTSFMuIvWk



To push whatever you are working on up to codeforge do:

// denotes a comment

1. git clone git@codeforge.cs.missouri.edu:swe-fs14gc.git  //only do this once to clone the repository to a new system .

2. git init //initializes the repository. Do this at the beginning every time

3. git pull origin master //update the local copy of the repository.

4. git checkout -b *branchName* (git checkout *branchName* to move into this branch from here on out)

5. vim *files you want to create*

6. git add FILENAME.txt (php)(html).

7. commit -m "add your comment here".

-----------------------------------------------------------------------------------------------
---------- ONLY DO THIS IF YOU'RE READY TO MERGE YOUR GOOD WORKING CODE TO MASTER -------------
---------- YOU HAVE THE POTENTIAL TO BREAK THE MASTER; DO NOT MERGE/PUSH BROKEN CODE!!! -------
---------- MAKE SURE TO PULL THE LATEST MASTER BEFORE MERGING YOUR BRANCH TO MASTER -----------
-----------------------------------------------------------------------------------------------

8. git checkout master //Navigate to master branch to push your branch to master

9. git merge *branchName*

10. Fix merge conflicts if any arise

11. git push origin master

Typical work flow of a git repository.
