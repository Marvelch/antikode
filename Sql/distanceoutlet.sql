SELECT (6371 * acos( 
                cos( radians(-6.172043) ) 
              * cos( radians(-6.2349) ) 
              * cos( radians(106.9896) - radians(106.826327) ) 
              + sin( radians(-6.172043) ) 
              * sin( radians(-6.2349) )
                ) ) as distance 