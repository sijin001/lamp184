/**
 * 清除字符串前后空白字符
 * 例子：
 *
 * var trim = require("lib/str/trim");
 * var str = trim(" text "); // "text"
 *
 */
define(function(require, exports, module) { 
	return function(str){
		if (str == null) {
			return "";
		}
		
		var len = str.length;
		var s = 0;
		var reg = /(\u3000|\s|\t|\u00A0)/;
		
		while(s < len){
			if(!reg.test(str.charAt(s))){
				break;
			}

			s += 1;
		}

		while(len > s){
			if(!reg.test(str.charAt(len - 1))){
				break;
			}

			len -= 1;
		}

		return str.slice(s, len);
	};
});