window.BMapLib=window.BMapLib||{};
window.BMapLib.EventWrapper=window.BMapLib.EventWrapper||{};
(function(){
	function f(a,c,b,e){
		this.c=a;
		this.d=c;
		this.h=b;
		this.g=e;
		this.b=f.b++;
		this.c.a=this.c.a||{};
		this.c.a[this.b]=this
	}
	var d=window.BMapLib.EventWrapper;
	d.addDomListener=function(a,c,b){
		a.addEventListener?a.addEventListener(c,b,!1):a.attachEvent?a.attachEvent("on"+c,b):a["on"+c]=b;
		return new f(a,c,b,f.e)
	};
	d.addDomListenerOnce=function(a,c,b){
		var e=d.addDomListener(a,c,function(){
			d.removeListener(e);
			return b.apply(this,arguments)
		});
		return e
	};
	d.addListener=function(a,c,b){
		a.addEventListener(c,b);
		return new f(a,c,b,f.f)
	};
	d.addListenerOnce=function(a,c,b){
		var e=d.addListener(a,c,function(){
			d.removeListener(e);
			return b.apply(this,arguments)
		});
		return e
	};
	d.clearInstanceListeners=function(a){
		var c=a.a||{},b;
		for(b in c)
			d.removeListener(c[b]);
		a.a={}
	};
	d.clearListeners=function(a,c){
		var b=a.a||{},e;
		for(e in b)
			b[e].d==c&&d.removeListener(b[e])
	};
	d.removeListener=function(a){
		var c=a.c,b=a.d,e=a.h,d=c.a||{},g;
		for(g in d)
			d[g].b==a.b&&(a.g==f.e?c.removeEventListener?c.removeEventListener(b,e,!1):c.detachEvent?c.detachEvent("on"+b,e):c["on"+b]=null:a.g==f.f&&c.removeEventListener(b,e),delete d[g])
	};
	d.trigger=function(a,c){
		var b=a.a||{},e;
		for(e in b)
			if(b[e].d==c){
				var d=Array.prototype.slice.call(arguments,2);
				b[e].h.apply(a,d)
			}
	};
	f.b=1;
	f.e=1;
	f.f=2
})();
