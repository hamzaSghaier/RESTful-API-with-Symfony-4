# RESTful-API-with-Symfony-4
RESTful API with Symfony 4 + FOSRestBundle + JMSSerializer


  /bin/console debug:router
 ----------------------- -------- -------- ------ -------------------------- 
  Name                    Method   Scheme   Host   Path                      
 ----------------------- -------- -------- ------ -------------------------- 
  app_place_postplaces    POST     ANY      ANY    /places                   
  app_place_deleteplace   DELETE   ANY      ANY    /places/{id}              
  app_place_putplace      PUT      ANY      ANY    /places/{id}              
  app_place_patchplace    PATCH    ANY      ANY    /places/{id}              
  app_place_getplaces     GET      ANY      ANY    /places                   
  app_place_getplace      GET      ANY      ANY    /places/{id}              
  app_price_getprices     GET      ANY      ANY    /places/{id}/prices       
  app_price_postprices    POST     ANY      ANY    /places/{id}/prices       
  app_user_postusers      POST     ANY      ANY    /users                    
  app_user_patchuser      PATCH    ANY      ANY    /users/{id}               
  app_user_putuser        PUT      ANY      ANY    /users/{id}               
  app_user_deleteuser     DELETE   ANY      ANY    /users/{id}               
  app_user_getusers       GET      ANY      ANY    /users                    
  app_user_getuser        GET      ANY      ANY    /users/{user_id}          
 ----------------------- -------- -------- ------ -------------------------- 

