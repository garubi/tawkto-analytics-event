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
			if ( diff > 1000 * TAE_VAR.chat_min_lenght){
				(TAE_VAR.debug) ? console.log('Send event Ongoing chat to Analytics') : '';
				ga('send', 'event', { eventCategory: TAE_VAR.eventCategory, eventAction: TAE_VAR.eventActionChatOngoing, eventLabel: '1minuto'});
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
	alert('ste' . TAE_VAR.debug );
	(TAE_VAR.debug) ? console.log('Send event Chat offline submit to Analytics') : '';
	ga('send', 'event', { eventCategory: TAE_VAR.eventCategory, eventAction: TAE_VAR.eventActiononOfflineSubmit});
};
