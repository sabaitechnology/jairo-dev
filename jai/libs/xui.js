function parseJson(jsonIn){ var jsonObj, error=false, txt=[]; if(jsonIn==null||jsonIn==''){ jsonObj=''; }
 else try { jsonObj=JSON.parse(jsonIn); }catch(ex){ error=true; txt=[ex,'\tRaw JSON: "'+jsonIn+'"']; for(var i in ex){ txt.push('\t'+ i +': '+ ex[i]); } }
 return { err: error, msg: (error?txt.join('\n'):jsonObj) } /* tragically, there's nothing we can do */
}
function getJson(jsonIn){ if(jsonIn==''){ return ''; }; jsonObj=parseJson(jsonIn); if(jsonObj.err && errors!==false){ errors.push(jsonObj.msg); return ''; }else return jsonObj.msg; }

function help(){ window.open('http://sabaitechnology.zendesk.com/anonymous_requests/new','Submit a Support Request','height=600,width=800,top=50,left=50').focus(); return false; }

// /* ~ */
