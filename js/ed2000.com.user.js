// ==UserScript==
// @match http://www.ed2000.com/ShowFile.asp?FileID=*
// @author Lynn
// @email homlean@gmail.com
// ==/UserScript==

'use strict';

(function(){
	var tables = document.querySelectorAll('table.CommonListArea');

	Array.prototype.slice.call(tables).map(function(table, index){
		if (table.querySelector('div').innerHTML === 'eD2k链接') {
			var list = table.querySelectorAll('a');
			var output = [];

			Array.prototype.slice.call(list).map(function(elem){
				if (elem.href && elem.href.indexOf('ed2k://') === 0) {
					var download = elem.href;
					var name = elem.innerHTML;

					output.push({
						name: name,
						ed2k: download
					});
				}
			});

			console.table(output);
		}
	});
})();
