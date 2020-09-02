var Tawk_API = Tawk_API || {};
var is_ongoing = 0;
var startime;

var ongoing_check_id= setInterval(function(){
	if(Tawk_API.isChatOngoing()){
		if( is_ongoing == 0){
			is_ongoing = 1;
			startime = new Date();
			(TAE_VAR.debug) ? console.log('Ongoing status starting: ', startime) : '';
		}
		else{
			nowtime = new Date();
			(TAE_VAR.debug) ? console.log('Ongoing status nowtime: ', nowtime) : '';
			diff =  nowtime - startime;
      		(TAE_VAR.debug) ? console.log('Ongoing status difftime: ', diff) : '';
			if ( diff > 1000 * TAE_VAR.chat_min_lenght){
				(TAE_VAR.debug) ? console.log('Send event Ongoing chat to Analytics') : '';
		        if( TAE_VAR.enable_ongoing == 'true' ){
		        	ga('send', 'event', { eventCategory: TAE_VAR.eventCategoryChatOngoing, eventAction: TAE_VAR.eventActionChatOngoing, eventLabel: TAE_VAR.chat_min_lenght + ' seconds'});
		        }
				else{
					console.log('Sending event Ongoing chat to Analytics is disabled')
				}
				clearInterval(ongoing_check_id);
			}
		}
		(TAE_VAR.debug) ? console.log('Chat is ongoing') : '';
	}
	else{
		(TAE_VAR.debug) ? console.log('Chat is not ongoing') : '';
		is_ongoing = 0;
	}
},
3000);

Tawk_API.onOfflineSubmit = function(data){
	(TAE_VAR.debug) ? console.log('Send event Chat offline submit to Analytics') : '';
	if( TAE_VAR.enable_offline == 'true' ){
		ga('send', 'event', { eventCategory: TAE_VAR.eventCategoryonOfflineSubmit, eventAction: TAE_VAR.eventActiononOfflineSubmit});
	}
	else{
		console.log('Send event Chat offline submit to Analytics is disabled')
	}
};
