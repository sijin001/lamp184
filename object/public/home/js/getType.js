/**
 * 检查传入的对象
 * 如果是null则返回null(typeof null是返回object)
 * 如果是数组则返回array(typeof []是返回object)
 *
 * var getType = require("lib/util/getType");
 * var type = getType([]); // array
 */
define(function(require, exports, module) {
	return function(obj) {
		var type;
		return ((type = typeof(obj)) == "object" ? obj == null && "null" || Object.prototype.toString.call(obj).slice(8, -1) : type).toLowerCase();
	}
});