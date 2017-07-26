
/*利用Array实现的字符串拼接函数
  可避免直接用+=的方式拼接字符串，从而提高效率
*/

function StringBuilder() {
    this._strings_ = new Array;
}

StringBuilder.prototype.append = function(str) {
    this._strings_.push(str);
};

StringBuilder.prototype.toString = function() {
    return this._strings_.join("");
};