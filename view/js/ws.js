
             $.achex({
                    facebook: false,              /* Overwrites username and password with Facebook API login*/

                    username: 'elvis',  /* (native-auth) Achex Native username - set from Panel */
                    password: '1574wce',             /* (native-auth) Achex Native password - set from Panel*/

                    url: 'wss://cloud.achex.ca/',     /* (optional) custom server URL to connect to*/
                       port: 443,                     /* (optional) custom port*/

                   reconnect: false,              /* 3000(optional) Reconnect timeout - set to 'false' to disable */

                    autoconnect: false,            /* true (optional) Connect now - set to 'false' to disable */

                    opencallback : function(){
                            
                                console.log('Connection Ready');
                              },

                    closecallback : function(){
                             
                                console.log('Diconnected');
                              },

                    callback: function( message_object, raw_message_data, event)
                              {
                              
  if (message_object.someMessage!=null) {
mensajedat(message_object.someMessage);
                    }
                              }
            });

            $.achex.join('salawce');       
           
