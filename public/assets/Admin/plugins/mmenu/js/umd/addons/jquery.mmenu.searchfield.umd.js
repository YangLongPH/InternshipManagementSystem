(function ( factory ) {
    if ( typeof define === 'function' && define.amd )
    {
        // AMD. Register as an anonymous module.
        define( [ 'jquery' ], factory );
    }
    else if ( typeof exports === 'object' )
    {
        // Node/CommonJS
        factory( require( 'jquery' ) );
    }
    else
    {
        // Browser globals
        factory( jQuery );
    }
}( function ( jQuery ) {


/*	
 * jQuery mmenu searchfield addon
 * mmenu.frebsite.nl
 *	
 * Copyright (c) Fred Heusschen
 * www.frebsite.nl
 */
!function(e){function s(s){return"boolean"==typeof s&&(s={add:s,search:s}),"object"!=typeof s&&(s={}),s=e.extend(!0,{},e[d].defaults[c],s),"boolean"!=typeof s.showLinksOnly&&(s.showLinksOnly="menu"==s.addTo),s}function n(e){return e}function t(){h=!0,r=e[d]._c,o=e[d]._d,l=e[d]._e,r.add("search hassearch noresults nosubresults counter"),l.add("search reset change"),i=e[d].glbl}function a(e){switch(e){case 9:case 16:case 17:case 18:case 37:case 38:case 39:case 40:return!0}return!1}var r,o,l,i,d="mmenu",c="searchfield",h=!1;e[d].prototype["_addon_"+c]=function(){h||t(),this.opts[c]=s(this.opts[c]),this.conf[c]=n(this.conf[c]);var i=this,d=this.opts[c];if(this.conf[c],d.add){switch(d.addTo){case"menu":var u=this.$menu;break;case"panels":var u=e("."+r.panel,this.$menu);break;default:var u=e(d.addTo,this.$menu).filter("."+r.panel)}u.length&&u.each(function(){var s=e(this),n=s.is("."+r.list)?"li":"div",t=s.children().first(),a=t.is("."+r.subtitle)?"After":"Before",t=e("<"+n+' class="'+r.search+'" />').append('<input placeholder="'+d.placeholder+'" type="text" autocomplete="off" />')["insert"+a](t);d.noResults&&e("<"+n+' class="'+r.noresults+'" />').html(d.noResults).insertAfter(t)})}if(this.$menu.children("div."+r.search).length&&this.$menu.addClass(r.hassearch),d.search){var f=e("."+r.search,this.$menu);f.length&&f.each(function(){var s=e(this);if("menu"==d.addTo)var n=e("."+r.panel,i.$menu);else var n=s.closest("."+r.panel);var t=n.add(n.children("."+r.list)),c=s.find("input"),h=e("> li",t),u=h.filter("."+r.label),f=h.not("."+r.subtitle).not("."+r.label).not("."+r.search).not("."+r.noresults),p="> a";d.showLinksOnly||(p+=", > span"),c.off(l.keyup+" "+l.change).on(l.keyup,function(e){a(e.keyCode)||s.trigger(l.search)}).on(l.change,function(){s.trigger(l.search)}),s.off(l.reset+" "+l.search).on(l.reset+" "+l.search,function(e){e.stopPropagation()}).on(l.reset,function(){s.trigger(l.search,[""])}).on(l.search,function(s,t){"string"==typeof t?c.val(t):t=c.val(),t=t.toLowerCase(),n.scrollTop(0),f.add(u).addClass(r.hidden),f.each(function(){var s=e(this);e(p,s).text().toLowerCase().indexOf(t)>-1&&s.add(s.prevAll("."+r.label).first()).removeClass(r.hidden)}),e(n.get().reverse()).each(function(){var s=e(this),n=s.data(o.parent);if(n){var t=s.add(s.find("> ."+r.list)).find("> li").not("."+r.subtitle).not("."+r.search).not("."+r.noresults).not("."+r.label).not("."+r.hidden);t.length?n.removeClass(r.hidden).removeClass(r.nosubresults).prevAll("."+r.label).first().removeClass(r.hidden):"menu"==d.addTo&&(s.hasClass(r.current)&&n.trigger(l.open),n.addClass(r.nosubresults))}}),i.$menu[f.not("."+r.hidden).length?"removeClass":"addClass"](r.noresults),i._update()})})}},e[d].addons=e[d].addons||[],e[d].addons.push(c),e[d].defaults[c]={add:!1,addTo:"menu",search:!1,placeholder:"Search",noResults:"No results found."}}(jQuery);
}));