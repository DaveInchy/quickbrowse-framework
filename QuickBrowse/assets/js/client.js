function QB_CLIENT(){
	//Object Properties
	this.objectName 		= 'QuickBrowse-Client',
	this.objectVersion 		= 'alpha-2.4',
	
	//Quickbrowse Properties
	this.Version			= undefined,
	this.Domain				= undefined,
	this.Session			= undefined
	this.Debug				= undefined,
	this.DOCS_URL			= undefined,
	this.API_URL			= undefined,
	this.API_KEY			= undefined,
	
	//Object sub-Objects
	this.Log 				= undefined,
	this.API 				= undefined,
	this.User 				= undefined,
	
	//Object Constructor or Initializer
	this.Init = (data) => {
		
		if(data != undefined){
			
			if(data.QB != undefined){
				
				if(data.QB.DATA != undefined){
					
					try{
						var DATA = data.QB.DATA;
						
						this.Version = DATA.VERSION;
						this.Domain = DATA.DOMAIN;
						this.Debug = DATA.DEBUG;
						
						this.Log = new QB_LOG(this.Debug, this.objectName + ' v' + this.objectVersion);
						if(this.Log != undefined){
							this.Log.setMessage('info', "Found Debug state (on) and set Client Log Object, Start logging from now on.");
						}
						
						this.API_DOMAIN = DATA.API_DOMAIN;
						this.API_VERSION = DATA.API_VERSION;
						this.API_KEY = DATA.API_KEY;
						
						this.Log.setMessage('success', "Finished setting Client properties");
					}catch(Exception){
						if(this.Log != undefined){
							this.Log.setMessage('exception', "Caught Exception while setting Client properties.");
							this.Log.setMessage(console.trace(), Exception);
						}
					}
					
					if(data.QB.DATA.TEMPLATE != undefined){
					}
					
					if(data.QB.DATA.PAGE != undefined){
					}
					
					
					
				}
				
				if(data.QB.USER != undefined){
					try{
						this.Log.setMessage('info', "Start creating User Object for Client");
						var DATA = data.QB.USER;
						this.User = new QB_USER(this);
						if(!this.User.Init(DATA.loggedin, DATA.id, DATA.public, DATA.name, DATA.email)){
							this.Log.setMessage('error', 'Creating User Object failed, there\'s probably no user logged in.');
						}
						//@TODO Create connection with User API
						//this.User.API = new QB_API(this.User);
						this.Log.setMessage('success', "Finished creating User Object for Client");
					}catch(Exception){
						this.Log.setMessage('exception', "Caught Exception while setting Client properties.");
						this.Log.setMessage(console.trace(), Exception);
					}
				}
				
				if(data.QB.ASSETS != undefined){
				}
				
			}
			
		}
		
	},
	
	//Object Functions
	this.newAPI = () => {
		API = new QB_API(this.API_KEY, this.Domain);
		return API;
	}
}

function QB_LOG(state, sender){
	//Object Properties
	this.Debug = state,
	this.Sender = sender,
	this.latestMessage = undefined,
	this.messageType = undefined,
	
	//Object Functions
	this.getMessage = (messageOnly = false) => {
		if(messageOnly){
			return this.latestMessage;
		}
		return '(' + this.Sender + ')[' + this.messageType.toUpperCase() + '] ' + this.latestMessage;
	},
	this.setMessage = (type, txt) => {
		this.latestMessage = txt;
		this.messageType = type;
		if(this.Debug == 'on'){
			console.log(this.getMessage());
		}
		return true;
	}
}

function QB_USER(obj){
	
	//Object Properties
	this.objectName = 'QuickBrowse User';
	this.loggedIn = undefined,
	this.userId = undefined,
	this.publicKey = undefined,
	this.fullName = undefined,
	this.userEmail = undefined,
	
	//Object sub-Objects
	this.Parent = obj;
	this.Log = new QB_LOG(this.Parent.Debug, this.objectName),
	this.API = undefined,
	
	//Object Constructor or Initializer
	this.Init = (loggedin, id, key, name, email) => {
		this.Log.setMessage('process', "Starting Initialisation of " + this.objectName + ".");
		if(!loggedin){
			this.Loggedin 		= loggedin;
			this.Uid 			= 'noUid';
			this.Public 		= 'noAuth';
			this.Name 			= 'noName';
			this.Email 			= 'noEmail';
			this.Log.setMessage('process', "Stopping process.");
			return false;	
		}
		this.Loggedin 		= loggedin;
		this.Uid 			= id;
		this.Public 		= key;
		this.Name 			= name;
		this.Email 			= email;
		this.Log.setMessage('process', "Finishing process.");
		return true;
	}
	
}

function QB_API(key, domain){
	//Object Properties
	this.objectName('QuickBrowse API Handler'),
	this.senderDomain = domain,
	this.senderKey = key,
	this.requestURL = undefined,
	
	//Object sub-Objects
	this.Parent = undefined,
	this.Log = undefined,
	
	//Connection Object to do requests with.
	this.Connection = undefined,
	
	this.addConnection = (parent_obj, api_type, api_version, api_domain) => {
		this.Parent = parent_obj;
		
		this.Log = new QB_LOG(this.Parent.Debug, this.objectName);
		if(this.Log){
			this.Log.setMessage('success', "Created new Log Object for " + this.objectName + ".");
		}else{
			return false;
		}
		
		this.Log.setMessage('process', "Starting connection to with " + this.objectName + " with request type: " + api_type + ".");
		//@TODO Add different connection object for different api_type's
		switch(api_type){
			default:
				this.Log.setMessage('process', "Stopping process.");
				return false;
			break;
		}
		this.Log.setMessage('process', "Finishing process.");
		return true;
	}
}

function QB_CONN(parent_obj, connection_type, connection_url){
	//@TODO Add Connection
}